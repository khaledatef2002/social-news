<!DOCTYPE html>
<html lang="{{ LaravelLocalization::getCurrentLocale() }}" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">
@include('front.partials._head')
<body>
    @include('front.partials._header')
    
    @yield('content')

    @include('front.partials._footer')
    @include('front.partials._jslibs')
</body>
</html>