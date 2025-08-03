<x-app title="{{ __('About Us') }}">
    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="contact-us container">
            <div class="mw-930">
                <h2 class="page-title">@lang('About Us')</h2>
            </div>

            <div class="about-us__content pb-5 mb-5">
                <p class="mb-5">
                    <img
                        loading="lazy"
                        class="w-100 h-auto d-block"
                        src="assets/images/about/about-1.jpg"
                        width="1410"
                        height="550"
                        alt=""
                    />
                </p>
                <div class="mw-930">
                    <h3 class="mb-4">@lang('story.title')</h3>
                    <p class="fs-6 fw-medium mb-4">@lang('story.paragraph1')</p>
                    <p class="mb-4">@lang('story.paragraph2')</p>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h5 class="mb-3">@lang('story.mission_title')</h5>
                            <p class="mb-3">@lang('story.mission_text')</p>
                        </div>
                        <div class="col-md-6">
                            <h5 class="mb-3">@lang('story.vision_title')</h5>
                            <p class="mb-3">@lang('story.vision_text')</p>
                        </div>
                    </div>
                </div>

                <div class="mw-930 d-lg-flex align-items-lg-center">
                    <div class="image-wrapper col-lg-6">
                        <img
                            class="h-auto"
                            loading="lazy"
                            src="assets/images/about/about-1.jpg"
                            width="450"
                            height="500"
                            alt=""
                        >
                    </div>

                </div>
            </div>
        </section>


    </main>

</x-app>
