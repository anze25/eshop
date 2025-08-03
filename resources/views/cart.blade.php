<x-app title="{{ __('Cart') }}">


    <main class="pt-90">
        @php
            $locale = app()->getLocale();
        @endphp
        <div class="mb-4 pb-4"></div>
        <section class="shop-checkout container">
            <h2 class="page-title">@lang('Cart')</h2>
            <div class="checkout-steps">
                <a
                    href="javascript:void(0)"
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
                    class="checkout-steps__item"
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
            <div class="shopping-cart">
                @if ($items->count() > 0)
                    <div class="cart-table__wrapper">
                        <table class="cart-table">
                            <thead>
                                <tr>
                                    <th>@lang('Product')</th>
                                    <th></th>
                                    <th>@lang('Price')</th>
                                    <th>@lang('Quantity')</th>
                                    <th>@lang('Subtotal')</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($items as $item)
                                    @php
                                        $product = \App\Models\Product::with('translations')
                                            ->where('id', $item->id)
                                            ->first();

                                    @endphp
                                    <tr>
                                        <td>
                                            <div class="shopping-cart__product-item">
                                                <img
                                                    loading="lazy"
                                                    src="{{ asset('uploads/products/thumbnails') }}/{{ $item->model->image }}"
                                                    width="120"
                                                    height="120"
                                                    alt="{{ $item->name }}"
                                                />
                                            </div>
                                        </td>
                                        <td>
                                            <div class="shopping-cart__product-item__detail">
                                                <h4> {{ $product->translations->where('locale', $locale)->first()?->name ?? '' }}
                                                </h4>
                                                <ul class="shopping-cart__product-item__options">
                                                    {{-- <li>Color: Yellow</li>
                                                    <li>Size: L</li> --}}
                                                </ul>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="shopping-cart__product-price">${{ $item->price }}</span>
                                        </td>
                                        <td>
                                            <div class="qty-control position-relative">
                                                <input
                                                    type="number"
                                                    name="quantity"
                                                    value="{{ $item->qty }}"
                                                    min="1"
                                                    class="qty-control__number text-center"
                                                >
                                                <form
                                                    action="{{ route('cart.qty.decrease', ['rowId' => $item->rowId]) }}"
                                                    method="POST"
                                                >
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="qty-control__reduce">-</div>
                                                </form>
                                                <form
                                                    action="{{ route('cart.qty.increase', ['rowId' => $item->rowId]) }}"
                                                    method="POST"
                                                >
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="qty-control__increase">+</div>
                                                </form>

                                            </div>
                                        </td>
                                        <td>
                                            <span class="shopping-cart__subtotal">${{ $item->subtotal }}</span>
                                        </td>

                                        <td>
                                            <form
                                                action="{{ route('cart.item.remove', ['rowId' => $item->rowId]) }}"
                                                method="POST"
                                            >
                                                @csrf
                                                @method('DELETE')
                                                <a
                                                    href="javascript:void(0)"
                                                    class="remove-cart"
                                                >
                                                    <svg
                                                        width="10"
                                                        height="10"
                                                        viewBox="0 0 10 10"
                                                        fill="#767676"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                    >
                                                        <path
                                                            d="M0.259435 8.85506L9.11449 0L10 0.885506L1.14494 9.74056L0.259435 8.85506Z"
                                                        />
                                                        <path
                                                            d="M0.885506 0.0889838L9.74057 8.94404L8.85506 9.82955L0 0.97449L0.885506 0.0889838Z"
                                                        />
                                                    </svg>
                                                </a>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                        <div class="cart-table-footer">
                            @if (!Session::has('coupon'))
                                <form
                                    class="position-relative bg-body"
                                    method="POST"
                                    action="{{ route('cart.coupon.apply') }}"
                                >
                                    @csrf
                                    <input
                                        class="form-control"
                                        type="text"
                                        name="coupon_code"
                                        style="text-transform: uppercase"
                                        placeholder="@lang('Coupon Code')"
                                    >
                                    <input
                                        class="btn-link fw-medium position-absolute top-0 end-0 h-100 px-4"
                                        type="submit"
                                        style="text-transform: uppercase"
                                        value="@lang('Apply')"
                                    >
                                </form>
                            @else
                                <form
                                    class="position-relative bg-body"
                                    method="POST"
                                    action="{{ route('cart.coupon.remove') }}"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <input
                                        class="form-control text-success fw-bold"
                                        type="text"
                                        name="coupon_code"
                                        placeholder="Coupon Code"
                                        value="{{ session()->get('coupon')['code'] }}"
                                        readonly
                                    >
                                    <input
                                        class="btn-link fw-medium position-absolute top-0 end-0 h-100 px-4 text-danger"
                                        style="text-transform: uppercase"
                                        type="submit"
                                        value="@lang('Remove') @lang('Coupon')"
                                    >
                                </form>
                            @endif
                            <form
                                class="position-relative bg-body"
                                method="POST"
                                action="{{ route('cart.empty') }}"
                            >
                                @csrf
                                @method('DELETE')
                                <button
                                    class="btn btn-light"
                                    type="submit"
                                    style="text-transform: uppercase"
                                >@lang('Clear')</button>
                            </form>
                        </div>
                        <div>
                            @if (Session::has('success'))
                                <p class="text-success">{{ Session::get('success') }}</p>
                            @elseif (Session::has('error'))
                                <p class="text-danger">{{ Session::get('error') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="shopping-cart__totals-wrapper">
                        <div class="sticky-content">
                            <div class="shopping-cart__totals">
                                <h3>@lang('Cart Totals')</h3>
                                @if (Session::has('discounts'))
                                    <table class="cart-totals">
                                        <tbody>
                                            <tr>
                                                <th>@lang('Subtotal')</th>
                                                <td>${{ Cart::instance('cart')->subtotal() }}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('Discount') {{ Session::get('coupon')['code'] }}</th>
                                                <td>${{ Session::get('discounts')['discount'] }}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('Subtotal After Discount')</th>
                                                <td>${{ Session::get('discounts')['subtotal'] }}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('Shipping')</th>
                                                <td>
                                                    @lang('Free')
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>@lang('VAT')</th>
                                                <td>${{ Session::get('discounts')['tax'] }}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('Total')</th>
                                                <td>${{ Session::get('discounts')['total'] }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                @else
                                    <table class="cart-totals">
                                        <tbody>
                                            <tr>
                                                <th>@lang('Subtotal')</th>
                                                <td>${{ Cart::instance('cart')->subtotal() }}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('Shipping')</th>
                                                <td>
                                                    @lang('Free')
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>@lang('VAT')</th>
                                                <td>${{ Cart::instance('cart')->tax() }}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('Total')</th>
                                                <td>${{ Cart::instance('cart')->total() }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                @endif

                            </div>
                            <div class="mobile_fixed-btn_wrapper">
                                <div class="button-wrapper container">
                                    <a
                                        href="{{ route('cart.checkout') }}"
                                        class="btn btn-primary btn-checkout"
                                        style="text-transform: uppercase"
                                    >@lang('Proceed To Checkout')</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row">
                        <div class="col-md-12 text-center-pt-5 bp-5">
                            <p>@lang('No items found in your cart!')</p>
                            <a
                                href="{{ route('shop.index') }}"
                                class="btn btn-info"
                            >@lang('Shop now')</a>
                        </div>
                    </div>
                @endif

            </div>
        </section>
    </main>


    @push('scripts')
        <script>
            $(function() {
                $('.qty-control__increase').on('click', function() {
                    $(this).closest('form').submit();
                });
                $('.qty-control__reduce').on('click', function() {
                    $(this).closest('form').submit();
                });
                $('.remove-cart').on('click', function() {
                    $(this).closest('form').submit();
                });

            })
        </script>
    @endpush
</x-app>
