<x-app-layout title="{{ __('Shop') }}">
    <style>
        .brand-list li,
        .category-list li {
            line-height: 40px;
        }

        .brand-list li .chk-brand,
        .category-list li .chk-category {
            width: 1rem;
            height: 1rem;
            color: #e4e4e4;
            border: 0.125rem solid currentColor;
            border-radius: 0;
            margin-right: 0.75rem;
        }

        .filled-heart {
            color: orange;
        }
    </style>

    <main class="pt-90">
        @php
            $locale = app()->getLocale();
        @endphp
        <section class="shop-main container d-flex pt-4 pt-xl-5">
            <div
                id="shopFilter"
                class="shop-sidebar side-sticky bg-body"
            >
                <div class="aside-header d-flex d-lg-none align-items-center">
                    <h3 class="text-uppercase fs-6 mb-0">Filter By</h3>
                    <button class="btn-close-lg js-close-aside btn-close-aside ms-auto"></button>
                </div>

                <div class="pt-4 pt-lg-0"></div>

                <div
                    id="categories-list"
                    class="accordion"
                >
                    <div class="accordion-item mb-4 pb-3">
                        <h5
                            id="accordion-heading-1"
                            class="accordion-header"
                        >
                            <button
                                class="accordion-button p-0 border-0 fs-5 text-uppercase"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#accordion-filter-1"
                                aria-expanded="true"
                            >

                                @lang('Product Categories')
                                <svg
                                    class="accordion-button__icon type2"
                                    viewBox="0 0 10 6"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <g
                                        aria-hidden="true"
                                        stroke="none"
                                        fill-rule="evenodd"
                                    >
                                        <path
                                            d="M5.35668 0.159286C5.16235 -0.053094 4.83769 -0.0530941 4.64287 0.159286L0.147611 5.05963C-0.0492049 5.27473 -0.049205 5.62357 0.147611 5.83813C0.344427 6.05323 0.664108 6.05323 0.860924 5.83813L5 1.32706L9.13858 5.83867C9.33589 6.05378 9.65507 6.05378 9.85239 5.83867C10.0492 5.62357 10.0492 5.27473 9.85239 5.06018L5.35668 0.159286Z"
                                        />
                                    </g>
                                </svg>
                            </button>
                        </h5>
                        <div
                            id="accordion-filter-1"
                            class="accordion-collapse collapse show border-0"
                            aria-labelledby="accordion-heading-1"
                            data-bs-parent="#categories-list"
                        >

                            <div class="accordion-body px-0 pb-0 pt-3 category-list">
                                <ul
                                    id="category-list"
                                    class="list list-inline mb-0"
                                >
                                    <li class="list-item">
                                        <span class="menu-link py-1">
                                            <input
                                                id=""
                                                type="checkbox"
                                                name="categories"
                                                class="chk-category"
                                                value="all"
                                            />
                                        </span>
                                        @lang('All Categories')
                                        <span class="text-right float-end">
                                            {{ \App\Models\Product::count() }}
                                        </span>
                                    </li>
                                    @foreach ($categories->take(5) as $category)
                                        <!-- Show only first 5 -->
                                        <li class="list-item">
                                            <span class="menu-link py-1">
                                                <input
                                                    type="checkbox"
                                                    name="categories"
                                                    value="{{ $category->id }}"
                                                    @if (in_array($category->id, explode(',', $filteredCategories))) checked='checked' @endif
                                                    class="chk-category"
                                                />
                                            </span>
                                            {{ $category->translations->where('locale', $locale)->first()?->name ?? '' }}
                                            <span class="text-right float-end">
                                                {{ $category->products->count() }}
                                            </span>
                                        </li>
                                    @endforeach

                                    <div
                                        id="hidden-categories"
                                        style="display: none;"
                                    >
                                        @foreach ($categories->slice(5) as $category)
                                            <!-- Rest of the categories -->
                                            <li class="list-item">
                                                <span class="menu-link py-1">
                                                    <input
                                                        type="checkbox"
                                                        name="categories"
                                                        value="{{ $category->id }}"
                                                        @if (in_array($category->id, explode(',', $filteredCategories))) checked='checked' @endif
                                                        class="chk-category"
                                                    />
                                                </span>
                                                {{ $category->translations->where('locale', $locale)->first()?->name ?? '' }}
                                                <span class="text-right float-end">
                                                    {{ $category->products->count() }}
                                                </span>
                                            </li>
                                        @endforeach
                                    </div>
                                </ul>
                                <!-- Show More Button -->
                                @if ($categories->count() > 5)
                                    <button
                                        id="show-more-btn-cat"
                                        class="btn btn-link text-primary mt-2"
                                    >@lang('Show More Categories')</button>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>

                <div
                    id="brand-filters"
                    class="accordion"
                >
                    <div class="accordion-item mb-4 pb-3">
                        <h5
                            id="accordion-heading-brand"
                            class="accordion-header"
                        >
                            <button
                                class="accordion-button p-0 border-0 fs-5 text-uppercase"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#accordion-filter-brand"
                                aria-controls="accordion-filter-brand"
                                aria-expanded="true"
                            >
                                @lang('Brands')
                                <svg
                                    class="accordion-button__icon type2"
                                    viewBox="0 0 10 6"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <g
                                        aria-hidden="true"
                                        stroke="none"
                                        fill-rule="evenodd"
                                    >
                                        <path
                                            d="M5.35668 0.159286C5.16235 -0.053094 4.83769 -0.0530941 4.64287 0.159286L0.147611 5.05963C-0.0492049 5.27473 -0.049205 5.62357 0.147611 5.83813C0.344427 6.05323 0.664108 6.05323 0.860924 5.83813L5 1.32706L9.13858 5.83867C9.33589 6.05378 9.65507 6.05378 9.85239 5.83867C10.0492 5.62357 10.0492 5.27473 9.85239 5.06018L5.35668 0.159286Z"
                                        />
                                    </g>
                                </svg>
                            </button>
                        </h5>
                        <div
                            id="accordion-filter-brand"
                            class="accordion-collapse collapse show border-0"
                            aria-labelledby="accordion-heading-brand"
                            data-bs-parent="#brand-filters"
                        >
                            <div class="search-field multi-select accordion-body px-0 pb-0 brand-list">
                                <ul class="list list-inline mb-0">
                                    <li class="list-item">
                                        <span class="menu-link py-1">
                                            <input
                                                id=""
                                                type="checkbox"
                                                name="brands"
                                                class="chk-brand"
                                                value="all"
                                            />
                                        </span>
                                        @lang('All Brands')
                                        <span class="text-right float-end">
                                            {{ \App\Models\Product::count() }}
                                        </span>
                                    </li>

                                    @foreach ($brands->take(5) as $brand)
                                        <!-- Show only first 5 -->
                                        <li class="list-item">
                                            <span class="menu-link py-1">
                                                <input
                                                    type="checkbox"
                                                    name="brands"
                                                    value="{{ $brand->id }}"
                                                    @if (in_array($brand->id, explode(',', $filteredBrands))) checked='checked' @endif
                                                    class="chk-brand"
                                                />
                                            </span>
                                            {{ $brand->name }}
                                            <span class="text-right float-end">

                                                {{ $brand->products->count() }}

                                            </span>
                                        </li>
                                    @endforeach

                                    <div
                                        id="hidden-brands"
                                        style="display: none;"
                                    >
                                        @foreach ($brands->slice(5) as $brand)
                                            <li class="list-item">
                                                <span class="menu-link py-1">
                                                    <input
                                                        id=""
                                                        type="checkbox"
                                                        name="brands"
                                                        class="chk-brand"
                                                        value="{{ $brand->id }}"
                                                        @if (in_array($brand->id, explode(',', $filteredBrands))) checked='checked' @endif
                                                    />{{ $brand->name }}
                                                </span>

                                                <span class="text-right float-end">
                                                    {{ $brand->filtered_count }}
                                                </span>
                                            </li>
                                        @endforeach
                                    </div>

                                </ul>
                                <!-- Show More Button -->
                                @if ($brands->count() > 5)
                                    <button
                                        id="show-more-btn-brd"
                                        class="btn btn-link text-primary mt-2"
                                    >@lang('Show More Brands')</button>
                                @endif



                            </div>
                        </div>
                    </div>
                </div>


                <div
                    id="price-filters"
                    class="accordion"
                >
                    <div class="accordion-item mb-4">
                        <h5
                            id="accordion-heading-price"
                            class="accordion-header mb-2"
                        >
                            <button
                                class="accordion-button p-0 border-0 fs-5 text-uppercase"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#accordion-filter-price"
                                aria-expanded="true"
                                aria-controls="accordion-filter-price"
                            >
                                @lang('Price')


                                <!-- SVG Moved to End -->
                                <span
                                    id="reset-price"
                                    class="btn-close-lg ms-auto"
                                >

                                </span>
                            </button>

                        </h5>
                        <div
                            id="accordion-filter-price"
                            class="accordion-collapse collapse show border-0"
                            aria-labelledby="accordion-heading-price"
                            data-bs-parent="#price-filters"
                        >
                            <input
                                class="price-range-slider"
                                type="text"
                                name="price_range"
                                value=""
                                data-slider-min="{{ $current_min_price }}"
                                data-slider-max="{{ $current_max_price }}"
                                data-slider-step="5"
                                data-slider-value="[{{ $min_price }},{{ $max_price }}]"
                                data-currency="$"
                            />
                            <div class="price-range__info d-flex align-items-center mt-2">
                                <div class="me-auto">
                                    <span class="text-secondary">@lang('Min Price') </span>
                                    <span class="price-range__min">${{ $current_min_price }}</span>
                                </div>
                                <div>
                                    <span class="text-secondary">@lang('Max Price') </span>
                                    <span class="price-range__max">${{ $current_max_price }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="shop-list flex-grow-1">
                <div
                    class="swiper-container js-swiper-slider slideshow slideshow_small slideshow_split"
                    data-settings='{
          "autoplay": {
            "delay": 5000
          },
          "slidesPerView": 1,
          "effect": "fade",
          "loop": true,
          "pagination": {
            "el": ".slideshow-pagination",
            "type": "bullets",
            "clickable": true
          }
        }'
                >
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="slide-split h-100 d-block d-md-flex overflow-hidden">
                                <div
                                    class="slide-split_text position-relative d-flex align-items-center"
                                    style="background-color: #f5e6e0;"
                                >
                                    <div class="slideshow-text container p-3 p-xl-5">
                                        <h2
                                            class="text-uppercase section-title fw-normal mb-3 animate animate_fade animate_btt animate_delay-2">
                                            {!! nl2br(e(__('banner.title'))) !!}
                                        </h2>

                                        <p class="mb-0 animate animate_fade animate_btt animate_delay-5">
                                            {{ __('banner.subtitle') }}
                                        </p>
                                    </div>
                                </div>
                                <div class="slide-split_media position-relative">
                                    <div
                                        class="slideshow-bg"
                                        style="background-color: #f5e6e0;"
                                    >
                                        <img
                                            loading="lazy"
                                            src="assets/images/shop/shop_banner3.jpg"
                                            width="630"
                                            height="450"
                                            alt="Women's accessories"
                                            class="slideshow-bg__img object-fit-cover"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="swiper-slide">
                            <div class="slide-split h-100 d-block d-md-flex overflow-hidden">
                                <div
                                    class="slide-split_text position-relative d-flex align-items-center"
                                    style="background-color: #03add1;"
                                >
                                    <div class="slideshow-text container p-3 p-xl-5">
                                        <h2
                                            class="text-uppercase section-title fw-normal mb-3 animate animate_fade animate_btt animate_delay-2">
                                            {!! nl2br(e(__('banner.title'))) !!}
                                        </h2>

                                        <p class="mb-0 animate animate_fade animate_btt animate_delay-5">
                                            {{ __('banner.subtitle') }}
                                        </p>

                                    </div>
                                </div>
                                <div class="slide-split_media position-relative">
                                    <div
                                        class="slideshow-bg"
                                        style="background-color: #6f90c2;"
                                    >
                                        <img
                                            loading="lazy"
                                            src="assets/images/shop/shop_banner4.jpg"
                                            width="630"
                                            height="450"
                                            alt="Women's accessories"
                                            class="slideshow-bg__img object-fit-cover"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                        {{-- <div class="swiper-slide">
                            <div class="slide-split h-100 d-block d-md-flex overflow-hidden">
                                <div
                                    class="slide-split_text position-relative d-flex align-items-center"
                                    style="background-color: #f5e6e0;"
                                >
                                    <div class="slideshow-text container p-3 p-xl-5">
                                        <h2
                                            class="text-uppercase section-title fw-normal mb-3 animate animate_fade animate_btt animate_delay-2">
                                            Women's <br /><strong>ACCESSORIES</strong></h2>
                                        <p class="mb-0 animate animate_fade animate_btt animate_delay-5">Accessories
                                            are
                                            the best way to
                                            update your look. Add a title edge with new styles and new colors, or go for
                                            timeless pieces.</h6>
                                    </div>
                                </div>
                                <div class="slide-split_media position-relative">
                                    <div
                                        class="slideshow-bg"
                                        style="background-color: #f5e6e0;"
                                    >
                                        <img
                                            loading="lazy"
                                            src="assets/images/shop/shop_banner3.jpg"
                                            width="630"
                                            height="450"
                                            alt="Women's accessories"
                                            class="slideshow-bg__img object-fit-cover"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>

                    <div class="container p-3 p-xl-5">
                        <div
                            class="slideshow-pagination d-flex align-items-center position-absolute bottom-0 mb-4 pb-xl-2">
                        </div>

                    </div>
                </div>

                <div class="mb-3 pb-2 pb-xl-3"></div>

                <div class="d-flex justify-content-between mb-4 pb-md-2">
                    <div class="breadcrumb mb-0 d-none d-md-block flex-grow-1">


                        @lang('Total') {{ $products->total() }}
                        {{ trans_choice('pluralization.items', $products->total()) }}



                    </div>

                    <div
                        class="shop-acs d-flex align-items-center justify-content-between justify-content-md-end flex-grow-1">
                        <label
                            for=""
                            class="shop-acs__select"
                        >@lang('Per Page')</label>
                        <select
                            id="pagesize"
                            class="shop-acs__select form-select w-auto border-0 py-0 order-1 order-md-0"
                            aria-label="Page Size"
                            name="pagesize"
                            style="margin-right: 20px"
                        >
                            <option
                                value=6
                                {{ $size == 6 ? 'selected' : '' }}
                            >6</option>
                            <option
                                value="12"
                                {{ $size == 12 ? 'selected' : '' }}
                            >12</option>
                            <option
                                value="18"
                                {{ $size == 18 ? 'selected' : '' }}
                            >18</option>
                            <option
                                value="24"
                                {{ $size == 24 ? 'selected' : '' }}
                            >24</option>

                        </select>

                        <select
                            id="orderby"
                            class="shop-acs__select form-select w-auto border-0 py-0 order-1 order-md-0"
                            aria-label="Sort Items"
                            name="orderby"
                        >
                            <option
                                value = '1'
                                selected
                                {{ $order == -1 ? 'selected' : '' }}
                            >@lang('Sort By')</option>
                            <option
                                value="1"
                                {{ $order == 1 ? 'selected' : '' }}
                            >@lang('Date, New to Old')</option>
                            <option
                                value="2"
                                {{ $order == 2 ? 'selected' : '' }}
                            >@lang('Date, Old to New')</option>
                            <option
                                value="3"
                                {{ $order == 3 ? 'selected' : '' }}
                            >@lang('Price, Low to High')</option>
                            <option
                                value="4"
                                {{ $order == 4 ? 'selected' : '' }}
                            >@lang('Price, High to Low')</option>

                        </select>



                        <div class="shop-filter d-flex align-items-center order-0 order-md-3 d-lg-none">
                            <button
                                class="btn-link btn-link_f d-flex align-items-center ps-0 js-open-aside"
                                data-aside="shopFilter"
                            >
                                <svg
                                    class="d-inline-block align-middle me-2"
                                    width="14"
                                    height="10"
                                    viewBox="0 0 14 10"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <use href="#icon_filter" />
                                </svg>
                                <span class="text-uppercase fw-medium d-inline-block align-middle">Filter</span>
                            </button>
                        </div>
                    </div>
                </div>

                <div
                    id="products-grid"
                    class="products-grid row row-cols-2 row-cols-md-3"
                >

                    @foreach ($products as $product)
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
                                                        src="{{ asset('uploads/products') }}/{{ $product->image }}"
                                                        width="330"
                                                        height="400"
                                                        alt=""
                                                        class="pc__img"
                                                    ></a>
                                            </div>
                                            <div class="swiper-slide">
                                                @foreach (explode(',', $product->images) as $gimg)
                                                    <a
                                                        href="{{ route('shop.product.details', ['product_slug' => $product->slug]) }}"><img
                                                            loading="lazy"
                                                            src="{{ asset('uploads/products') }}/{{ $gimg }}"
                                                            width="330"
                                                            height="400"
                                                            alt=""
                                                            class="pc__img"
                                                        ></a>
                                                @endforeach

                                            </div>
                                        </div>
                                        <span class="pc__img-prev"><svg
                                                width="7"
                                                height="11"
                                                viewBox="0 0 7 11"
                                                xmlns="http://www.w3.org/2000/svg"
                                            >
                                                <use href="#icon_prev_sm" />
                                            </svg></span>
                                        <span class="pc__img-next"><svg
                                                width="7"
                                                height="11"
                                                viewBox="0 0 7 11"
                                                xmlns="http://www.w3.org/2000/svg"
                                            >
                                                <use href="#icon_next_sm" />
                                            </svg></span>
                                    </div>
                                    @if (Cart::instance('cart')->content()->where('id', $product->id)->count() > 0)
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
                                                value="{{ $product->id }}"
                                            >
                                            <input
                                                type="hidden"
                                                name="quantity"
                                                value="1"
                                            >
                                            <input
                                                type="hidden"
                                                name="name"
                                                value="{{ $product->translations->where('locale', $locale)->first()?->name ?? '' }}"
                                            >
                                            <input
                                                type="hidden"
                                                name="price"
                                                value="{{ $product->sale_price == '' ? $product->regular_price : $product->sale_price }}"
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
                                        {{ $product->category->translations->where('locale', $locale)->first()?->name ?? '' }}
                                    </p>
                                    <h6 class="pc__title">

                                        <a href="details.html">{{ $product->translations->where('locale', $locale)->first()?->name ?? '' }}
                                        </a>
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
                                    <div class="product-card__review d-flex align-items-center">
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
                                        <span class="reviews-note text-lowercase text-secondary ms-1">8k+
                                            @lang('Reviews')</span>
                                    </div>
                                    @if (Cart::instance('wishlist')->content()->where('id', $product->id)->count() > 0)
                                        <form
                                            action="{{ route('wishlist.item.remove', ['rowId' => Cart::instance('wishlist')->content()->where('id', $product->id)->first()->rowId]) }}"
                                            method="POST"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                type="submit"
                                                class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist filled-heart"
                                                title="{{ __('Remove from Wishlist') }}"
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
                                        </form>
                                    @elseif (Cart::instance('cart')->content()->where('id', $product->id)->count() == 0)
                                        <form
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
                                            <button
                                                type="submit"
                                                class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist"
                                                title="{{ __('Add To Wishlist') }}"
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
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>
                <div class="divider">
                    <div class="flex items-center justify-between flex-wrap gap-10 wgp-pagination">
                        {{ $products->withQueryString()->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </section>
    </main>
    <form
        id="frmfilter"
        action="{{ route('shop.index') }}"
        method="GET"
    >

        <input
            type="hidden"
            name="page"
            value="{{ $products->currentPage() }}"
        />
        <input
            id="size"
            type="hidden"
            name="size"
            value="{{ $size }}"
        />
        <input
            id="order"
            type="hidden"
            name="order"
            value="{{ $order }}"
        />
        <input
            id="hdnbrands"
            type="hidden"
            name="brands"
        />
        <input
            id="hdncategories"
            type="hidden"
            name="categories"
        />
        <input
            id="hdnMinPrice"
            name="min"
            type="hidden"
            value="{{ $min_price }}"
        />
        <input
            id="hdnMaxPrice"
            name="max"
            type="hidden"
            value="{{ $max_price }}"
        />

    </form>


    @push('scripts')
        <script>
            $(function() {

                $('#pagesize').on('change', function() {
                    $('#size').val($('#pagesize option:selected')
                        .val()); // on selected change, the size value changes
                    $('#frmfilter').find('input[name="page"]').val('1'); // Reset page number to 1
                    $('#frmfilter').submit();
                });

                $('#orderby').on('change', function() {
                    $('#order').val($('#orderby option:selected')
                        .val()); // on selected change, the size value changes
                    $('#frmfilter').submit();
                });

                function syncAllFiltersAndSubmit() {
                    const brands = $('input[name="brands"]:checked').map(function() {
                        return this.value;
                    }).get().filter(v => v !== 'all').join(',');

                    const categories = $('input[name="categories"]:checked').map(function() {
                        return this.value;
                    }).get().filter(v => v !== 'all').join(',');

                    const priceRange = $('[name="price_range"]').val()?.split(',') || [null, null];
                    const min = priceRange[0];
                    const max = priceRange[1];

                    $('#hdnbrands').val(brands);
                    $('#hdncategories').val(categories);
                    $('#hdnMinPrice').val(min);
                    $('#hdnMaxPrice').val(max);

                    $('#frmfilter').find('input[name="page"]').val('1'); // reset to first page
                    $('#frmfilter').submit();
                }


                $('input[name="brands"]').on('change', function() {
                    if ($(this).val() === 'all' && $(this).prop('checked')) {
                        $('input[name="brands"]').prop('checked', false);
                        $(this).prop('checked', true);
                    }
                    syncAllFiltersAndSubmit();
                });

                $('input[name="categories"]').on('change', function() {
                    if ($(this).val() === 'all' && $(this).prop('checked')) {
                        $('input[name="categories"]').prop('checked', false);
                        $(this).prop('checked', true);
                    }
                    syncAllFiltersAndSubmit();
                });

                $('[name=price_range]').on('change', function() {
                    setTimeout(() => syncAllFiltersAndSubmit(), 300);
                });


                // Reset Prices to Default on Click
                $('#reset-price').on('click', function() {
                    var defaultMin = $('[name=price_range]').data('slider-min'); // Default Min Price
                    var defaultMax = $('[name=price_range]').data('slider-max'); // Default Max Price

                    $('[name=price_range]').val(defaultMin + ',' + defaultMax).trigger('change');
                });

                var showMoreTextCat = "@lang('Show More Categories')";
                var showLessTextCat = "@lang('Show Less Categories')";

                $('#show-more-btn-cat').on('click', function() {
                    $('#hidden-categories').slideToggle(); // Show or hide additional categories
                    $(this).text(function(i, text) {
                        return text === showMoreTextCat ? showLessTextCat : showMoreTextCat;
                    });
                });

                var showMoreTextBrd = "@lang('Show More Brands')";
                var showLessTextBrd = "@lang('Show Less Brands')";

                $('#show-more-btn-brd').on('click', function() {
                    $('#hidden-brands').slideToggle(); // Show or hide additional categories
                    $(this).text(function(i, text) {
                        return text === showMoreTextBrd ? showLessTextBrd : showMoreTextBrd;
                    });
                });




            })
        </script>
    @endpush

</x-app-layout>
