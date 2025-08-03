<x-admin.layout title="{{ __('Setting') }}">
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>@lang('Setting')</h3>
                <x-breadcrumb :items="[
                    ['text' => 'Dashboard', 'route' => route('admin.index')],
                    ['text' => 'Settings', 'route' => route('admin.settings')],
                    ['text' => 'Edit Settings'],
                ]" />
            </div>
            <!-- new-category -->
            <div class="wg-box">
                <form
                    class="form-new-product form-style-1"
                    action="{{ route('admin.settings.update') }}"
                    method="POST"
                    enctype="multipart/form-data"
                >
                    @csrf
                    @method('PUT')

                    <fieldset class="name">
                        <div class="body-title">@lang('Company Name') <span class="tf-color-1">*</span></div>
                        <input
                            class="flex-grow"
                            type="text"
                            placeholder="@lang('Company Name')"
                            name="company_name"
                            tabindex="0"
                            value="{{ $settings->company_name }}"
                            aria-required="true"
                            required=""
                        >
                    </fieldset>
                    <x-validation-error field="company_name" />

                    <fieldset class="name">
                        <div class="body-title">@lang('Address') <span class="tf-color-1">*</span></div>
                        <input
                            class="flex-grow"
                            type="text"
                            placeholder="@lang('Address')"
                            name="company_address"
                            tabindex="0"
                            value="{{ $settings->company_address }}"
                        >
                    </fieldset>
                    <x-validation-error field="company_address" />

                    <fieldset class="name">
                        <div class="body-title">@lang('Phone') 1 <span class="tf-color-1">*</span></div>
                        <input
                            class="flex-grow"
                            type="text"
                            placeholder="@lang('Phone') 1"
                            name="phone_one"
                            tabindex="0"
                            value="{{ $settings->phone_one }}"
                        >
                    </fieldset>
                    <x-validation-error field="phone_one" />

                    <fieldset class="name">
                        <div class="body-title">@lang('Phone') 2 <span class="tf-color-1">*</span></div>
                        <input
                            class="flex-grow"
                            type="text"
                            placeholder="@lang('Phone') 2"
                            name="phone_two"
                            tabindex="0"
                            value="{{ $settings->phone_two }}"
                        >
                    </fieldset>
                    <x-validation-error field="phone_two" />

                    <fieldset class="name">
                        <div class="body-title">@lang('Email') <span class="tf-color-1">*</span></div>
                        <input
                            class="flex-grow"
                            type="text"
                            placeholder="@lang('Email')"
                            name="email"
                            tabindex="0"
                            value="{{ $settings->email }}"
                        >
                    </fieldset>
                    <x-validation-error field="email" />

                    <fieldset class="name">
                        <div class="body-title">@lang('Facebook') <span class="tf-color-1">*</span></div>
                        <input
                            class="flex-grow"
                            type="text"
                            placeholder="@lang('Facebook')"
                            name="facebook"
                            tabindex="0"
                            value="{{ $settings->facebook }}"
                        >
                    </fieldset>
                    <x-validation-error field="facebook" />

                    <fieldset class="name">
                        <div class="body-title">@lang('Instagram') <span class="tf-color-1">*</span></div>
                        <input
                            class="flex-grow"
                            type="text"
                            placeholder="@lang('Instagram')"
                            name="instagram"
                            tabindex="0"
                            value="{{ $settings->instagram }}"
                        >
                    </fieldset>
                    <x-validation-error field="instagram" />

                    <fieldset class="name">
                        <div class="body-title">@lang('Twitter') <span class="tf-color-1">*</span></div>
                        <input
                            class="flex-grow"
                            type="text"
                            placeholder="@lang('Twitter')"
                            name="twitter"
                            tabindex="0"
                            value="{{ $settings->twitter }}"
                        >
                    </fieldset>
                    <x-validation-error field="twitter" />

                    <fieldset class="name">
                        <div class="body-title">@lang('LinkedIn') <span class="tf-color-1">*</span></div>
                        <input
                            class="flex-grow"
                            type="text"
                            placeholder="@lang('LinkedIn')"
                            name="linkedin"
                            tabindex="0"
                            value="{{ $settings->linkedin }}"
                        >
                    </fieldset>
                    <x-validation-error field="linkedin" />

                    <fieldset class="name">
                        <div class="body-title">@lang('YouTube') <span class="tf-color-1">*</span></div>
                        <input
                            class="flex-grow"
                            type="text"
                            placeholder="@lang('Youtube')"
                            name="youtube"
                            tabindex="0"
                            value="{{ $settings->youtube }}"
                        >
                    </fieldset>
                    <x-validation-error field="youtube" />


                    <fieldset>
                        <div class="body-title">@lang('Logo') <span class="tf-color-1">*</span>
                        </div>
                        <div class="upload-image flex-grow">
                            @if ($settings->logo)
                                <div
                                    id="imgpreview"
                                    class="item"
                                >
                                    <img
                                        src="{{ asset('assets/images') }}/{{ $settings->logo }}"
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
                                        name="logo"
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
