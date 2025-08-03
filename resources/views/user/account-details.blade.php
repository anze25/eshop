<x-app title="{{ __('My Account') }}">
    <style>
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
            <h2 class="page-title">@lang('Account Details')</h2>
            <div class="row">
                <div class="col-lg-3">
                    @include('user.account-nav')
                </div>
                <div class="col-lg-9">
                    <div class="page-content my-account__edit">
                        <div class="my-account__edit-form">
                            <form
                                name="account_edit_form"
                                action="{{ route('user.account.details_update') }}"
                                method="POST"
                                class="needs-validation"
                            >
                                @csrf
                                @method('PUT')
                                <input
                                    type="hidden"
                                    name="id"
                                    value="{{ $user->id }}"
                                >
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-floating my-3">
                                            <input
                                                type="text"
                                                class="form-control"
                                                placeholder="@lang('Username')"
                                                name="name"
                                                value="{{ $user->name }}"
                                                required=""
                                            >
                                            <label for="name">@lang('Username')</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-floating my-3">
                                            <input
                                                type="text"
                                                class="form-control"
                                                placeholder="@lang('Mobile Number')"
                                                name="mobile"
                                                value="{{ $user->mobile }}"
                                            >
                                            <label for="mobile">@lang('Mobile')</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-floating my-3">
                                            <input
                                                type="email"
                                                class="form-control"
                                                placeholder="@lang('Email Address')"
                                                name="email"
                                                value="{{ $user->email }}"
                                                disabled
                                            >
                                            <label for="account_email">@lang('Email Address')</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="my-3">
                                            <button
                                                type="submit"
                                                class="btn btn-primary"
                                            >@lang('Change Your Data')</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <form
                                name="account_edit_form"
                                action="{{ route('user.account.password.update') }}"
                                method="POST"
                                class="needs-validation"
                                novalidate=""
                            >
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="my-3">
                                            <h5 class="text-uppercase mb-0">@lang('Change Password')</h5>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-floating my-3">
                                            <input
                                                id="old_password"
                                                type="password"
                                                class="form-control"
                                                name="old_password"
                                                required=""
                                            >
                                            <label for="old_password">@lang('Current Password')</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-floating my-3">
                                            <input
                                                id="new_password"
                                                type="password"
                                                class="form-control"
                                                name="new_password"
                                                required=""
                                            >
                                            <label for="account_new_password">@lang('New Password')</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-floating my-3">
                                            <input
                                                id="new_password_confirmation"
                                                type="password"
                                                class="form-control"
                                                cfpwd=""
                                                data-cf-pwd="#new_password"
                                                name="new_password_confirmation"
                                                required=""
                                            >
                                            <label for="new_password_confirmation">@lang('Confirm Password')</label>
                                            <div class="invalid-feedback">Passwords did not match!</div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="my-3">
                                            <button
                                                type="submit"
                                                class="btn btn-primary"
                                            >@lang('Change Password')</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</x-app>
