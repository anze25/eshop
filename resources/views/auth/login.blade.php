<x-app title="{{ __('Login') }}">
    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="login-register container">
            <ul
                id="login_register"
                class="nav nav-tabs mb-5"
                role="tablist"
            >
                <li
                    class="nav-item"
                    role="presentation"
                >
                    <a
                        id="login-tab"
                        class="nav-link nav-link_underscore active"
                        data-bs-toggle="tab"
                        href="#tab-item-login"
                        role="tab"
                        aria-controls="tab-item-login"
                        aria-selected="true"
                    >@lang('Login')</a>
                </li>
            </ul>
            <div
                id="login_register_tab_content"
                class="tab-content pt-2"
            >
                <div
                    id="tab-item-login"
                    class="tab-pane fade show active"
                    role="tabpanel"
                    aria-labelledby="login-tab"
                >
                    <div class="login-form">
                        <form
                            method="POST"
                            action="{{ route('login') }}"
                            name="login-form"
                            class="needs-validation"
                            novalidate=""
                        >
                            @csrf
                            <div class="form-floating mb-3">
                                <input
                                    class="form-control form-control_gray @error('email') is-invalid @enderror"
                                    name="email"
                                    value="{{ old('email') }}"
                                    required=""
                                    autocomplete="email"
                                    autofocus=""
                                >
                                <label for="email">@lang('Email address') *</label>
                                @error('email')
                                    <span
                                        class="invalid-feedback"
                                        role="alert"
                                    >
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="pb-3"></div>

                            <div class="form-floating mb-3">
                                <input
                                    id="password"
                                    type="password"
                                    class="form-control form-control_gray @error('password') is-invalid @enderror"
                                    name="password"
                                    required=""
                                    autocomplete="current-password"
                                >
                                <label for="customerPasswodInput">@lang('Password') *</label>
                                @error('password')
                                    <span
                                        class="invalid-feedback"
                                        role="alert"
                                    >
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <button
                                class="btn btn-primary w-100 text-uppercase"
                                type="submit"
                            >@lang('Log In')</button>

                            <div class="customer-option mt-4 text-center">
                                <span class="text-secondary">@lang('No account yet')?</span>
                                <a
                                    href="{{ route('register') }}"
                                    class="btn-text js-show-register"
                                >@lang('Create Account')</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
</x-app>
