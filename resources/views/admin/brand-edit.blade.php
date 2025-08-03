<x-admin.layout title="{{ __('Brand') }}">
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>@lang('Brand')</h3>
                <x-breadcrumb :items="[
                    ['text' => 'Dashboard', 'route' => route('admin.index')],
                    ['text' => 'Brands', 'route' => route('admin.brands')],
                    ['text' => 'Edit Brand'],
                ]" />
            </div>
            <!-- new-category -->
            <div class="wg-box">
                <form
                    class="form-new-product form-style-1"
                    action="{{ route('admin.brand.update') }}"
                    method="POST"
                    enctype="multipart/form-data"
                >
                    @csrf
                    @method('PUT')
                    <input
                        type="hidden"
                        name="id"
                        value="{{ $brand->id }}"
                    />
                    <fieldset class="name">
                        <div class="body-title">@lang('Brand Name') <span class="tf-color-1">*</span></div>
                        <input
                            class="flex-grow"
                            type="text"
                            placeholder="@lang('Brand name')"
                            name="name"
                            tabindex="0"
                            value="{{ $brand->name }}"
                            aria-required="true"
                            required=""
                        >
                    </fieldset>

                    <fieldset class="name">
                        <div class="body-title">@lang('Brand Slug') <span class="tf-color-1">*</span></div>
                        <input
                            class="flex-grow"
                            type="text"
                            placeholder="Brand Slug"
                            name="slug"
                            tabindex="0"
                            value="{{ $brand->slug }}"
                            aria-required="true"
                            required=""
                        >
                    </fieldset>
                    <x-validation-error field="slug" />

                    <fieldset>
                        <div class="body-title">@lang('Upload images') <span class="tf-color-1">*</span>
                        </div>
                        <div class="upload-image flex-grow">
                            @if ($brand->image)
                                <div
                                    id="imgpreview"
                                    class="item"
                                >
                                    <img
                                        src="{{ asset('uploads/brands') }}/{{ $brand->image }}"
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

                    <div class="bot">
                        <div></div>
                        <button
                            class="tf-button w208"
                            type="submit"
                        >@lang('Update')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</x-admin.layout>
