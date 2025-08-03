<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Address;
use App\Models\OrderItem;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Surfsidemedia\Shoppingcart\Facades\Cart;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index');
    }

    public function orders()
    {
        $orders = Order::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->paginate('10');
        return view('user.orders', compact('orders'));
    }

    public function order_details($order_id)
    {
        $order = Order::where('user_id', Auth::user()->id)->where('id', $order_id)->first();
        if ($order) {
            $orderItems = OrderItem::where('order_id', $order_id)->orderBy('id')->paginate(12);
            $transaction = Transaction::where('order_id', $order_id)->first();
            return view('user.order-details', compact('order', 'orderItems', 'transaction'));
        } else {
            return redirect()->route('login');
        }
    }

    public function order_cancel(Request $request)
    {
        $order = Order::find($request->order_id);
        $order->status = 'canceled';
        $order->canceled_date = Carbon::now();
        $order->save();
        return back()->with('status', __('Order has been cancelled!'));
    }

    public function addresses()
    {
        $addresses = Address::where('user_id', Auth::user()->id)->orderBy('isdefault', 'DESC')->paginate('10');
        return view('user.addresses', compact('addresses'));
    }

    public function address_add()
    {
        return view('user.address-add');
    }

    public function address_store(Request $request)
    {
        $user_id = Auth::user()->id;
        if ($request->isdefault == 1) {
            Address::where('user_id', auth()->id())
                ->where('isdefault', 1)
                ->update(['isdefault' => 0]);
        }

        $request->validate([
            'first_name' => 'required|max:100',
            'last_name' => 'required|max:100',
            'company_name' => 'nullable|max:100',
            'street_address' => 'required|max:100',
            'address_line_2' => 'nullable|max:100',
            'postal_code' => 'required|numeric|min:4',
            'city' => 'required|max:50',
            'country' => 'required|max:60',
            'state_province_region' => 'max:60',
            'phone_number' => ['nullable', 'regex:/^(\+?\d{1,3}[-.\s]?)?(\(?\d{3}\)?[-.\s]?)?\d{3}[-.\s]?\d{4}$/'],
            'delivery_instructions' => ['nullable', 'min:3']


        ]);
        $address = new Address();
        $address->first_name = $request->first_name;
        $address->last_name = $request->last_name;
        $address->company_name = $request->company_name;
        $address->street_address = $request->street_address;
        $address->address_line_2 = $request->address_line_2;
        $address->city = $request->city;
        $address->postal_code = $request->postal_code;
        $address->country = $request->country;
        $address->state_province_region = $request->state_province_region;
        $address->phone_number =  $request->phone_number;
        $address->delivery_instructions =  $request->delivery_instructions;
        $address->user_id = $user_id;
        $address->isdefault = $request->isdefault;
        $address->save();

        return redirect()->route('user.addresses')->with([
            'message' => __('Created successfully!'),
            'alert-type' => 'success'
        ]);
    }

    public function address_edit($id)
    {
        $address = Address::findOrFail($id);
        return view('user.address-edit', compact('address'));
    }

    public function address_update(Request $request)
    {
        $user_id = Auth::user()->id;
        $address = Address::find($request->id);
        if ($request->isdefault == 1) {

            Address::where('user_id', $user_id)
                ->where('isdefault', 1)
                ->update(['isdefault' => 0]);
        }

        $addressData = $request->validate([
            'first_name' => 'required|max:100',
            'last_name' => 'required|max:100',
            'company_name' => 'max:100',
            'street_address' => 'required|max:100',
            'address_line_2' => 'max:100',
            'postal_code' => 'required|numeric|min:4',
            'city' => 'required|max:50',
            'country' => 'required|max:60',
            'state_province_region' => 'max:60',
            'phone_number' => ['nullable', 'regex:/^(\+?\d{1,3}[-.\s]?)?(\(?\d{3}\)?[-.\s]?)?\d{3}[-.\s]?\d{4}$/'],
            'delivery_instructions' => ['nullable', 'min:3'],
            'isdefault' => ['boolean']

        ]);

        $address->update($addressData);

        return redirect()->route('user.addresses')->with([
            'message' => __('Updated successfully!'),
            'alert-type' => 'info'
        ]);
    }
    public function address_delete($id)
    {
        $address = Address::findOrFail($id);
        $userId = $address->user_id;
        $wasDefault = $address->isdefault;

        $address->delete();

        // If it was default, assign another one as default
        if ($wasDefault) {
            $newDefault = Address::where('user_id', $userId)->first();
            if ($newDefault) {
                $newDefault->isdefault = 1;
                $newDefault->save();
            }
        }

        return redirect()->route('user.addresses')->with([
            'message' => __('Deleted successfully!'),
            'alert-type' => 'info'
        ]);
    }





    public function account_details()
    {
        $user = Auth::user();

        return view('user.account-details', compact('user'));
    }

    public function wishlist()
    {
        $items = Cart::instance('wishlist')->content();
        return view('user.wishlist', compact('items'));
    }

    public function account_details_update(Request $request)
    {
        $rules = [
            'name' => 'required|min:5',
            'mobile' => 'nullable'
        ];

        $validatedData = $request->validate($rules);

        $user = User::find($request->id); // hidden input in edit.blade

        // Prepare base news data
        $userData = [
            'name' => $request->name,
            'mobile' => $request->mobile,

        ];
        $user->update($userData);


        return redirect()->route('user.account.details')->with('message', __('Updated successfully!'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => ['required', 'current_password'],
            'new_password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $user = $request->user();
        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with([
            'message' => __('Geslo profila je bilo uspešno posodobljeno!'),
            'alert-type' => 'info'
        ]);
    }
}
