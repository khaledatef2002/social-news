<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset($website_settings->logo) }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('front/libs/bootstrap-5.3.3-dist/css/bootstrap'. (LaravelLocalization::getCurrentLocaleDirection() == 'rtl' ? '.rtl' : '') . '.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/libs/fontawesome-free-6.7.2-web/css/all.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('front/libs/intl-tel-input/css/intlTelInput.css') }}">
    <link rel="stylesheet" href="{{ asset('front/libs/sweetalert2/sweetalert2.min.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('front/css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css"/>
    <link rel="stylesheet" href="{{ asset('front/css/responsive.css') }}" />
    @if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
        <link rel="stylesheet" href="{{ asset('front/css/main.rtl.css') }}">
    @endif
    <link rel="stylesheet" href="{{ asset('front/css/dark.css') }}">
    <script defer src="{{ asset('front/js/main.js') }}" type="module"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('head-additional')
</head>