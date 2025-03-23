<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('front/images/logo.png') }}">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('front/libs/bootstrap-5.3.3-dist/css/bootstrap'. (LaravelLocalization::getCurrentLocaleDirection() == 'rtl' ? '.rtl' : '') . '.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/libs/fontawesome-free-6.7.2-web/css/all.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('front/libs/intl-tel-input/css/intlTelInput.css') }}">
    <link rel="stylesheet" href="{{ asset('front/libs/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/main.css') }}">
    @if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
        <link rel="stylesheet" href="{{ asset('front/css/main.rtl.css') }}">
    @endif
    <script defer src="{{ asset('front/js/main.js') }}" type="module"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>