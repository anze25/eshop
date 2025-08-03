<x-admin.layout title="{{ __('Brand') }}">
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>@lang('Brand')</h3>
                <x-breadcrumb :items="[
                    ['text' => 'Dashboard', 'route' => route('admin.index')],
                    ['text' => 'Brands', 'route' => route('admin.brands')],
                    ['text' => 'New Brand'],
                ]" />

            </div>
            <!-- new-category -->
            <div class="wg-box">
                <form
                    class="form-new-product form-style-1"
                    action="{{ route('admin.brand.store') }}"
                    method="POST"
                    enctype="multipart/form-data"
                >
                    @csrf
                    <fieldset class="name">
                        <div class="body-title">@lang('Brand Name') <span class="tf-color-1">*</span></div>
                        <input
                            class="flex-grow"
                            type="text"
                            placeholder="@lang('Brand Name')"
                            name="name"
                            tabindex="0"
                            value="{{ old('name') }}"
                            aria-required="true"
                        >
                    </fieldset>
                    <x-validation-error field="name" />

                    <fieldset class="name">
                        <div class="body-title">@lang('Slug') <span class="tf-color-1">*</span></div>
                        <input
                            class="flex-grow"
                            type="text"
                            placeholder="@lang('Slug')"
                            name="slug"
                            tabindex="0"
                            value="{{ old('slug') }}"
                            aria-required="true"
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
