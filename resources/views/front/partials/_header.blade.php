@php
    use Carbon\Carbon;
    Carbon::setLocale(LaravelLocalization::getCurrentLocale());
@endphp
<div id="header-container">
    <div class="weather_date d-flex justify-content-between px-3 py-1">
        <div class="header-start d-flex align-items-center gap-3">
            <div class="weather d-flex gap-2">
                <div class="weather-icon">
                    <i class="fa-solid fa-temperature-three-quarters"></i>
                </div>
                <div class="weather-info">
                    <span class="weather-temp fw-bold">
                        <div id="click-for-location-permission" role="button">Allow Location</div>
                    </span>
                </div>
            </div>
            <div class="date fw-bold">
                <i class="fa-solid fa-calendar-days"></i>
                <span class="day">{{ Carbon::now()->translatedFormat('l') }}</span>
                <span class="date">{{ Carbon::now()->translatedFormat('d M, Y') }}</span>
            </div>
        </div>
        <div class="header-end d-flex align-items-center gap-3">
            <div class="dropdown ms-1">
                <button id="lang_open" type="button" class="btn btn-icon btn-topbar rounded-circle">
                    <img id="header-lang-img" src="{{ asset('front/images/' . LaravelLocalization::getCurrentLocale() . '.svg') }}" alt="Header Language" height="20" class="rounded">
                </button>
                <div class="lang-menu">
                    @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        @if ($localeCode != LaravelLocalization::getCurrentLocale())
                            <a href="{{ LaravelLocalization::getLocalizedURL($localeCode) }}" class="dropdown-item notify-item language py-2" data-lang="{{ $localeCode }}" title="{{ $properties['native'] }}">
                                <img src="{{ asset('front/images/' . $localeCode . '.svg') }}" alt="user-image" class="me-2 rounded" height="18">
                                <span class="align-middle">{{ $properties['native'] }}</span>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
            <i class="far fa-moon fs-4 ms-2" role="button"></i>
        </div>
    </div>

    @include('front.partials._nav')
</div>