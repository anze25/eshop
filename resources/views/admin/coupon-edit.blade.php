<x-admin.layout title="{{ __('Coupon') }}">
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>@lang('Coupon Infomation')</h3>
                <x-breadcrumb :items="[
                    ['text' => 'Dashboard', 'route' => route('admin.index')],
                    ['text' => 'Coupons', 'route' => route('admin.coupons')],
                    ['text' => 'Edit'],
                ]" />
            </div>
            <div class="wg-box">
                <form
                    class="form-new-product form-style-1"
                    action="{{ route('admin.coupon.update') }}"
                    method="POST"
                >
                    @csrf
                    @method('PUT')
                    <input
                        type="hidden"
                        name="id"
                        value="{{ $coupon->id }}"
                    >
                    <fieldset class="name">
                        <div class="body-title">@lang('Coupon Code') <span class="tf-color-1">*</span></div>
                        <input
                            class="flex-grow"
                            type="text"
                            placeholder="@lang('Coupon Code')"
                            name="code"
                            tabindex="0"
                            value="{{ $coupon->code }}"
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
                                <option
                                    value=""
                                    disabled
                                >@lang('Select')</option>
                                <option
                                    value="fixed"
                                    {{ $coupon->type == 'fixed' ? 'selected' : '' }}
                                >@lang('Fixed')</option>
                                <option
                                    value="percent"
                                    {{ $coupon->type == 'percent' ? 'selected' : '' }}
                                >@lang('Percent')</option>
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
                        <div class="body-title">@lang('Value') <span class="tf-color-1">*</span></div>
                        <input
                            class="flex-grow"
                            type="text"
                            placeholder="@lang('Coupon Value')"
                            name="value"
                            tabindex="0"
                            value="{{ $coupon->value }}"
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
                            value="{{ $coupon->cart_value }}"
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
                            value="{{ $coupon->expiry_date }}"
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
