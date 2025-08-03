<x-admin.layout title="{{ __('Product') }}">
    <div class="main-content-inner">
        <!-- main-content-wrap -->
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>@lang('Add Product')</h3>
                <x-breadcrumb :items="[
                    ['text' => 'Dashboard', 'route' => route('admin.index')],
                    ['text' => 'Products', 'route' => route('admin.products')],
                    ['text' => 'Add Product'],
                ]" />
            </div>
            <!-- form-add-product -->
            <form
                class="tf-section-2 form-add-product"
                method="POST"
                enctype="multipart/form-data"
                action="{{ route('admin.product.store') }}"
            >
                @csrf
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
                                tabindex="0"
                                value="{{ old($locale . '.name') }}"
                                data-locale="{{ $locale }}"
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
                            value="{{ old('slug') }}"
                            aria-required="true"
                            required=""
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
                                            {{ old('category_id') == $category->id ? 'selected' : '' }}
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
                                            {{ old('brand_id') == $brand->id ? 'selected' : '' }}
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
                            >{{ old($locale . '.short_description') }}</textarea>
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
                            >{{ old($locale . '.description') }}</textarea>
                            <div class="text-tiny">
                                @lang('Do not exceed 1000 characters when entering the product description.')</div>
                        </fieldset>
                        <x-validation-error field="description" />
                    @endforeach

                </div>
                <div class="wg-box">
                    <x-admin.image-upload />
                    <x-validation-error field="image" />

                    <fieldset>
                        <div class="body-title mb-10">@lang('Upload Gallery Images')</div>
                        <div class="upload-image mb-16">
                            <!-- <div class="item">
                                                                                        <img src="images/upload/upload-1.png" alt="">
                                                                                    </div>                                                 -->
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
                            <div class="body-title mb-10">@lang('Regular Price') <span class="tf-color-1">*</span>
                            </div>
                            <input
                                class="mb-10"
                                type="text"
                                placeholder="@lang('Enter regular price')"
                                name="regular_price"
                                tabindex="0"
                                value="{{ old('regular_price') }}"
                                aria-required="true"
                                required=""
                            >
                        </fieldset>
                        <x-validation-error field="regular_price" />

                        <fieldset class="name">
                            <div class="body-title mb-10">@lang('Sale Price') <span class="tf-color-1">*</span>
                            </div>
                            <input
                                class="mb-10"
                                type="text"
                                placeholder="@lang('Enter sale price')"
                                name="sale_price"
                                tabindex="0"
                                value="{{ old('sale_price') }}"
                                aria-required="true"
                                required=""
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
                                placeholder="@lang('Enter SKU')"
                                name="SKU"
                                tabindex="0"
                                value="{{ old('SKU') }}"
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
                                placeholder="@lang('Enter quantity')"
                                name="quantity"
                                tabindex="0"
                                value="{{ old('quantity') }}"
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
                                    <option value="0">@lang('No')</option>
                                    <option value="1">@lang('Yes')</option>
                                </select>
                            </div>
                        </fieldset>
                        <x-validation-error field="featured" />

                    </div>
                    <div class="cols gap10">
                        <button
                            class="tf-button w-full"
                            type="submit"
                        >@lang('Add Product')</button>
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
