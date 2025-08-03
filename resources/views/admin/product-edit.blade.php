<x-admin.layout title="{{ __('Products') }}">
    <div class="main-content-inner">
        <!-- main-content-wrap -->
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>@lang('Edit Product')</h3>
                <x-breadcrumb :items="[
                    ['text' => 'Dashboard', 'route' => route('admin.index')],
                    ['text' => 'Products', 'route' => route('admin.products')],
                    ['text' => 'Edit Product'],
                ]" />
            </div>
            <!-- form-add-product -->
            <form
                class="tf-section-2 form-add-product"
                method="POST"
                enctype="multipart/form-data"
                action="{{ route('admin.product.update') }}"
            >
                @csrf
                @method('PUT')
                <input
                    type="hidden"
                    name="id"
                    value="{{ $product->id }}"
                >
                <div class="wg-box">
                    @foreach (config('app.supported_locales') as $locale)
                        <fieldset class="name">
                            <div class="body-title mb-10">@lang('Product Name') {{ $locale }}<span
                                    class="tf-color-1">*</span>
                            </div>
                            <input
                                class="mb-10"
                                type="text"
                                placeholder="@lang('Enter product name')  {{ $locale }}"
                                name={{ $locale }}[name]"
                                data-locale="{{ $locale }}"
                                tabindex="0"
                                value="{{ $product->translations->where('locale', $locale)->first()->name ?? '' }}"
                                aria-required="true"
                                required=""
                            >
                            <div class="text-tiny">
                                @lang('Do not exceed 100 characters when entering the product name.')
                            </div>
                        </fieldset>
                        <x-validation-error field="name" />
                    @endforeach

                    <fieldset class="name">
                        <div class="body-title mb-10">@lang('Slug') <span class="tf-color-1">*</span></div>
                        <input
                            class="mb-10"
                            type="text"
                            placeholder="@lang('Enter product slug')"
                            name="slug"
                            tabindex="0"
                            value="{{ $product->slug }}"
                            aria-required="true"
                            disabled
                        >
                        <div class="text-tiny">@lang('Do not exceed 100 characters when entering the product slug.')
                        </div>
                    </fieldset>
                    <x-validation-error field="slug" />

                    <div class="gap22 cols">
                        <fieldset class="category">
                            <div class="body-title mb-10">@lang('Category') <span class="tf-color-1">*</span>
                            </div>
                            <div class="select">
                                <select
                                    class=""
                                    name="category_id"
                                >
                                    <option>@lang('Choose')</option>
                                    @foreach ($categories as $category)
                                        <option
                                            value="{{ $category->id }}"
                                            {{ $product->category_id == $category->id ? 'selected' : '' }}
                                        >
                                            {{ $category->translations->first()?->name ?? '' }}
                                        </option>
                                    @endforeach



                                </select>
                            </div>
                        </fieldset>
                        <x-validation-error field="category_id" />

                        <fieldset class="brand">
                            <div class="body-title mb-10">@lang('Brand') <span class="tf-color-1">*</span>
                            </div>
                            <div class="select">
                                <select
                                    class=""
                                    name="brand_id"
                                >
                                    <option>@lang('Choose')</option>
                                    @foreach ($brands as $brand)
                                        <option
                                            value="{{ $brand->id }}"
                                            {{ $product->brand_id == $brand->id ? 'selected' : '' }}
                                        >{{ $brand->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </fieldset>
                        <x-validation-error field="brand_id" />

                    </div>
                    @foreach (config('app.supported_locales') as $locale)
                        <fieldset class="shortdescription">
                            <div class="body-title mb-10">@lang('Short Description') {{ $locale }}<span
                                    class="tf-color-1"
                                >*</span>
                            </div>
                            <textarea
                                class="mb-10 ht-150"
                                name="{{ $locale }}[short_description]"
                                placeholder="@lang('Short Description') {{ $locale }}"
                                tabindex="0"
                                aria-required="true"
                                required=""
                            >{{ $product->translations->first()?->short_description ?? '' }}</textarea>
                            <div class="text-tiny">
                                @lang('Do not exceed 100 characters when entering the product description.')</div>
                        </fieldset>
                        <x-validation-error field="short_description" />
                    @endforeach

                    @foreach (config('app.supported_locales') as $locale)
                        <fieldset class="description">
                            <div class="body-title mb-10">@lang('Description') {{ $locale }} <span
                                    class="tf-color-1"
                                >*</span>
                            </div>
                            <textarea
                                class="mb-10"
                                name="{{ $locale }}[description]"
                                placeholder="@lang('Description') {{ $locale }}"
                                tabindex="0"
                                aria-required="true"
                            >{{ $product->translations->first()?->description ?? '' }}</textarea>
                            <div class="text-tiny">
                                @lang('Do not exceed 1000 characters when entering the product description.')</div>
                        </fieldset>
                        <x-validation-error field="description" />
                    @endforeach

                </div>
                <div class="wg-box">
                    <fieldset>
                        <div class="body-title">@lang('Upload images') <span class="tf-color-1">*</span>
                        </div>
                        <div class="upload-image flex-grow">
                            @if ($product->image)
                                <div
                                    id="imgpreview"
                                    class="item"
                                >
                                    <img
                                        src="{{ asset('uploads/products/thumbnails') }}/{{ $product->image }}"
                                        class="effect8"
                                        alt=""
                                    >
                                </div>
                            @endif

                            <div
                                id="upload-file"
                                class="item up-load"
                            >
                                <label
                                    class="uploadfile"
                                    for="myFile"
                                >
                                    <span class="icon">
                                        <i class="icon-upload-cloud"></i>
                                    </span>
                                    <span class="body-text">@lang('Drop your images here or select') <span
                                            class="tf-color">@lang('click to browse')</span></span>
                                    <input
                                        id="myFile"
                                        type="file"
                                        name="image"
                                        accept="image/*"
                                    >
                                </label>
                            </div>
                        </div>
                    </fieldset>
                    <x-validation-error field="image" />


                    <fieldset>
                        <div class="body-title mb-10">@lang('Upload Gallery Images')</div>
                        <div class="upload-image mb-16">
                            @if ($product->images)
                                @foreach (explode(',', $product->images) as $img)
                                    <div class="item gitems">
                                        <img
                                            src="{{ asset('uploads/products/thumbnails') }}/{{ trim($img) }}"
                                            alt=""
                                        >
                                    </div>
                                @endforeach
                            @endif

                            <div
                                id="galUpload"
                                class="item up-load"
                            >
                                <label
                                    class="uploadfile"
                                    for="gFile"
                                >
                                    <span class="icon">
                                        <i class="icon-upload-cloud"></i>
                                    </span>
                                    <span class="body-text">@lang('Drop your images here or select') <span
                                            class="tf-color">@lang('click to browse')</span></span>
                                    <input
                                        id="gFile"
                                        type="file"
                                        name="images[]"
                                        accept="image/*"
                                        multiple=""
                                    >
                                </label>
                            </div>
                        </div>
                    </fieldset>
                    <x-validation-error field="images" />
                    <div class="cols gap22">
                        <fieldset class="name">
                            <div class="body-title mb-10">@lang('Regular Price') <span class="tf-color-1">*</span></div>
                            <input
                                class="mb-10"
                                type="text"
                                placeholder="Enter regular price"
                                name="regular_price"
                                tabindex="0"
                                value="{{ $product->regular_price }}"
                                aria-required="true"
                                required=""
                            >
                        </fieldset>
                        <x-validation-error field="regular_price" />

                        <fieldset class="name">
                            <div class="body-title mb-10">@lang('Sale Price') <span class="tf-color-1">*</span></div>
                            <input
                                class="mb-10"
                                type="text"
                                placeholder="Enter sale price"
                                name="sale_price"
                                tabindex="0"
                                value="{{ $product->sale_price }}"
                                aria-required="true"
                            >
                        </fieldset>
                        <x-validation-error field="sale_price" />

                    </div>


                    <div class="cols gap22">
                        <fieldset class="name">
                            <div class="body-title mb-10">SKU <span class="tf-color-1">*</span>
                            </div>
                            <input
                                class="mb-10"
                                type="text"
                                placeholder="Enter SKU"
                                name="SKU"
                                tabindex="0"
                                value="{{ $product->SKU }}"
                                aria-required="true"
                                required=""
                            >
                        </fieldset>
                        <x-validation-error field="SKU" />

                        <fieldset class="name">
                            <div class="body-title mb-10">@lang('Quantity') <span class="tf-color-1">*</span>
                            </div>
                            <input
                                class="mb-10"
                                type="text"
                                placeholder="Enter quantity"
                                name="quantity"
                                tabindex="0"
                                value="{{ $product->quantity }}"
                                aria-required="true"
                                required=""
                            >
                        </fieldset>
                        <x-validation-error field="quantity" />

                    </div>

                    <div class="cols gap22">

                        <fieldset class="name">
                            <div class="body-title mb-10">@lang('Featured')</div>
                            <div class="select mb-10">
                                <select
                                    class=""
                                    name="featured"
                                >
                                    <option
                                        value="0"
                                        {{ $product->featured == '0' ? 'selected' : '' }}
                                    >@lang('No')</option>
                                    <option
                                        value="1"
                                        {{ $product->featured == '1' ? 'selected' : '' }}
                                    >@lang('Yes')</option>
                                </select>
                            </div>
                        </fieldset>
                        <x-validation-error field="featured" />

                    </div>
                    <div class="cols gap10">
                        <button
                            class="tf-button w-full"
                            type="submit"
                        >@lang('Update')</button>
                    </div>
                </div>
            </form>
            <!-- /form-add-product -->
        </div>
        <!-- /main-content-wrap -->
    </div>


    @push('scripts')
        <script>
            $(function() {

                $("#gFile").on("change", function(e) {
                    $(".gitems").remove();
                    const gFile = $("gFile");
                    const gphotos = this.files;
                    $.each(gphotos, function(key, val) {
                        $("#galUpload").prepend(
                            `<div class="item gitems"><img src="${URL.createObjectURL(val)}" alt=""></div>`
                        );
                    });
                });

            });
        </script>
    @endpush
</x-admin.layout>
