<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use Stripe\Stripe;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Address;
use App\Models\OrderItem;
use Stripe\PaymentIntent;
use App\Models\Transaction;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use function Symfony\Component\String\b;
use Surfsidemedia\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function index()
    {
        $items = Cart::instance('cart')->content();
        return view('cart', compact('items'));
    }

    public function add_to_cart(Request $request)
    {
        Cart::instance('cart')->add($request->id, $request->name, $request->quantity, $request->price)->associate('App\Models\Product');

        return redirect()->back();
    }

    public function increase_cart_quantity($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty + 1;
        Cart::instance('cart')->update($rowId, $qty);
        return redirect()->back();
    }

    public function decrease_cart_quantity($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty - 1;
        Cart::instance('cart')->update($rowId, $qty);
        return redirect()->back();
    }

    public function remove_item($rowId)
    {
        Cart::instance('cart')->remove($rowId);
        return redirect()->back();
    }

    public function empty_cart()
    {
        Cart::instance('cart')->destroy();
        return redirect()->back();
    }

    public function apply_coupon_code(Request $request)
    {
        // dd(Cart::instance('cart')->subtotal());
        $coupon_code = $request->coupon_code;
        if (isset($coupon_code)) {
            $coupon = Coupon::whereRaw('UPPER(code) = ?', [strtoupper($coupon_code)])
                ->where('expiry_date', '>=', Carbon::today())
                ->where('cart_value', '<=', Cart::instance('cart')->subtotal())
                ->first();

            if (!$coupon) {
                return redirect()->back()->with('error', __('Coupon not valid!'));
            } else {
                Session::put('coupon', [
                    'code' => $coupon->code,
                    'type' => $coupon->type,
                    'value' => $coupon->value,
                    'cart_value' => $coupon->cart_value
                ]);
                $this->calculate_discount();
                return redirect()->back()->with('success', __('Coupon applied successfully'));
            }
        } else {
            return redirect()->back()->with('error', __('Coupon not valid!'));
        }
    }

    public function calculate_discount()
    {
        $discount = 0;
        $subtotal = str_replace(',', '', Cart::instance('cart')->subtotal());
        $subtotal = (float) $subtotal; // Convert cleaned value to float
        if (Session::has('coupon')) {
            if (Session::get('coupon')['type'] == 'fixed') {
                $discount = (float) Session::get('coupon')['value']; // Ensure it's a float
            } else {
                if (is_numeric(Session::get('coupon')['value'])) {
                    // Remove thousands separator from subtotal before calculation
                    $subtotal = str_replace(',', '', Cart::instance('cart')->subtotal());
                    $subtotal = (float) $subtotal; // Convert cleaned value to float

                    $discount = ($subtotal * (float) Session::get('coupon')['value']) / 100;
                } else {
                    $discount = 0; // Handle invalid values gracefully
                }
            }
        }

        $subtotalAfterDiscount = $subtotal - $discount;
        $taxAfterDiscount = ($subtotalAfterDiscount * config('cart.tax')) / 100;
        $totalAfterDiscount = $subtotalAfterDiscount + $taxAfterDiscount;

        Session::put('discounts', [
            'discount' => number_format(floatval($discount), 2, '.', ''),
            'subtotal' => number_format(floatval($subtotalAfterDiscount), 2, '.', ''),
            'tax' => number_format(floatval($taxAfterDiscount), 2, '.', ''),
            'total' => number_format(floatval($totalAfterDiscount), 2, '.', ''),
        ]);
    }

    public function remove_coupon_code()
    {
        Session::forget('coupon');
        Session::forget('discounts');

        return back()->with('success', __('Coupon has been removed!'));
    }

    public function checkout()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $address = Address::where('user_id', Auth::user()->id)->where('isdefault', 1)->first();

        return view('checkout', compact('address'));
    }

    public function place_an_order(Request $request)
    {

        // Validate the payment mode and the Stripe payment method if 'card' is chosen
        $request->validate([
            'mode' => 'required|in:card,cod',
            'payment_method' => 'required_if:mode,card|string',
        ]);

        $user_id = Auth::user()->id;

        // Start a database transaction to ensure data integrity
        DB::beginTransaction();

        try {
            // Step 1: Get or Create the User's Address (your original logic)
            $address = Address::where('user_id', $user_id)->where('isdefault', 1)->first();

            if (!$address) {
                $request->validate([
                    'first_name' => 'required|max:100',
                    'last_name' => 'required|max:100',
                    'company_name' => 'nullable|max:100', // Changed to nullable
                    'street_address' => 'required|max:100',
                    'address_line_2' => 'nullable|max:100', // Changed to nullable
                    'postal_code' => 'required|min:4',
                    'city' => 'required|max:50',
                    'country' => 'required|max:60',
                    'state_province_region' => 'nullable|max:60', // Changed to nullable
                    'phone_number' => 'nullable|min:6',
                    'delivery_instructions' => 'nullable|min:3',
                ]);

                // Create and save the new address
                $address = new Address();
                $address->fill($request->only([
                    'first_name',
                    'last_name',
                    'company_name',
                    'street_address',
                    'address_line_2',
                    'city',
                    'postal_code',
                    'country',
                    'state_province_region',
                    'phone_number',
                    'delivery_instructions'
                ]));
                $address->user_id = $user_id;
                $address->isdefault = true;
                $address->save();
            }

            // Step 2: Calculate final amounts
            $this->setAmountForCheckout();
            $checkoutData = Session::get('checkout');
            if (!$checkoutData) {
                throw new Exception(__("Your session has expired. Please return to the cart."));
            }

            $stripePaymentIntentId = null;

            // Step 3: Process Payment with Stripe (if applicable)
            if ($request->mode == 'card') {
                Stripe::setApiKey(config('services.stripe.secret'));
                $paymentIntent = PaymentIntent::create([
                    'amount' => $checkoutData['total'] * 100, // Amount in cents
                    'currency' => 'usd', // IMPORTANT: Set your currency
                    'payment_method' => $request->payment_method,
                    'confirm' => true,
                    'description' => 'Order for user ' . $user_id,
                    'return_url' => route('cart.order.confirmation'), // Required for 3D Secure
                ]);

                if ($paymentIntent->status != 'succeeded') {
                    throw new Exception(__('Payment was not successful. Please try another card.'));
                }
                $stripePaymentIntentId = $paymentIntent->id;
            }

            // Step 4: Create the Order
            $order = new Order();
            $order->user_id = $user_id;

            // Fill order-specific data from the session
            $order->subtotal = $checkoutData['subtotal'];
            $order->discount = $checkoutData['discount'];
            $order->tax = $checkoutData['tax'];
            $order->total = $checkoutData['total'];

            // CORRECTED: Manually assign only the necessary address fields
            $order->first_name = $address->first_name;
            $order->last_name = $address->last_name;
            $order->company_name = $address->company_name;
            $order->street_address = $address->street_address;
            $order->address_line_2 = $address->address_line_2;
            $order->city = $address->city;
            $order->postal_code = $address->postal_code;
            $order->country = $address->country;
            $order->state_province_region = $address->state_province_region;
            $order->phone_number = $address->phone_number;
            $order->delivery_instructions = $address->delivery_instructions;

            $order->save();

            // Step 5: Save Order Items
            foreach (Cart::instance('cart')->content() as $item) {
                $orderItem = new OrderItem();
                $orderItem->product_id = $item->id;
                $orderItem->order_id = $order->id;
                $orderItem->price = $item->price;
                $orderItem->quantity = $item->qty;
                $orderItem->save();
            }

            // Step 6: Create the Transaction Record
            $transaction = new Transaction();
            $transaction->user_id = $user_id;
            $transaction->order_id = $order->id;
            $transaction->mode = $request->mode;
            $transaction->status = ($request->mode == 'card') ? 'approved' : 'pending';
            $transaction->stripe_payment_id = $stripePaymentIntentId; // Will be null for COD
            $transaction->save();

            // Step 7: Commit the transaction if everything was successful
            DB::commit();

            // Step 8: Clean up the session and redirect
            Cart::instance('cart')->destroy();
            Session::forget(['checkout', 'coupon', 'discounts']);
            Session::put('order_id', $order->id);

            return redirect()->route('cart.order.confirmation', compact('order'));
        } catch (Exception $e) {
            // If an error occurred, rollback the database transaction
            DB::rollBack();

            // Log the error for debugging
            Log::error('Order placement failed: ' . $e->getMessage());

            // Redirect back with an error message
            return redirect()->route('cart.checkout')->with([
                'message' => __('An error occurred: ') . $e->getMessage(),
                'alert-type' => 'info'
            ]);
        }
    }

    public function setAmountForCheckout()
    {
        if (!Cart::instance('cart')->content()->count() > 0) {
            Session::forget('checkout');
            return;
        }
        if (Session::has('coupon')) {
            Session::put('checkout', [
                'discount' => Session::get('discounts')['discount'],
                'subtotal' => Session::get('discounts')['subtotal'],
                'tax' => Session::get('discounts')['tax'],
                'total' => Session::get('discounts')['total'],
            ]);
        } else {

            Session::put('checkout', [
                'discount' => 0,
                'subtotal' =>  str_replace(',', '', Cart::instance('cart')->subtotal()),
                'tax' =>  str_replace(',', '', Cart::instance('cart')->tax()),
                'total' =>  str_replace(',', '', Cart::instance('cart')->total()),

            ]);
        }
    }

    public function order_confirmation()
    {
        if (Session::has('order_id')) {
            $order = Order::find(Session::get('order_id'));
            return view('order-cofirmation', compact('order'));
        }
        return redirect()->route('cart.index');
    }
}
