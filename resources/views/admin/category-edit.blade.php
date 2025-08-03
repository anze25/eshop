<x-admin.layout title="{{ __('Category') }}">
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>@lang('Edit Category')</h3>
                <x-breadcrumb :items="[
                    ['text' => 'Dashboard', 'route' => route('admin.index')],
                    ['text' => 'Categories', 'route' => route('admin.categories')],
                    ['text' => 'Edit Category'],
                ]" />
            </div>
            <!-- new-category -->
            <div class="wg-box">
                <form
                    class="form-new-product form-style-1"
                    action="{{ route('admin.category.update') }}"
                    method="POST"
                    enctype="multipart/form-data"
                >
                    @csrf
                    @method('PUT')
                    <input
                        type="hidden"
                        name="id"
                        value="{{ $category->id }}"
                    />
                    @foreach (config('app.supported_locales') as $locale)
                        <fieldset class="name">
                            <div class="body-title">@lang('Category Name') {{ $locale }}<span
                                    class="tf-color-1">*</span></div>
                            <input
                                class="flex-grow"
                                type="text"
                                name="{{ $locale }}[name]"
                                data-locale="{{ $locale }}"
                                tabindex="0"
                                value="{{ old("{$locale}.name", $category->translations->where('locale', $locale)->first()->name ?? '') }}"
                                aria-required="true"
                                required=""
                                data-validation-required-message="@lang('This field is required')"
                            >
                        </fieldset>
                        <x-validation-error field="name" />
                    @endforeach
                    <fieldset class="name">
                        <div class="body-title">@lang('Category Slug') <span class="tf-color-1">*</span></div>
                        <input
                            class="flex-grow"
                            type="text"
                            placeholder="@lang('Category Slug')"
                            name="slug"
                            tabindex="0"
                            value="{{ $category->slug }}"
                            aria-required="true"
                            required=""
                            data-validation-required-message="@lang('This field is required')"
                        >
                    </fieldset>
                    <x-validation-error field="slug" />

                    <fieldset>
                        <div class="body-title">@lang('Upload images') <span class="tf-color-1">*</span>
                        </div>
                        @if ($category->image)
                            <div
                                id="imgpreview"
                                class="item"
                            >
                                <img
                                    src="{{ asset('uploads/categories') }}/{{ $category->image }}"
                                    class="effect8"
                                    alt=""
                                >
                            </div>
                        @endif
                        <div class="upload-image flex-grow">

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
