<x-app-layout title="{{ __('Contact Us') }}">
    <style>
        .text-danger {
            color: #ff1400 !important;
        }
    </style>
    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="contact-us container">
            <div class="mw-930">
                <h2 class="page-title">@lang('Contact Us')</h2>
            </div>
        </section>

        <hr class="mt-2 text-secondary " />
        <div class="mb-4 pb-4"></div>

        <section class="contact-us container">
            <div class="mw-930">
                <div class="contact-us__form">

                    @if (Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show">{{ Session::get('success') }}</div>
                    @elseif (Session::has('error'))
                        <div class="text-danger">{{ Session::get('error') }}</div>
                    @endif

                    <form
                        name="contact-us-form"
                        class="needs-validation"
                        novalidate=""
                        method="POST"
                        action="{{ route('home.contact.store') }}"
                    >
                        @csrf
                        <h3 class="mb-5">Get In Touch</h3>
                        <div class="form-floating my-4">
                            <input
                                type="text"
                                class="form-control"
                                name="name"
                                placeholder="Name *"
                                required=""
                                value="{{ old('name') }}"
                            >
                            <label for="contact_us_name">@lang('Your Name') *</label>
                            <x-validation-error field="name" />
                        </div>
                        <div class="form-floating my-4">
                            <input
                                type="text"
                                class="form-control"
                                name="phone"
                                placeholder="@lang('Phone')"
                                value="{{ old('phone') }}"
                            >
                            <label for="contact_us_name">@lang('Phone') </label>
                            <x-validation-error field="phone" />
                        </div>
                        <div class="form-floating my-4">
                            <input
                                type="email"
                                class="form-control"
                                name="email"
                                placeholder="@lang('Email') *"
                                required=""
                                value="{{ old('email') }}"
                            >
                            <label for="contact_us_name">@lang('Email') *</label>
                            <x-validation-error field="email" />
                        </div>
                        <div class="form-floating my-4">
                            <input
                                type="text"
                                class="form-control"
                                name="subject"
                                placeholder="@lang('Subject')"
                                required=""
                                value="{{ old('subject') }}"
                            >
                            <label for="contact_us_name">@lang('Subject') *</label>
                            <x-validation-error field="subject" />
                        </div>
                        <div class="my-4">

                            <textarea
                                class="form-control form-control_gray"
                                name="comment"
                                placeholder="@lang('Message')"
                                cols="30"
                                rows="8"
                                required=""
                            >{{ old('comment') }}</textarea>

                            <x-validation-error field="comment" />
                        </div>
                        <div class="my-4">
                            <button
                                type="submit"
                                class="btn btn-primary"
                            >@lang('Submit')</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>

</x-app-layout>
