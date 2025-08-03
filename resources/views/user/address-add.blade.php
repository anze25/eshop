<x-app title="{{ __('Address') }}">
    <style>
        .table> :not(caption)>tr>th {
            padding: 0.625rem 1.5rem .625rem !important;
            background-color: #6a6e51 !important;
        }

        .table>tr>td {
            padding: 0.625rem 1.5rem .625rem !important;
        }

        .table-bordered> :not(caption)>tr>th,
        .table-bordered> :not(caption)>tr>td {
            border-width: 1px 1px;
            border-color: #6a6e51;
        }

        .table> :not(caption)>tr>td {
            padding: .8rem 1rem !important;
        }

        .bg-success {
            background-color: #40c710 !important;
        }

        .bg-danger {
            background-color: #f44032 !important;
        }

        .bg-warning {
            background-color: #f5d700 !important;
            color: #000;
        }
    </style>
    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="my-account container">
            <h2 class="page-title">@lang('Address')</h2>
            <div class="row">
                <div class="col-lg-3">
                    @include('user.account-nav')
                </div>
                <div class="col-lg-9">
                    <div class="page-content my-account__address">
                        <div class="row">
                            <div class="col-6">

                            </div>
                            <div class="col-6 text-right">
                                <a
                                    href="#"
                                    class="btn btn-sm btn-danger"
                                >@lang('Back')</a>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-10">
                                <div class="card mb-5">
                                    <div class="card-header">
                                        <h5>@lang('Add Address')</h5>
                                    </div>
                                    <div class="card-body">
                                        <form
                                            action="{{ route('user.address.store') }}"
                                            method="POST"
                                        >
                                            @csrf
                                            @method('POST')

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-floating my-3">
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            name="first_name"
                                                            required=""
                                                            value="{{ old('first_name') }}"
                                                        >
                                                        <label for="first_name">@lang('First Name') <span
                                                                class="text-danger"
                                                            >*</span></label>
                                                        <span class="text-danger">
                                                            @error('first_name')
                                                                {{ $message }}
                                                            @enderror
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating my-3">
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            name="last_name"
                                                            required=""
                                                            value="{{ old('last_name') }}"
                                                        >
                                                        <label for="last_name">@lang('Last Name') <span
                                                                class="text-danger"
                                                            >*</span></label>
                                                        <span class="text-danger">
                                                            @error('last_name')
                                                                {{ $message }}
                                                            @enderror
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-floating my-3">
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            name="company_name"
                                                            value="{{ old('company_name') }}"
                                                        >
                                                        <label for="company_name">@lang('Company Name')</label>
                                                        <span class="text-danger">
                                                            @error('company_name')
                                                                {{ $message }}
                                                            @enderror
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-floating my-3">
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            name="street_address"
                                                            required=""
                                                            value="{{ old('street_address') }}"
                                                        >
                                                        <label for="street_address">@lang('Street and House Number') <span
                                                                class="text-danger"
                                                            >*</span></label>
                                                        <span class="text-danger">
                                                            @error('street_address')
                                                                {{ $message }}
                                                            @enderror
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating my-3">
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            name="address_line_2"
                                                            value="{{ old('address_line_2') }}"
                                                        >
                                                        <label for="address_line_2">@lang('Suite or Appartment Number')</label>
                                                        <span class="text-danger">
                                                            @error('address_line_2')
                                                                {{ $message }}
                                                            @enderror
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating my-3">
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            name="phone_number"
                                                            value="{{ old('phone_number') }}"
                                                        >
                                                        <label for="phone_number">@lang('Phone')</label>
                                                        <span class="text-danger">
                                                            @error('phone_number')
                                                                {{ $message }}
                                                            @enderror
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-floating my-3">
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            name="postal_code"
                                                            required=""
                                                            value="{{ old('postal_code') }}"
                                                        >
                                                        <label for="postal_code">@lang('Zip Code') <span
                                                                class="text-danger"
                                                            >*</span></label>
                                                        <span class="text-danger">
                                                            @error('postal_code')
                                                                {{ $message }}
                                                            @enderror
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-floating mt-3 mb-3">
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            name="city"
                                                            required=""
                                                            value="{{ old('city') }}"
                                                        >
                                                        <label for="state">@lang('Town / City') <span
                                                                class="text-danger"
                                                            >*</span></label>
                                                        <span class="text-danger">
                                                            @error('city')
                                                                {{ $message }}
                                                            @enderror
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-floating my-3">
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            name="state_province_region"
                                                            value="{{ old('state_province_region') }}"
                                                        >
                                                        <label for="state_province_region">@lang('State / Province / Region')
                                                            <span class="text-danger">
                                                                @error('state_province_region')
                                                                    {{ $message }}
                                                                @enderror
                                                            </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-floating my-3">
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            name="country"
                                                            required=""
                                                            value="{{ old('country') }}"
                                                        >
                                                        <label for="country">@lang('Country') <span
                                                                class="text-danger"
                                                            >*</span></label>
                                                        <span class="text-danger">
                                                            @error('country')
                                                                {{ $message }}
                                                            @enderror
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-floating my-3">

                                                        <textarea
                                                            id=""
                                                            name="delivery_instructions"
                                                            class="form-control"
                                                        >{{ old('delivery_instructions') }}</textarea>

                                                        <label for="delivery_instructions">@lang('Delivery Instructions') </label>
                                                        <span class="text-danger">
                                                            @error('delivery_instructions')
                                                                {{ $message }}
                                                            @enderror
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input
                                                            type="hidden"
                                                            name="isdefault"
                                                            value="0"
                                                        >
                                                        <input
                                                            id="isdefault"
                                                            class="form-check-input"
                                                            type="checkbox"
                                                            value="1"
                                                            name="isdefault"
                                                        >
                                                        <label
                                                            class="form-check-label"
                                                            for="isdefault"
                                                        >
                                                            @lang('This is Default Address')
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 text-right">
                                                    <button
                                                        type="submit"
                                                        class="btn btn-success"
                                                    >@lang('Create')</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </section>
    </main>
</x-app>
