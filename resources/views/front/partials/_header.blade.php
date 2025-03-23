@php
    use Carbon\Carbon;
    Carbon::setLocale(LaravelLocalization::getCurrentLocale());
@endphp
<div id="header-container">
    <div class="weather_date d-flex justify-content-between px-3 py-1">
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

    @include('front.partials._nav')
</div>