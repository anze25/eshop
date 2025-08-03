<x-admin.layout title="{{ __('Coupon') }}">
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>@lang('Coupon Infomation')</h3>
                <x-breadcrumb :items="[
                    ['text' => 'Dashboard', 'route' => route('admin.index')],
                    ['text' => 'Coupons', 'route' => route('admin.coupons')],
                    ['text' => 'Add New'],
                ]" />
            </div>
            <div class="wg-box">
                <form
                    class="form-new-product form-style-1"
                    action="{{ route('admin.coupon.store') }}"
                    method="POST"
                >
                    @csrf
                    <fieldset class="name">
                        <div class="body-title">@lang('Coupon Code') <span class="tf-color-1">*</span></div>
                        <input
                            class="flex-grow"
                            type="text"
                            placeholder="@lang('Coupon Code')"
                            name="code"
                            tabindex="0"
                            value="{{ old('code') }}"
                            aria-required="true"
                            required=""
                        >
                    </fieldset>
                    @error('code')
                        <span
                            class="invalid-feedback"
                            role="alert"
                        >
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <fieldset class="category">
                        <div class="body-title">@lang('Type')</div>
                        <div class="select flex-grow">
                            <select
                                class=""
                                name="type"
                            >
                                <option value="">@lang('Select')</option>
                                <option value="fixed">@lang('Fixed')</option>
                                <option value="percent">@lang('Percent')</option>
                            </select>
                        </div>
                    </fieldset>
                    @error('type')
                        <span
                            class="invalid-feedback"
                            role="alert"
                        >
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <fieldset class="name">
                        <div class="body-title">@lang('Coupon Value') <span class="tf-color-1">*</span></div>
                        <input
                            class="flex-grow"
                            type="text"
                            placeholder="@lang('Coupon Value')"
                            name="value"
                            tabindex="0"
                            value="{{ old('value') }}"
                            aria-required="true"
                            required=""
                        >
                    </fieldset>
                    @error('value')
                        <span
                            class="invalid-feedback"
                            role="alert"
                        >
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <fieldset class="name">
                        <div class="body-title">@lang('Cart Value') <span class="tf-color-1">*</span></div>
                        <input
                            class="flex-grow"
                            type="text"
                            placeholder="@lang('Cart Value')"
                            name="cart_value"
                            tabindex="0"
                            value="{{ old('cart_value') }}"
                            aria-required="true"
                            required=""
                        >
                    </fieldset>
                    @error('cart_value')
                        <span
                            class="invalid-feedback"
                            role="alert"
                        >
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <fieldset class="name">
                        <div class="body-title">@lang('Expiration Date') <span class="tf-color-1">*</span></div>
                        <input
                            class="flex-grow"
                            type="date"
                            placeholder="@lang('Expiration Date')"
                            name="expiry_date"
                            tabindex="0"
                            value="{{ old('expiry_date') }}"
                            aria-required="true"
                            required=""
                        >
                    </fieldset>
                    @error('expiry_date')
                        <span
                            class="invalid-feedback"
                            role="alert"
                        >
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
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
