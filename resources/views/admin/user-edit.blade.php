<x-admin.layout title="{{ __('User') }}">
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>@lang('User')</h3>
                <x-breadcrumb :items="[
                    ['text' => 'Dashboard', 'route' => route('admin.index')],
                    ['text' => 'User', 'route' => route('admin.users')],
                    ['text' => 'Edit'],
                ]" />
            </div>
            <div class="wg-box">
                <form
                    class="form-new-product form-style-1"
                    action="{{ route('admin.user.update') }}"
                    method="POST"
                    enctype="multipart/form-data"
                >
                    @csrf
                    @method('PUT')
                    <input
                        type="hidden"
                        name="id"
                        value="{{ $user->id }}"
                    >
                    <fieldset
                        class="name"
                        @if (Auth::user()->id != $user->id) disabled @endif
                    >
                        <div class="body-title">@lang('Name'): </div>
                        <input
                            class="flex-grow"
                            type="text"
                            placeholder="@lang('Name')"
                            name="name"
                            tabindex="0"
                            value="{{ $user->name }}"
                            aria-required="true"
                            required=""
                        >
                    </fieldset>
                    <x-validation-error field="name" />

                    <fieldset
                        class="name"
                        @if (Auth::user()->id != $user->id) disabled @endif
                    >
                        <div class="body-title">@lang('Email'): </div>
                        <input
                            class="flex-grow"
                            type="text"
                            placeholder="@lang('Email')"
                            name="email"
                            tabindex="0"
                            value="{{ $user->email }}"
                            aria-required="true"
                            required=""
                        >
                    </fieldset>
                    <x-validation-error field="email" />

                    <fieldset
                        class="name"
                        @if (Auth::user()->id != $user->id) disabled @endif
                    >
                        <div class="body-title">@lang('Mobile'): </div>
                        <input
                            class="flex-grow"
                            type="text"
                            placeholder="@lang('Mobile')"
                            name="mobile"
                            tabindex="0"
                            value="{{ $user->mobile }}"
                            aria-required="true"
                            required=""
                        >
                    </fieldset>
                    <x-validation-error field="mobile" />

                    <fieldset class="category">
                        <div class="body-title">@lang('Type'):</div>
                        <div class="select flex-grow">
                            <select
                                class=""
                                name="utype"
                            >
                                <option
                                    value=""
                                    disabled
                                >@lang('Select')</option>
                                <option
                                    value="USR"
                                    {{ $user->utype == 'USR' ? 'selected' : '' }}
                                >@lang('User')</option>
                                <option
                                    value="ADM"
                                    {{ $user->utype == 'ADM' ? 'selected' : '' }}
                                >@lang('Admin')</option>
                            </select>
                        </div>
                    </fieldset>
                    <x-validation-error field="utype" />

                    <fieldset>
                        <div class="body-title">@lang('Upload images')
                        </div>
                        <div class="upload-image flex-grow">
                            @if ($user->image)
                                <div
                                    id="imgpreview"
                                    class="item"
                                >
                                    <img
                                        src="{{ asset('uploads/users/thumbnails') }}/{{ $user->image }}"
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
                        >@lang('Save')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-admin.layout>
