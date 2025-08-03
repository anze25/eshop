<x-app-layout title="{{ __('Checkout') }}">
    <style>
        .checkout-form .billing-info__wrapper h4 {
            text-transform: uppercase
        }
    </style>
    <main class="pt-90">
        @php
            $locale = app()->getLocale();
        @endphp
        <div class="mb-4 pb-4"></div>
        <section class="shop-checkout container">
            <h2 class="page-title">@lang('Shipping and Checkout')</h2>
            <div class="checkout-steps">
                <a
                    href="{{ route('cart.index') }}"
                    class="checkout-steps__item active"
                >
                    <span class="checkout-steps__item-number">01</span>
                    <span class="checkout-steps__item-title">
                        <span>@lang('Shopping Bag')</span>
                        <em>@lang('Manage Your Items List')</em>
                    </span>
                </a>
                <a
                    href="javascript:void(0)"
                    class="checkout-steps__item active"
                >
                    <span class="checkout-steps__item-number">02</span>
                    <span class="checkout-steps__item-title">
                        <span>@lang('Shipping and Checkout')</span>
                        <em>@lang('Checkout Your Items List')</em>
                    </span>
                </a>
                <a
                    href="javascript:void(0)"
                    class="checkout-steps__item"
                >
                    <span class="checkout-steps__item-number">03</span>
                    <span class="checkout-steps__item-title">
                        <span>@lang('Confirmation')</span>
                        <em>@lang('Review And Submit Your Order')</em>
                    </span>
                </a>
            </div>
            <form
                id="payment-form"
                name="checkout-form"
                action="{{ route('cart.place.an.order') }}"
                method="POST"
            >
                @csrf
                <input
                    id="payment-method-input"
                    type="hidden"
                    name="payment_method"
                >

                <div class="checkout-form">
                    <div class="billing-info__wrapper">
                        <div class="row">
                            <div class="col-6">
                                <h4>@lang('Shipping Details')</h4>
                            </div>
                            <div class="col-6">
                            </div>
                        </div>
                        @if ($address)
                            <div class="row mt-5">
                                <div class="col-md-4">
                                    <div class="form-floating my-3">
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="first_name"
                                            required=""
                                            value="{{ $address->first_name }}"
                                        >
                                        <label for="first_name">@lang('First Name') <span
                                                class="text-danger">*</span></label>
                                        <span class="text-danger">
                                            @error('first_name')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating my-3">
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="last_name"
                                            required=""
                                            value="{{ $address->last_name }}"
                                        >
                                        <label for="last_name">@lang('Last Name') <span
                                                class="text-danger">*</span></label>
                                        <span class="text-danger">
                                            @error('last_name')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-floating my-3">
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="company_name"
                                            value="{{ $address->company_name }}"
                                        >
                                        <label for="company_name">@lang('Company Name')</label>
                                        <span class="text-danger">
                                            @error('company_name')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-floating my-3">
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="street_address"
                                            required=""
                                            value="{{ $address->street_address }}"
                                        >
                                        <label for="street_address">@lang('Street and House Number') <span
                                                class="text-danger">*</span></label>
                                        <span class="text-danger">
                                            @error('street_address')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating my-3">
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="address_line_2"
                                            value="{{ $address->address_line_2 }}"
                                        >
                                        <label for="address_line_2">@lang('Suite or Appartment Number')</label>
                                        <span class="text-danger">
                                            @error('address_line_2')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating my-3">
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="phone_number"
                                            value="{{ $address->phone_number }}"
                                        >
                                        <label for="phone_number">@lang('Phone')</label>
                                        <span class="text-danger">
                                            @error('phone_number')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating my-3">
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="postal_code"
                                            required=""
                                            value="{{ $address->postal_code }}"
                                        >
                                        <label for="postal_code">@lang('Zip Code') <span
                                                class="text-danger">*</span></label>
                                        <span class="text-danger">
                                            @error('postal_code')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating mt-3 mb-3">
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="city"
                                            required=""
                                            value="{{ $address->city }}"
                                        >
                                        <label for="state">@lang('Town / City') <span
                                                class="text-danger">*</span></label>
                                        <span class="text-danger">
                                            @error('city')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating my-3">
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="state_province_region"
                                            value="{{ $address->state_province_region }}"
                                        >
                                        <label for="state_province_region">@lang('State / Province / Region')
                                            <span class="text-danger">
                                                @error('state_province_region')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating my-3">
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="country"
                                            required=""
                                            value="{{ $address->country }}"
                                        >
                                        <label for="country">@lang('Country') <span
                                                class="text-danger">*</span></label>
                                        <span class="text-danger">
                                            @error('country')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-floating my-3">

                                        <textarea
                                            id=""
                                            name="delivery_instructions"
                                            class="form-control"
                                        >{{ $address->delivery_instructions }}</textarea>

                                        <label for="delivery_instructions">@lang('Delivery Instructions') </label>
                                        <span class="text-danger">
                                            @error('delivery_instructions')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="row mt-5">
                                <div class="col-md-4">
                                    <div class="form-floating my-3">
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="first_name"
                                            required=""
                                            value="{{ old('first_name') }}"
                                        >
                                        <label for="first_name">@lang('First Name') <span
                                                class="text-danger">*</span></label>
                                        <span class="text-danger">
                                            @error('first_name')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating my-3">
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="last_name"
                                            required=""
                                            value="{{ old('last_name') }}"
                                        >
                                        <label for="last_name">@lang('Last Name') <span
                                                class="text-danger">*</span></label>
                                        <span class="text-danger">
                                            @error('last_name')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-floating my-3">
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="company_name"
                                            value="{{ old('company_name') }}"
                                        >
                                        <label for="company_name">@lang('Company Name')</label>
                                        <span class="text-danger">
                                            @error('company_name')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-floating my-3">
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="street_address"
                                            required=""
                                            value="{{ old('street_address') }}"
                                        >
                                        <label for="street_address">@lang('Street and House Number') <span
                                                class="text-danger">*</span></label>
                                        <span class="text-danger">
                                            @error('street_address')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating my-3">
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="address_line_2"
                                            value="{{ old('address_line_2') }}"
                                        >
                                        <label for="address_line_2">@lang('Suite or Appartment Number')</label>
                                        <span class="text-danger">
                                            @error('address_line_2')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating my-3">
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="phone_number"
                                            value="{{ old('phone_number') }}"
                                        >
                                        <label for="phone_number">@lang('Phone')</label>
                                        <span class="text-danger">
                                            @error('phone_number')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating my-3">
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="postal_code"
                                            required=""
                                            value="{{ old('postal_code') }}"
                                        >
                                        <label for="postal_code">@lang('Zip Code') <span
                                                class="text-danger">*</span></label>
                                        <span class="text-danger">
                                            @error('postal_code')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating mt-3 mb-3">
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="city"
                                            required=""
                                            value="{{ old('city') }}"
                                        >
                                        <label for="state">@lang('Town / City') <span
                                                class="text-danger">*</span></label>
                                        <span class="text-danger">
                                            @error('city')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating my-3">
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="state_province_region"
                                            value="{{ old('state_province_region') }}"
                                        >
                                        <label for="state_province_region">@lang('State / Province / Region')
                                            <span class="text-danger">
                                                @error('state_province_region')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating my-3">
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="country"
                                            required=""
                                            value="{{ old('country') }}"
                                        >
                                        <label for="country">@lang('Country') <span
                                                class="text-danger">*</span></label>
                                        <span class="text-danger">
                                            @error('country')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-floating my-3">

                                        <textarea
                                            id=""
                                            name="delivery_instructions"
                                            class="form-control"
                                        >{{ old('delivery_instructions') }}</textarea>

                                        <label for="delivery_instructions">@lang('Delivery Instructions') </label>
                                        <span class="text-danger">
                                            @error('delivery_instructions')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="checkout__totals-wrapper">
                        <div class="sticky-content">
                            <div class="checkout__totals">

                                <h3>@lang('Your Order')</h3>
                                <table class="checkout-cart-items">
                                    <thead style="text-transform: uppercase">
                                        <tr>
                                            <th>@lang('Product')</th>
                                            <th align="right">@lang('Subtotal')</th>
                                        </tr>
                                    </thead>



                                    <tbody>
                                        @foreach (Cart::instance('cart')->content() as $item)
                                            @php
                                                $product = \App\Models\Product::with('translations')
                                                    ->where('id', $item->id)
                                                    ->first();

                                            @endphp
                                            <tr style="text-transform: uppercase">
                                                <td>
                                                    {{ $product->translations->where('locale', $locale)->first()?->name ?? '' }}
                                                    X {{ $item->qty }}
                                                </td>
                                                <td align="right">
                                                    $ {{ $item->subtotal() }}
                                                </td>
                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                                @if (Session::has('discounts'))
                                    <table class="checkout-totals">
                                        <tbody>
                                            <tr>
                                                <th>@lang('Subtotal')</th>
                                                <td class="text-right">${{ Cart::instance('cart')->subtotal() }}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('Discount') {{ Session::get('coupon')['code'] }}</th>
                                                <td align="right">${{ Session::get('discounts')['discount'] }}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('Subtotal After Discount')</th>
                                                <td align="right">${{ Session::get('discounts')['subtotal'] }}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('Shipping')</th>
                                                <td align="right">
                                                    @lang('Free')
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>@lang('VAT')</th>
                                                <td align="right">${{ Session::get('discounts')['tax'] }}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('Total')</th>
                                                <td align="right">${{ Session::get('discounts')['total'] }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                @else
                                    <table class="checkout-totals">
                                        <tbody>
                                            <tr>
                                                <th>@lang('Subtotal')</th>
                                                <td align="right">${{ Cart::instance('cart')->subtotal() }}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('Shipping')</th>
                                                <td align="right">@lang('Free')</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('VAT')</th>
                                                <td align="right">${{ Cart::instance('cart')->tax() }}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('Total')</th>
                                                <td align="right">${{ Cart::instance('cart')->total() }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                @endif

                            </div>
                            <div class="checkout__payment-methods">
                                <div class="form-check">
                                    <input
                                        id="mode_card"
                                        class="form-check-input"
                                        type="radio"
                                        name="mode"
                                        value="card"
                                        checked
                                    >
                                    <label
                                        class="form-check-label"
                                        for="mode_card"
                                    >@lang('Debit or Credit Card')</label>
                                </div>
                                <div
                                    id="card-payment-area"
                                    class="my-3"
                                >
                                    <div
                                        id="card-element"
                                        class="form-control"
                                    ></div>
                                    <div
                                        id="card-errors"
                                        role="alert"
                                        class="text-danger mt-2"
                                    ></div>
                                </div>
                                <div class="form-check mt-2">
                                    <input
                                        id="mode_cod"
                                        class="form-check-input"
                                        type="radio"
                                        name="mode"
                                        value="cod"
                                    >
                                    <label
                                        class="form-check-label"
                                        for="mode_cod"
                                    >@lang('Cash on delivery')</label>
                                </div>
                            </div>
                            <button
                                id="submit-button"
                                type="submit"
                                class="btn btn-primary btn-checkout_"
                                style="text-transform: uppercase"
                            >
                                @lang('Place Order')
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </main>
    @push('scripts')
        <script src="https://js.stripe.com/v3/"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const stripe = Stripe("{{ config('services.stripe.key') }}");
                const elements = stripe.elements();

                const style = {
                    base: {
                        fontSize: '16px',
                        '::placeholder': {
                            color: '#aab7c4'
                        }
                    },
                    invalid: {
                        color: '#fa755a',
                        iconColor: '#fa755a'
                    }
                };

                const cardElement = elements.create('card', {
                    style: style
                });
                cardElement.mount('#card-element');

                // Sedaj bo JavaScript pravilno našel te elemente
                const form = document.getElementById('payment-form');
                const submitButton = document.getElementById('submit-button');
                const cardPaymentArea = document.getElementById('card-payment-area');
                const cardErrors = document.getElementById('card-errors');
                const paymentMethodInput = document.getElementById('payment-method-input');

                // Pokaži/skrij polje za kartico
                document.querySelectorAll('input[name="mode"]').forEach(radio => {
                    radio.addEventListener('change', function() {
                        cardPaymentArea.style.display = (this.value === 'card') ? 'block' : 'none';
                    });
                });
                if (document.querySelector('input[name="mode"]:checked').value !== 'card') {
                    cardPaymentArea.style.display = 'none';
                }

                // Poslušaj na oddajo obrazca
                form.addEventListener('submit', async function(event) {
                    if (document.querySelector('input[name="mode"]:checked').value !== 'card') {
                        return; // Normalna oddaja za COD
                    }

                    event.preventDefault(); // Ustavi oddajo za plačilo s kartico
                    submitButton.disabled = true;
                    cardErrors.textContent = '';

                    const {
                        paymentMethod,
                        error
                    } = await stripe.createPaymentMethod({
                        type: 'card',
                        card: cardElement,
                    });

                    if (error) {
                        cardErrors.textContent = error.message;
                        submitButton.disabled = false;
                    } else {
                        paymentMethodInput.value = paymentMethod.id;
                        form.submit(); // Pošlji obrazec z dodanim ID-jem
                    }
                });
            });
        </script>
    @endpush
</x-app-layout>
