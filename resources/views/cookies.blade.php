<x-app title="{{ __('cookies.title') }}">
    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="contact-us container">
            <div class="mw-930">
                <h2 class="page-title">@lang('cookies.title')</h2>
            </div>

            <div class="about-us__content pb-5 mb-5">
                <div class="mw-930">
                    <h3 class="mb-4">@lang('cookies.what.title')</h3>
                    <p class="mb-3">@lang('cookies.what.description')</p>

                    <h3 class="mb-4">@lang('cookies.why.title')</h3>
                    <p class="mb-3">@lang('cookies.why.description')</p>

                    <h3 class="mb-4">@lang('cookies.examples.title')</h3>
                    <ul class="mb-3">
                        <li>@lang('cookies.examples.point1')</li>
                        <li>@lang('cookies.examples.point2')</li>
                        <li>@lang('cookies.examples.point3')</li>
                        <li>@lang('cookies.examples.point4')</li>
                        <li>@lang('cookies.examples.point5')</li>
                    </ul>

                    <h3 class="mb-4">@lang('cookies.disable.title')</h3>
                    <p class="mb-3">@lang('cookies.disable.description')</p>

                    <h3 class="mb-4">@lang('cookies.types.title')</h3>
                    <p class="mb-3">@lang('cookies.types.description')</p>

                    <h3 class="mb-4">@lang('cookies.table.required.title')</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>@lang('cookies.table.name')</th>
                                <th>@lang('cookies.table.duration')</th>
                                <th>@lang('cookies.table.purpose')</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>laravel_session</td>
                                <td>@lang('cookies.session')</td>
                                <td>@lang('cookies.table.required.session')</td>
                            </tr>
                            <tr>
                                <td>XSRF-TOKEN</td>
                                <td>@lang('cookies.session')</td>
                                <td>@lang('cookies.table.required.xsrf')</td>
                            </tr>
                        </tbody>
                    </table>

                    <h3 class="mt-5 mb-4">@lang('cookies.table.marketing.title')</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>@lang('cookies.table.name')</th>
                                <th>@lang('cookies.table.duration')</th>
                                <th>@lang('cookies.table.purpose')</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>CONSENT</td>
                                <td>20 let</td>
                                <td>@lang('cookies.table.marketing.consent')</td>
                            </tr>
                            <tr>
                                <td>NID</td>
                                <td>6 mesecev</td>
                                <td>@lang('cookies.table.marketing.nid')</td>
                            </tr>
                            <tr>
                                <td>IDE</td>
                                <td>1 leto</td>
                                <td>@lang('cookies.table.marketing.ide')</td>
                            </tr>
                            <tr>
                                <td>DSID</td>
                                <td>10 dni</td>
                                <td>@lang('cookies.table.marketing.dsid')</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>
</x-app>
