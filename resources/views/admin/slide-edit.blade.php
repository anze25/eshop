<x-admin.layout title="{{ __('Slides') }}">
    <div class="main-content-inner">
        <!-- main-content-wrap -->
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>@lang('Slide')</h3>
                <x-breadcrumb :items="[
                    ['text' => 'Dashboard', 'route' => route('admin.index')],
                    ['text' => 'Slides', 'route' => route('admin.slides')],
                    ['text' => 'Edit Slide'],
                ]" />
            </div>
            <!-- edit-slide -->
            <div class="wg-box">
                <form
                    class="form-new-product form-style-1"
                    action="{{ route('admin.slide.update') }}"
                    method="POST"
                    enctype="multipart/form-data"
                >
                    @csrf
                    @method('PUT')
                    <input
                        type="hidden"
                        name="id"
                        value="{{ $slide->id }}"
                    >
                    @foreach (config('app.supported_locales') as $locale)
                        <fieldset class="name">
                            <div class="body-title">@lang('Tagline') {{ $locale }} <span
                                    class="tf-color-1">*</span></div>
                            <input
                                class="flex-grow"
                                type="text"
                                name="{{ $locale }}[tagline]"
                                tabindex="0"
                                value="{{ old("{$locale}.tagline", $slide->translations->where('locale', $locale)->first()->tagline ?? '') }}"
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
                                name="{{ $locale }}[title]"
                                tabindex="0"
                                value="{{ old("{$locale}.title", $slide->translations->where('locale', $locale)->first()->title ?? '') }}"
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
                                name="{{ $locale }}[subtitle]"
                                tabindex="0"
                                value="{{ old("{$locale}.subtitle", $slide->translations->where('locale', $locale)->first()->subtitle ?? '') }}"
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
                            type="url"
                            name="link"
                            tabindex="0"
                            value="{{ $slide->link }}"
                            aria-required="true"
                            required=""
                        >
                    </fieldset>
                    <x-validation-error field="link" />

                    <fieldset>
                        <div class="body-title">@lang('Upload images') <span class="tf-color-1">*</span>
                        </div>
                        <div
                            @if ($slide->image) id="imgpreview"
                                class="item"
                            >
                                <img
                                    src="{{ asset('uploads/slides') }}/{{ $slide->image }}"
                                    class="effect8"
                                    alt=""
                                >
                            </div> @endif
                            <div
                            class="upload-image flex-grow"
                        >

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
            </div>
            </fieldset>
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
        <!-- /edit-slide -->
    </div>
    <!-- /main-content-wrap -->
    </div>

</x-admin.layout>
