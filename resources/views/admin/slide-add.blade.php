<x-admin.layout title="{{ __('Slides') }}">
    <div class="main-content-inner">
        <!-- main-content-wrap -->
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Slide</h3>
                <x-breadcrumb :items="[
                    ['text' => 'Dashboard', 'route' => route('admin.index')],
                    ['text' => 'Slides', 'route' => route('admin.slides')],
                    ['text' => 'Add Slide'],
                ]" />
            </div>
            <!-- new-slide -->
            <div class="wg-box">
                <form
                    class="form-new-product form-style-1"
                    action="{{ route('admin.slide.store') }}"
                    method="POST"
                    enctype="multipart/form-data"
                >
                    @csrf
                    @foreach (config('app.supported_locales') as $locale)
                        <fieldset class="name">
                            <div class="body-title">@lang('Tagline') {{ $locale }} <span
                                    class="tf-color-1">*</span></div>
                            <input
                                class="flex-grow"
                                type="text"
                                placeholder="@lang('Tagline') {{ $locale }}"
                                name="{{ $locale }}[tagline]"
                                tabindex="0"
                                value="{{ old($locale . '.tagline') }}"
                                aria-required="true"
                                data-validation-required-message="@lang('This field is required')"
                            >
                        </fieldset>
                        <x-validation-error field="tagline" />
                    @endforeach



                    @foreach (config('app.supported_locales') as $locale)
                        <fieldset class="name">
                            <div class="body-title">@lang('Title') {{ $locale }} <span
                                    class="tf-color-1">*</span></div>
                            <input
                                class="flex-grow"
                                type="text"
                                placeholder="@lang('Title') {{ $locale }}"
                                name="{{ $locale }}[title]"
                                tabindex="0"
                                value="{{ old($locale . '.title') }}"
                                aria-required="true"
                                data-validation-required-message="@lang('This field is required')"
                            >
                        </fieldset>
                        <x-validation-error field="title" />
                    @endforeach

                    @foreach (config('app.supported_locales') as $locale)
                        <fieldset class="name">
                            <div class="body-title">@lang('Subtitle') {{ $locale }} <span
                                    class="tf-color-1">*</span></div>
                            <input
                                class="flex-grow"
                                type="text"
                                placeholder="@lang('Subtitle') {{ $locale }}"
                                name="{{ $locale }}[subtitle]"
                                tabindex="0"
                                value="{{ old($locale . '.subtitle') }}"
                                aria-required="true"
                                data-validation-required-message="@lang('This field is required')"
                            >
                        </fieldset>
                        <x-validation-error field="subtitle" />
                    @endforeach


                    <fieldset class="name">
                        <div class="body-title">@lang('Link') <span class="tf-color-1">*</span></div>
                        <input
                            class="flex-grow"
                            type="text"
                            placeholder="@lang('Link')"
                            name="link"
                            tabindex="0"
                            value="{{ old('link') }}"
                            aria-required="true"
                            required=""
                        >
                    </fieldset>
                    <x-validation-error field="link" />

                    <x-admin.image-upload />
                    <x-validation-error field="image" />

                    <fieldset class="category">
                        <div class="body-title">@lang('Status')</div>
                        <div class="select flex-grow">
                            <select
                                class=""
                                name="status"
                                aria-required="true"
                                required=""
                            >
                                <option
                                    value="0"
                                    @if (old('status') == '0') selected @endif
                                >@lang('Inactive')</option>
                                <option
                                    value="1"
                                    @if (old('status') == '1') selected @endif
                                >@lang('Active')</option>

                            </select>
                        </div>
                    </fieldset>
                    <x-validation-error field="status" />

                    <div class="bot">
                        <div></div>
                        <button
                            class="tf-button w208"
                            type="submit"
                        >@lang('Save')</button>
                    </div>
                </form>
            </div>
            <!-- /new-slide -->
        </div>
        <!-- /main-content-wrap -->
    </div>



</x-admin.layout>
