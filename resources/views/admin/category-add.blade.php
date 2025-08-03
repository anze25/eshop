<x-admin.layout title="{{ __('Category') }}">
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>@lang('Category')</h3>
                <x-breadcrumb :items="[
                    ['text' => 'Dashboard', 'route' => route('admin.index')],
                    ['text' => 'Categories', 'route' => route('admin.categories')],
                    ['text' => 'Add Category'],
                ]" />
            </div>
            <!-- new-category -->
            <div class="wg-box">
                <form
                    class="form-new-product form-style-1"
                    action="{{ route('admin.category.store') }}"
                    method="POST"
                    enctype="multipart/form-data"
                >
                    @csrf
                    @foreach (config('app.supported_locales') as $locale)
                        <fieldset class="name">
                            <div class="body-title">@lang('Category Name') {{ $locale }}<span
                                    class="tf-color-1">*</span></div>
                            <input
                                class="flex-grow"
                                type="text"
                                placeholder="@lang('Category Name') {{ $locale }}"
                                name="{{ $locale }}[name]"
                                data-locale="{{ $locale }}"
                                tabindex="0"
                                value="{{ old($locale . '.name') }}"
                                aria-required="true"
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
                            value="{{ old('slug') }}"
                            aria-required="true"
                            required=""
                            data-validation-required-message="@lang('This field is required')"
                        >
                    </fieldset>
                    <x-validation-error field="slug" />

                    <x-admin.image-upload />
                    <x-validation-error field="image" />

                    <div class="bot">
                        <div></div>
                        <button
                            class="tf-button w208"
                            type="submit"
                        >@lang('Save')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-admin.layout>
