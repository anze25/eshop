<x-app-layout title="{{ __('Details') }}">
    <style>
        .filled-heart {
            color: orange
        }

        .btn-wishlist {
            display: flex;
            align-items: center;
            gap: 0.625rem;
            padding: 0 0 0.625rem;
            text-transform: uppercase;
            border: 0;
            background-color: transparent;
            font-weight: 500;
        }
    </style>
    <main class="pt-90">
        @php
            $locale = app()->getLocale();

            $translatedName = $product->translations->where('locale', $locale)->first()->name ?? $product->name;

        @endphp
        <div class="mb-md-1 pb-md-3"></div>
        <section class="product-single container">
            <div class="row">
                <div class="col-lg-7">
                    <div
                        class="product-single__media"
                        data-media-type="vertical-thumbnail"
                    >
                        <div class="product-single__image">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide product-single__image-item">
                                        <img
                                            loading="lazy"
                                            class="h-auto"
                                            src="{{ asset('uploads/products') }}/{{ $product->image }}"
                                            width="674"
                                            height="674"
                                            alt=""
                                        />
                                        <a
                                            data-fancybox="gallery"
                                            href="{{ asset('uploads/products') }}/{{ $product->image }}"
                                            data-bs-toggle="tooltip"
                                            data-bs-placement="left"
                                            title="Zoom"
                                        >
                                            <svg
                                                width="16"
                                                height="16"
                                                viewBox="0 0 16 16"
                                                fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
                                            >
                                                <use href="#icon_zoom" />
                                            </svg>
                                        </a>
                                    </div>

                                    @foreach (explode(',', $product->images) as $gimg)
                                        <div class="swiper-slide product-single__image-item">
                                            <img
                                                loading="lazy"
                                                class="h-auto"
                                                src="{{ asset('uploads/products') }}/{{ $gimg }}"
                                                width="674"
                                                height="674"
                                                alt=""
                                            />
                                            <a
                                                data-fancybox="gallery"
                                                href="{{ asset('uploads/products') }}/{{ $gimg }}"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="left"
                                                title="Zoom"
                                            >
                                                <svg
                                                    width="16"
                                                    height="16"
                                                    viewBox="0 0 16 16"
                                                    fill="none"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <use href="#icon_zoom" />
                                                </svg>
                                            </a>
                                        </div>
                                    @endforeach


                                </div>
                                <div class="swiper-button-prev"><svg
                                        width="7"
                                        height="11"
                                        viewBox="0 0 7 11"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <use href="#icon_prev_sm" />
                                    </svg></div>
                                <div class="swiper-button-next"><svg
                                        width="7"
                                        height="11"
                                        viewBox="0 0 7 11"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <use href="#icon_next_sm" />
                                    </svg></div>
                            </div>
                        </div>
                        <div class="product-single__thumbnail">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide product-single__image-item"><img
                                            loading="lazy"
                                            class="h-auto"
                                            src="{{ asset('uploads/products/thumbnails') }}/{{ $product->image }}"
                                            width="104"
                                            height="104"
                                            alt=""
                                        /></div>
                                    @foreach (explode(',', $product->images) as $gimg)
                                        <div class="swiper-slide product-single__image-item"><img
                                                loading="lazy"
                                                class="h-auto"
                                                src="{{ asset('uploads/products/thumbnails') }}/{{ $gimg }}"
                                                width="104"
                                                height="104"
                                                alt=""
                                            /></div>
                                    @endforeach


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="d-flex justify-content-between mb-4 pb-md-2">
                        <div class="breadcrumb mb-0 d-none d-md-block flex-grow-1">

                            <a
                                href="{{ route('shop.index') }}"
                                class="menu-link menu-link_us-s text-uppercase fw-medium"
                            >@lang('Shop')</a>
                        </div><!-- /.breadcrumb -->


                    </div>
                    <h1 class="product-single__name">
                        {{ $product->translations->where('locale', $locale)->first()?->name ?? '' }}</h1>
                    <div class="product-single__rating">
                        <div class="reviews-group d-flex">
                            <svg
                                class="review-star"
                                viewBox="0 0 9 9"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <use href="#icon_star" />
                            </svg>
                            <svg
                                class="review-star"
                                viewBox="0 0 9 9"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <use href="#icon_star" />
                            </svg>
                            <svg
                                class="review-star"
                                viewBox="0 0 9 9"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <use href="#icon_star" />
                            </svg>
                            <svg
                                class="review-star"
                                viewBox="0 0 9 9"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <use href="#icon_star" />
                            </svg>
                            <svg
                                class="review-star"
                                viewBox="0 0 9 9"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <use href="#icon_star" />
                            </svg>
                        </div>
                        <span class="reviews-note text-lowercase text-secondary ms-1">8k+ reviews</span>
                    </div>
                    <div class="product-single__price">
                        <span class="current-price">
                            @if ($product->sale_price)
                                <s>${{ $product->regular_price }}</s> ${{ $product->sale_price }}
                            @else
                                ${{ $product->regular_price }}
                            @endif
                        </span>
                    </div>
                    <div class="product-single__short-desc">
                        <p>{{ $product->translations->where('locale', $locale)->first()?->short_description ?? '' }}
                        </p>
                    </div>
                    @if (Cart::instance('cart')->content()->where('id', $product->id)->count() > 0)
                        <a
                            href="{{ route('cart.index') }}"
                            class="btn btn-warning mb-3"
                        >@lang('Go To Cart')</a>
                    @else
                        <form
                            name="addtocart-form"
                            method="post"
                            action="{{ route('cart.add') }}"
                        >
                            @csrf
                            <div class="product-single__addtocart">
                                <div class="qty-control position-relative">
                                    <input
                                        type="number"
                                        name="quantity"
                                        value="1"
                                        min="1"
                                        class="qty-control__number text-center"
                                    >
                                    <div class="qty-control__reduce">-</div>
                                    <div class="qty-control__increase">+</div>
                                </div><!-- .qty-control -->
                                <input
                                    type="hidden"
                                    name="id"
                                    value="{{ $product->id }}"
                                >

                                <input
                                    type="hidden"
                                    name="name"
                                    value="{{ e($product->translations->where('locale', $locale)->first()->name ?? $product->name) }}"
                                >
                                <input
                                    type="hidden"
                                    name="price"
                                    value="{{ $product->sale_price == '' ? $product->regular_price : $product->sale_price }}"
                                >
                                <button
                                    type="submit"
                                    class="btn btn-primary btn-addtocart"
                                    data-aside="cartDrawer"
                                >@lang('Add To Cart')</button>
                            </div>
                        </form>
                    @endif

                    <div class="product-single__addtolinks">
                        @if (Cart::instance('wishlist')->content()->where('id', $product->id)->count() > 0)
                            <form
                                id="frm-remove-item"
                                action="{{ route('wishlist.item.remove', ['rowId' => Cart::instance('wishlist')->content()->where('id', $product->id)->first()->rowId]) }}"
                                method="POST"
                            >
                                @csrf
                                @method('DELETE')
                                <a
                                    href="javascript:void(0)"
                                    class="menu-link menu-link_us-s add-to-wishlist filled-heart btn-wishlist"
                                    onclick="document.getElementById('frm-remove-item').submit();"
                                ><svg
                                        width="16"
                                        height="16"
                                        viewBox="0 0 20 20"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <use href="#icon_heart" />
                                    </svg><span>@lang('Remove from Wishlist')</span></a>
                            </form>
                        @elseif (Cart::instance('cart')->content()->where('id', $product->id)->count() == 0)
                            <form
                                id="wishlist-form"
                                action="{{ route('wishlist.add') }}"
                                method="POST"
                            >
                                @csrf
                                <input
                                    type="hidden"
                                    name="id"
                                    value="{{ $product->id }}"
                                />
                                <input
                                    type="hidden"
                                    name="name"
                                    value="{{ $product->translations->where('locale', $locale)->first()?->name ?? '' }}"
                                />
                                <input
                                    type="hidden"
                                    name="price"
                                    value="{{ $product->sale_price == '' ? $product->regular_price : $product->sale_price }}"
                                />
                                <input
                                    type="hidden"
                                    name="quantity"
                                    value="1"
                                />
                                <a
                                    href="javascript:void(0)"
                                    class="menu-link menu-link_us-s add-to-wishlist btn-wishlist"
                                    onclick="document.getElementById('wishlist-form').submit();"
                                ><svg
                                        width="16"
                                        height="16"
                                        viewBox="0 0 20 20"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <use href="#icon_heart" />
                                    </svg><span>@lang('Add To Wishlist')</span></a>
                            </form>
                        @endif


                        <script
                            src="js/details-disclosure.html"
                            defer="defer"
                        ></script>
                        <script
                            src="js/share.html"
                            defer="defer"
                        ></script>
                    </div>
                    <div class="product-single__meta-info">
                        <div class="meta-item">
                            <label>SKU:</label>
                            <span>{{ $product->SKU }}</span>
                        </div>
                        <div class="meta-item">
                            <label>@lang('Category'):</label>
                            <span>{{ $product->category->translations->where('locale', $locale)->first()?->name ?? '' }}</span>
                        </div>
                        <div class="meta-item">
                            <label>@lang('Tags'):</label>
                            <span>N/A</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-single__details-tab">
                <ul
                    id="myTab"
                    class="nav nav-tabs"
                    role="tablist"
                >
                    <li
                        class="nav-item"
                        role="presentation"
                    >
                        <a
                            id="tab-description-tab"
                            class="nav-link nav-link_underscore active"
                            data-bs-toggle="tab"
                            href="#tab-description"
                            role="tab"
                            aria-controls="tab-description"
                            aria-selected="true"
                        >@lang('Description')</a>
                    </li>
                    <li
                        class="nav-item"
                        role="presentation"
                    >
                        <a
                            id="tab-additional-info-tab"
                            class="nav-link nav-link_underscore"
                            data-bs-toggle="tab"
                            href="#tab-additional-info"
                            role="tab"
                            aria-controls="tab-additional-info"
                            aria-selected="false"
                        >@lang('Additional Information')</a>
                    </li>
                    <li
                        class="nav-item"
                        role="presentation"
                    >
                        <a
                            id="tab-reviews-tab"
                            class="nav-link nav-link_underscore"
                            data-bs-toggle="tab"
                            href="#tab-reviews"
                            role="tab"
                            aria-controls="tab-reviews"
                            aria-selected="false"
                        >@lang('Reviews') (2)</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div
                        id="tab-description"
                        class="tab-pane fade show active"
                        role="tabpanel"
                        aria-labelledby="tab-description-tab"
                    >
                        <div class="product-single__description">
                            {{ $product->translations->where('locale', $locale)->first()?->description ?? '' }}
                        </div>
                    </div>
                    <div
                        id="tab-additional-info"
                        class="tab-pane fade"
                        role="tabpanel"
                        aria-labelledby="tab-additional-info-tab"
                    >
                        <div class="product-single__addtional-info">
                            <div class="item">
                                <label class="h6">@lang('Weight')</label>
                                <span>1.25 kg</span>
                            </div>
                            <div class="item">
                                <label class="h6">@lang('Dimensions')</label>
                                <span>90 x 60 x 90 cm</span>
                            </div>
                            <div class="item">
                                <label class="h6">@lang('Size')</label>
                                <span>XS, S, M, L, XL</span>
                            </div>
                            <div class="item">
                                <label class="h6">@lang('Color')</label>
                                <span>Black, Orange, White</span>
                            </div>
                            <div class="item">
                                <label class="h6">@lang('Storage')</label>
                                <span>Relaxed fit shirt-style dress with a rugged</span>
                            </div>
                        </div>
                    </div>
                    <div
                        id="tab-reviews"
                        class="tab-pane fade"
                        role="tabpanel"
                        aria-labelledby="tab-reviews-tab"
                    >
                        <h2 class="product-single__reviews-title">@lang('Reviews')</h2>
                        <div class="product-single__reviews-list">
                            <div class="product-single__reviews-item">
                                <div class="customer-avatar">
                                    <img
                                        loading="lazy"
                                        src="assets/images/avatar.jpg"
                                        alt=""
                                    />
                                </div>
                                <div class="customer-review">
                                    <div class="customer-name">
                                        <h6>Janice Miller</h6>
                                        <div class="reviews-group d-flex">
                                            <svg
                                                class="review-star"
                                                viewBox="0 0 9 9"
                                                xmlns="http://www.w3.org/2000/svg"
                                            >
                                                <use href="#icon_star" />
                                            </svg>
                                            <svg
                                                class="review-star"
                                                viewBox="0 0 9 9"
                                                xmlns="http://www.w3.org/2000/svg"
                                            >
                                                <use href="#icon_star" />
                                            </svg>
                                            <svg
                                                class="review-star"
                                                viewBox="0 0 9 9"
                                                xmlns="http://www.w3.org/2000/svg"
                                            >
                                                <use href="#icon_star" />
                                            </svg>
                                            <svg
                                                class="review-star"
                                                viewBox="0 0 9 9"
                                                xmlns="http://www.w3.org/2000/svg"
                                            >
                                                <use href="#icon_star" />
                                            </svg>
                                            <svg
                                                class="review-star"
                                                viewBox="0 0 9 9"
                                                xmlns="http://www.w3.org/2000/svg"
                                            >
                                                <use href="#icon_star" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="review-date">April 06, 2023</div>
                                    <div class="review-text">
                                        <p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit
                                            quo
                                            minus id quod
                                            maxime placeat facere possimus, omnis voluptas assumenda est…</p>
                                    </div>
                                </div>
                            </div>
                            <div class="product-single__reviews-item">
                                <div class="customer-avatar">
                                    <img
                                        loading="lazy"
                                        src="assets/images/avatar.jpg"
                                        alt=""
                                    />
                                </div>
                                <div class="customer-review">
                                    <div class="customer-name">
                                        <h6>Benjam Porter</h6>
                                        <div class="reviews-group d-flex">
                                            <svg
                                                class="review-star"
                                                viewBox="0 0 9 9"
                                                xmlns="http://www.w3.org/2000/svg"
                                            >
                                                <use href="#icon_star" />
                                            </svg>
                                            <svg
                                                class="review-star"
                                                viewBox="0 0 9 9"
                                                xmlns="http://www.w3.org/2000/svg"
                                            >
                                                <use href="#icon_star" />
                                            </svg>
                                            <svg
                                                class="review-star"
                                                viewBox="0 0 9 9"
                                                xmlns="http://www.w3.org/2000/svg"
                                            >
                                                <use href="#icon_star" />
                                            </svg>
                                            <svg
                                                class="review-star"
                                                viewBox="0 0 9 9"
                                                xmlns="http://www.w3.org/2000/svg"
                                            >
                                                <use href="#icon_star" />
                                            </svg>
                                            <svg
                                                class="review-star"
                                                viewBox="0 0 9 9"
                                                xmlns="http://www.w3.org/2000/svg"
                                            >
                                                <use href="#icon_star" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="review-date">April 06, 2023</div>
                                    <div class="review-text">
                                        <p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit
                                            quo
                                            minus id quod
                                            maxime placeat facere possimus, omnis voluptas assumenda est…</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-single__review-form">
                            <form name="customer-review-form">
                                <h5>Be the first to review “Message Cotton T-Shirt”</h5>
                                <p>Your email address will not be published. Required fields are marked *</p>
                                <div class="select-star-rating">
                                    <label>Your rating *</label>
                                    <span class="star-rating">
                                        <svg
                                            class="star-rating__star-icon"
                                            width="12"
                                            height="12"
                                            fill="#ccc"
                                            viewBox="0 0 12 12"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z"
                                            />
                                        </svg>
                                        <svg
                                            class="star-rating__star-icon"
                                            width="12"
                                            height="12"
                                            fill="#ccc"
                                            viewBox="0 0 12 12"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z"
                                            />
                                        </svg>
                                        <svg
                                            class="star-rating__star-icon"
                                            width="12"
                                            height="12"
                                            fill="#ccc"
                                            viewBox="0 0 12 12"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z"
                                            />
                                        </svg>
                                        <svg
                                            class="star-rating__star-icon"
                                            width="12"
                                            height="12"
                                            fill="#ccc"
                                            viewBox="0 0 12 12"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z"
                                            />
                                        </svg>
                                        <svg
                                            class="star-rating__star-icon"
                                            width="12"
                                            height="12"
                                            fill="#ccc"
                                            viewBox="0 0 12 12"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z"
                                            />
                                        </svg>
                                    </span>
                                    <input
                                        id="form-input-rating"
                                        type="hidden"
                                        value=""
                                    />
                                </div>
                                <div class="mb-4">
                                    <textarea
                                        id="form-input-review"
                                        class="form-control form-control_gray"
                                        placeholder="Your Review"
                                        cols="30"
                                        rows="8"
                                    ></textarea>
                                </div>
                                <div class="form-label-fixed mb-4">
                                    <label
                                        for="form-input-name"
                                        class="form-label"
                                    >Name *</label>
                                    <input
                                        id="form-input-name"
                                        class="form-control form-control-md form-control_gray"
                                    >
                                </div>
                                <div class="form-label-fixed mb-4">
                                    <label
                                        for="form-input-email"
                                        class="form-label"
                                    >Email address *</label>
                                    <input
                                        id="form-input-email"
                                        class="form-control form-control-md form-control_gray"
                                    >
                                </div>
                                <div class="form-check mb-4">
                                    <input
                                        id="remember_checkbox"
                                        class="form-check-input form-check-input_fill"
                                        type="checkbox"
                                        value=""
                                    >
                                    <label
                                        class="form-check-label"
                                        for="remember_checkbox"
                                    >
                                        Save my name, email, and website in this browser for the next time I comment.
                                    </label>
                                </div>
                                <div class="form-action">
                                    <button
                                        type="submit"
                                        class="btn btn-primary"
                                    >Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @if ($relatedProducts->count() > 0)
            <section class="products-carousel container">
                <h2 class="h3 text-uppercase mb-4 pb-xl-2 mb-xl-4">@lang('Related Products')</h2>

                <div
                    id="related_products"
                    class="position-relative"
                >
                    <div
                        class="swiper-container js-swiper-slider"
                        data-settings='{
    "autoplay": false,
    "slidesPerView": 4,
    "slidesPerGroup": 4,
    "effect": "none",
    "loop": true,
    "pagination": {
      "el": "#related_products .products-pagination",
      "type": "bullets",
      "clickable": true
    },
    "navigation": {
      "nextEl": "#related_products .products-carousel__next",
      "prevEl": "#related_products .products-carousel__prev"
    },
    "breakpoints": {
      "320": {
        "slidesPerView": 2,
        "slidesPerGroup": 2,
        "spaceBetween": 14
      },
      "768": {
        "slidesPerView": 3,
        "slidesPerGroup": 3,
        "spaceBetween": 24
      },
      "992": {
        "slidesPerView": 4,
        "slidesPerGroup": 4,
        "spaceBetween": 30
      }
    }
  }'
                    >
                        <div class="swiper-wrapper">
                            @foreach ($relatedProducts as $relatedProduct)
                                <div class="swiper-slide product-card">
                                    <div class="pc__img-wrapper">
                                        <a
                                            href="{{ route('shop.product.details', ['product_slug' => $relatedProduct->slug]) }}">
                                            <img
                                                loading="lazy"
                                                src="{{ asset('uploads/products') }}/{{ $relatedProduct->image }}"
                                                width="330"
                                                height="400"
                                                alt="{{ $relatedProduct->translations->where('locale', $locale)->first()?->name ?? '' }}"
                                                class="pc__img"
                                            >
                                            @foreach (explode(',', $relatedProduct->images) as $gimg)
                                                <img
                                                    loading="lazy"
                                                    src="{{ asset('uploads/products') }}/{{ $gimg }}"
                                                    width="330"
                                                    height="400"
                                                    alt="{{ $relatedProduct->translations->where('locale', $locale)->first()?->name ?? '' }}"
                                                    class="pc__img pc__img-second"
                                                >
                                            @endforeach

                                        </a>
                                        @if (Cart::instance('cart')->content()->where('id', $relatedProduct->id)->count() > 0)
                                            <a
                                                href="{{ route('cart.index') }}"
                                                class="pc__atc btn anim_appear-bottom btn position-absolute border-0 text-uppercase fw-medium btn-warning"
                                            >@lang('Go To Cart')</a>
                                        @else
                                            <form
                                                name="addtocart-form"
                                                method="post"
                                                action="{{ route('cart.add') }}"
                                            >
                                                @csrf
                                                <input
                                                    type="hidden"
                                                    name="id"
                                                    value="{{ $relatedProduct->id }}"
                                                >
                                                <input
                                                    type="hidden"
                                                    name="quantity"
                                                    value="1"
                                                >
                                                <input
                                                    type="hidden"
                                                    name="name"
                                                    value="{{ $relatedProduct->translations->where('locale', $locale)->first()?->name ?? '' }}"
                                                >
                                                <input
                                                    type="hidden"
                                                    name="price"
                                                    value="{{ $relatedProduct->sale_price == '' ? $relatedProduct->regular_price : $relatedProduct->sale_price }}"
                                                >
                                                <button
                                                    type="submit"
                                                    class="pc__atc btn anim_appear-bottom btn position-absolute border-0 text-uppercase fw-medium"
                                                    data-aside="cartDrawer"
                                                    title="{{ __('Add To Cart') }}"
                                                >@lang('Add To Cart')</button>
                                            </form>
                                        @endif
                                    </div>

                                    <div class="pc__info position-relative">
                                        <p class="pc__category">
                                            {{ $relatedProduct->category->translations->where('locale', $locale)->first()?->name ?? '' }}
                                        </p>
                                        <h6 class="pc__title"><a
                                                href="details.html">{{ $relatedProduct->translations->where('locale', $locale)->first()?->name ?? '' }}</a>
                                        </h6>
                                        <div class="product-card__price d-flex">
                                            <span class="money price">
                                                @if ($product->sale_price)
                                                    <s>${{ $product->regular_price }}</s> ${{ $product->sale_price }}
                                                @else
                                                    ${{ $product->regular_price }}
                                                @endif
                                            </span>
                                        </div>

                                        <button
                                            class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist"
                                            title="Add To Wishlist"
                                        >
                                            <svg
                                                width="16"
                                                height="16"
                                                viewBox="0 0 20 20"
                                                fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
                                            >
                                                <use href="#icon_heart" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            @endforeach

                        </div><!-- /.swiper-wrapper -->
                    </div><!-- /.swiper-container js-swiper-slider -->

                    <div
                        class="products-carousel__prev position-absolute top-50 d-flex align-items-center justify-content-center">
                        <svg
                            width="25"
                            height="25"
                            viewBox="0 0 25 25"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <use href="#icon_prev_md" />
                        </svg>
                    </div><!-- /.products-carousel__prev -->
                    <div
                        class="products-carousel__next position-absolute top-50 d-flex align-items-center justify-content-center">
                        <svg
                            width="25"
                            height="25"
                            viewBox="0 0 25 25"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <use href="#icon_next_md" />
                        </svg>
                    </div><!-- /.products-carousel__next -->

                    <div class="products-pagination mt-4 mb-5 d-flex align-items-center justify-content-center"></div>
                    <!-- /.products-pagination -->
                </div><!-- /.position-relative -->

            </section><!-- /.products-carousel container -->
        @endif
    </main>
</x-app-layout>
