<x-app title="{{ __('My Account') }}">
    <style>
        .table> :not(caption)>tr>th {
            padding: 0.625rem 1.5rem .625rem !important;
            background-color: #6a6e51 !important;
        }

        .table>tr>td {
            padding: 0.625rem 1.5rem .625rem !important;
        }

        .table-bordered> :not(caption)>tr>th,
        .table-bordered> :not(caption)>tr>td {
            border-width: 1px 1px;
            border-color: #6a6e51;
        }

        .table> :not(caption)>tr>td {
            padding: .8rem 1rem !important;
        }

        .bg-success {
            background-color: #40c710 !important;
        }

        .bg-danger {
            background-color: #f44032 !important;
        }

        .bg-warning {
            background-color: #f5d700 !important;
            color: #000;
        }
    </style>
    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="my-account container">
            <h2 class="page-title">Wishlist</h2>
            <div class="row">
                <div class="col-lg-3">
                    @include('user.account-nav')
                </div>
                <div class="col-lg-9">
                    @if (Cart::instance('wishlist')->content()->count() > 0)
                        <div class="page-content my-account__wishlist">
                            <div
                                id="products-grid"
                                class="products-grid row row-cols-2 row-cols-lg-3"
                            >


                                @foreach ($items as $item)
                                    @php
                                        $product = \App\Models\Product::where('id', $item->id)->first();
                                        $locale = app()->getLocale();
                                    @endphp
                                    <div class="product-card-wrapper">
                                        <div class="product-card mb-3 mb-md-4 mb-xxl-5">
                                            <div class="pc__img-wrapper">
                                                <div
                                                    class="swiper-container background-img js-swiper-slider"
                                                    data-settings='{"resizeObserver": true}'
                                                >
                                                    <div class="swiper-wrapper">
                                                        <div class="swiper-slide">
                                                            <a
                                                                href="{{ route('shop.product.details', ['product_slug' => $product->slug]) }}"><img
                                                                    loading="lazy"
                                                                    src="{{ asset('uploads/products') }}/{{ $item->model->image }}"
                                                                    width="330"
                                                                    height="400"
                                                                    alt="{{ $product->translations->where('locale', $locale)->first()?->name ?? '' }}"
                                                                    class="pc__img"
                                                                ></a>

                                                        </div>

                                                    </div>

                                                </div>

                                                {{-- Remove item from Wishlist --}}
                                                <form
                                                    id="remove-item-{{ $item->id }}"
                                                    action="{{ route('wishlist.item.remove', ['rowId' => $item->rowId]) }}"
                                                    method="POST"
                                                >
                                                    @csrf
                                                    @method('DELETE')
                                                    <a
                                                        href="javascript:void(0)"
                                                        class="remove-cart"
                                                        onclick="document.getElementById('remove-item-{{ $item->id }}').submit();"
                                                    >
                                                        <button
                                                            class="btn-remove-from-wishlist"
                                                            title="{{ __('Remove from Wishlist') }}"
                                                        >
                                                            <svg
                                                                width="12"
                                                                height="12"
                                                                viewBox="0 0 12 12"
                                                                fill="none"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                            >
                                                                <use href="#icon_close" />
                                                            </svg>
                                                        </button>
                                                    </a>
                                                </form>
                                            </div>

                                            <div class="pc__info position-relative">
                                                <p class="pc__category">
                                                    {{ $product->category->translations->where('locale', $locale)->first()?->name ?? '' }}
                                                </p>
                                                <h6 class="pc__title">
                                                    {{ $product->translations->where('locale', $locale)->first()?->name ?? '' }}
                                                </h6>
                                                <div class="product-card__price d-flex">
                                                    <span class="money price">${{ $item->price }}</span>
                                                </div>
                                                <form
                                                    action="{{ route('wishlist.move.to.cart', ['rowId' => $item->rowId]) }}"
                                                    method="POST"
                                                >
                                                    @csrf
                                                    <button
                                                        class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist"
                                                        title="{{ __('Move To Cart') }}"
                                                    >
                                                        <svg
                                                            width="16"
                                                            height="16"
                                                            viewBox="0 0 20 20"
                                                            fill="none"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                        >
                                                            <use href="#icon_cart" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach


                            </div>
                        </div>
                    @else
                        <div class="row">
                            <div class="col-md-12 text-center-pt-5 bp-5">
                                <p>@lang('No items found in your wishlist!')</p>
                                <a
                                    href="{{ route('shop.index') }}"
                                    class="btn btn-info"
                                >@lang('To Shop')</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </main>
</x-app>
