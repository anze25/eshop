<x-app title="{{ __('company_card.title') }}">
    <main class="pt-90">
        <section class="contact-us container">
            <div class="mw-930 text-center">
                <h2 class="page-title mb-5">@lang('company_card.company_name')</h2>

                <div class="card shadow p-4 border-0 bg-light">
                    <h5 class="mb-3">@lang('company_card.address')</h5>
                    <p class="mb-2">
                        {{ __('company_card.street') }}<br>
                        {{ __('company_card.postal_code') }} {{ __('company_card.city') }}<br>
                        {{ __('company_card.country') }}
                    </p>

                    <p class="mb-2">
                        <strong>@lang('company_card.phone_label'):</strong> {{ __('company_card.phone') }}<br>
                        <strong>@lang('company_card.email_label'):</strong> <a
                            href="mailto:{{ __('company_card.email') }}">{{ __('company_card.email') }}</a>
                    </p>

                    <p class="mb-0">
                        <strong>@lang('company_card.tax_id_label'):</strong> {{ __('company_card.tax_id') }}<br>
                        <strong>@lang('company_card.registration_label'):</strong> {{ __('company_card.registration') }}
                    </p>
                </div>
            </div>
        </section>
    </main>
</x-app>
