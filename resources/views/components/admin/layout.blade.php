<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <!-- CSRF Token -->
    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    @props(['title' => null])

    <title style="text-transform: uppercase">{{ config('app.name', 'Shop Name') }}
        @isset($title)
            | {{ $title }}
        @endisset
    </title>

    <meta
        http-equiv="content-type"
        content="text/html; charset=utf-8"
    />
    <meta
        name="author"
        content="AS Storitve"
    />
    <link
        rel="stylesheet"
        type="text/css"
        href="{{ asset('css/animate.min.css') }}"
    >
    <link
        rel="stylesheet"
        type="text/css"
        href="{{ asset('css/animation.css') }}"
    >
    <link
        rel="stylesheet"
        type="text/css"
        href="{{ asset('css/bootstrap.css') }}"
    >
    <link
        rel="stylesheet"
        type="text/css"
        href="{{ asset('css/bootstrap-select.min.css') }}"
    >
    <link
        rel="stylesheet"
        type="text/css"
        href="{{ asset('css/style.css') }}"
    >
    <link
        rel="stylesheet"
        href="{{ asset('font/fonts.css') }}"
    >
    <link
        rel="stylesheet"
        href="{{ asset('icon/style.css') }}"
    >
    <link
        rel="shortcut icon"
        href="{{ asset('assets/images/favicon.ico') }}"
    >
    <link
        rel="apple-touch-icon-precomposed"
        href="{{ asset('assets/images/favicon.ico') }}"
    >
    <link
        rel="stylesheet"
        type="text/css"
        href="{{ asset('css/sweetalert.min.css') }}"
    >
    <link
        rel="stylesheet"
        type="text/css"
        href="{{ asset('css/custom.css') }}"
    >
    <link
        rel="stylesheet"
        type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
    >
    <style>
        .toastr {
            font-size: 18px;
            /* Adjust the font size */
        }

        .toast-message {
            font-size: 18px;
            /* Adjust message text size */
        }

        .toast {
            width: 350px !important;
            /* Adjust the width */
        }
    </style>

    @stack('styles')

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])





</head>

<body class="body">
    @php
        use App\Models\Contact;
        $unreadMessages = Contact::where('read', false)->get();
        $unreadCount = Contact::where('read', false)->count();
    @endphp
    <div id="wrapper">
        <div
            id="page"
            class=""
        >
            <div class="layout-wrap">

                <!-- <div id="preload" class="preload-container">
  <div class="preloading">
      <span></span>
  </div>
</div> -->

                <div class="section-menu-left">
                    <div class="box-logo">
                        <a
                            id="site-logo-inner"
                            href="{{ route('home.index') }}"
                        >
                            <img
                                id="logo_header_1"
                                class=""
                                alt=""
                                src="{{ asset('assets/images/logo.png') }}"
                                data-light={{ asset('assets/images/logo.png') }}
                                data-dark={{ asset('assets/images/logo.png') }}
                            >
                        </a>
                        <div class="button-show-hide">
                            <i class="icon-menu-left"></i>
                        </div>
                    </div>
                    @include('layouts.admin-navigation')

                </div>
                <div class="section-content-right">

                    <div class="header-dashboard">
                        <div class="wrap">
                            <div class="header-left">
                                <a href="index-2.html">
                                    <img
                                        id="logo_header_mobile"
                                        class=""
                                        alt=""
                                        src="{{ asset('images/logo/logo.png') }}"
                                        data-light={{ asset('images/logo/logo.png') }}"
                                        data-dark={{ asset('images/logo/logo.png') }}"
                                        data-width="154px"
                                        data-height="52px"
                                        data-retina={{ asset('images/logo/logo.png') }}"
                                    >
                                </a>
                                <div class="button-show-hide">
                                    <i class="icon-menu-left"></i>
                                </div>


                                {{-- <form class="form-search flex-grow">
                                    <fieldset class="name">
                                        <input
                                            id="search-input"
                                            type="text"
                                            placeholder="@lang('Search')..."
                                            class="show-search"
                                            name="name"
                                            tabindex="2"
                                            value=""
                                            aria-required="true"
                                            required=""
                                            autocomplete="off"
                                            data-search-type="products"
                                        >
                                    </fieldset>
                                    <div class="button-submit">
                                        <button
                                            class=""
                                            type="submit"
                                        ><i class="icon-search"></i></button>
                                    </div>
                                    <div class="box-content-search">
                                        <ul id="box-content-search"></ul>
                                    </div>
                                </form> --}}

                            </div>
                            <div class="header-grid">
                                <div class="popup-wrap message type-header">
                                    @foreach (config('app.supported_locales') as $locale)
                                        @if ($locale !== app()->getLocale())
                                            <span style="padding-left: 15px;">
                                                <a href="{{ route('change-locale', $locale) }}">

                                                    <img
                                                        src="{{ asset('assets/images/' . $locale . '.png') }}"
                                                        style="width:20px"
                                                        alt="{{ $locale }}"
                                                        srcset=""
                                                    >
                                                </a>
                                            </span>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="popup-wrap message type-header">
                                    <div class="dropdown">
                                        <button
                                            id="dropdownMenuButton2"
                                            class="btn btn-secondary dropdown-toggle"
                                            type="button"
                                            data-bs-toggle="dropdown"
                                            aria-expanded="false"
                                        >
                                            <span class="header-item">
                                                <span class="text-tiny">{{ $unreadCount }}</span>

                                                <i class="icon-mail"></i>
                                            </span>
                                        </button>
                                        <ul
                                            class="dropdown-menu dropdown-menu-end has-content"
                                            aria-labelledby="dropdownMenuButton2"
                                        >
                                            <li>
                                                <h6>Notifications</h6>
                                            </li>

                                            @foreach ($unreadMessages as $message)
                                                <li>
                                                    <a
                                                        href="{{ route('admin.contact.show', ['id' => $message->id]) }}">
                                                        <div class="message-item item-1">
                                                            <div class="image">
                                                                <i class="icon-mail"></i>
                                                            </div>
                                                            <div>
                                                                <div class="body-title-2">{{ $message->name }}</div>
                                                                <div class="text-tiny">{{ $message->subject }}</div>

                                                            </div>
                                                            <div class="text-tiny">
                                                                {{ $message->created_at->diffForHumans() }}
                                                            </div>
                                                        </div>
                                                    </a>

                                                </li>
                                            @endforeach


                                            <li><a
                                                    href="{{ route('admin.contacts') }}"
                                                    class="tf-button w-full"
                                                >View all</a></li>
                                        </ul>
                                    </div>
                                </div>




                                <div class="popup-wrap user type-header">
                                    <div class="dropdown">
                                        <button
                                            id="dropdownMenuButton3"
                                            class="btn btn-secondary dropdown-toggle"
                                            type="button"
                                            data-bs-toggle="dropdown"
                                            aria-expanded="false"
                                        >
                                            <span class="header-user wg-user">
                                                <span class="image">
                                                    <img
                                                        src="{{ asset('uploads/users/thumbnails') }}/{{ Auth::user()->image ?? 'man.png' }}"
                                                        alt=""
                                                    >
                                                </span>
                                                <span class="flex flex-column">
                                                    <span class="body-title mb-2">{{ Auth::user()->name }}</span>
                                                    <span class="text-tiny">@lang('Admin')</span>
                                                </span>
                                            </span>
                                        </button>
                                        <ul
                                            class="dropdown-menu dropdown-menu-end has-content"
                                            aria-labelledby="dropdownMenuButton3"
                                        >

                                            <li>
                                                <form
                                                    id="logout-form"
                                                    action="{{ route('logout') }}"
                                                    method="POST"
                                                >
                                                    @csrf
                                                    <a
                                                        href="{{ route('logout') }}"
                                                        class="user-item"
                                                        onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                                                    >
                                                        <div class="icon">
                                                            <i class="icon-log-out"></i>
                                                        </div>
                                                        <div class="body-title-2">@lang('Log Out')</div>
                                                    </a>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="main-content">

                        {{ $slot }} <!-- This will insert page-specific content -->


                        <div class="bottom-page">
                            <div class="body-text">@lang('Copyright') © {{ now()->year }} AS Storitve</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/apexcharts/apexcharts.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>



    <script>
        $(document).ready(function() {
            toastr.options = {
                closeButton: true,
                progressBar: true,
                timeOut: 4000
            };
            @if (Session::has('message'))
                var type = "{{ Session::get('alert-type', 'info') }}"
                switch (type) {
                    case 'info':
                        toastr.info(" {{ Session::get('message') }} ");
                        break;

                    case 'success':
                        toastr.success(" {{ Session::get('message') }} ");
                        break;

                    case 'warning':
                        toastr.warning(" {{ Session::get('message') }} ");
                        break;

                    case 'error':
                        toastr.error(" {{ Session::get('message') }} ");
                        break;
                }
            @endif
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        $('#myFile').on('change', function(e) {
            const photoInp = $('#myFile');
            const [file] = this.files;
            if (file) {
                $('#imgpreview img').attr('src', URL.createObjectURL(file));
                $('#imgpreview').show();
            }
        })


        // Select only the input field for the 'en' locale
        $('input').on('change', function() {
            var locale = $(this).attr('data-locale');
            var inputName = $(this).attr('name');

            // If input is for the 'en' locale or if it's the non-localized 'name' field, update the slug
            if (locale === "en" || inputName === "name") {
                $('input[name="slug"]').val(StringToSlug($(this).val()));
            }
        });

        function StringToSlug(Text) {
            return Text.toLowerCase()
                .replace(/[^\w ]+/g, '')
                .replace(/ +/g, '-');
        }
    </script>



    <script>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        @endif
    </script>

    <script>
        $(function() {
            $('.delete').on('click', function(e) {
                e.preventDefault();
                var form = $(this).closest('form');
                swal({
                    title: "@lang('Are you sure?')",
                    text: "@lang('You won/t be able to revert this!')",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "@lang('Yes, delete it!')",
                    cancelButtonText: "@lang('No, cancel it!')",
                }).then((result) => {
                    if (result) {
                        form.submit();
                    }
                });
            })
        })
    </script>

    @stack('scripts')
</body>



</html>
