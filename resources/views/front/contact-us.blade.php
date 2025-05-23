@extends('front.layouts.main')

@section('content')
<main class="py-3 col-12 d-flex flex-column">
    @if (isset($ad))
        <div class="ad mb-3 mx-auto">
            <a href="{{ $ad->redirect_link }}" target="_blank">
                <img src="{{ asset($ad->cover) }}" title="{{  $ad->title }}" alt="{{  $ad->title }}">
            </a>
        </div>
    @endif
    <div class="w-100 d-flex justify-content-center mb-3">
        <h3 class="align-self-start mx-auto d-block">@lang('front.contact.title')</h3>
    </div>
    <div class="card border-0 shadow-sm p-3 col-md-8 mx-auto">
        <form id="contact-us-form" method="POST">
            @csrf
            <div class="d-flex gap-2 flex-wrap">
                <div class="flex-fill">
                    <label for="first_name" class="form-label">{{ __('front.contact.form.first_name') }}</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" required>
                </div>
    
                <div class="flex-fill">
                    <label for="last_name" class="form-label">{{ __('front.contact.form.last_name') }}</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">{{ __('front.contact.form.email') }}</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">{{ __('front.contact.form.message') }}</label>
                <textarea class="form-control" id="message" name="message" rows="5"></textarea>
            </div>
            <button type="submit" class="btn btn-dark px-4 w-100 loader-btn">
                <p>{{ __('front.contact.form.submit') }}</p>
                <span class="loader"></span>
            </button>
        </form>
    </div>
    <div class="card border-0 shadow-sm p-3 col-md-8 mx-auto mt-3">
        <div class="row">
            <div class="col-md-6 text-center border-end">
                <h5><i class="fab fa-whatsapp text-success"></i> {{ __('front.contact.whatsapp') }}</h5>
                <p class="mb-0">
                    <a href="https://wa.me/971562322266" target="_blank" class="text-dark">
                        +971 56 232 2266
                    </a>
                </p>
            </div>
            <div class="col-md-6 text-center border-start">
                <h5><i class="far fa-envelope text-primary"></i> {{ __('front.contact.email') }}</h5>
                <p class="mb-0">
                    <a href="mailto:info@suhail.ae" class="text-dark">
                        info@suhail.ae
                    </a>
                </p>
            </div>
        </div>
    </div>
    <div class="card border-0 shadow-sm p-3 col-md-8 mx-auto mt-3">
        <div class="row">
            <div class="col-12 text-center">
                <h5>{{ __('front.contact.location') }}</h5>
                <p>{{ __('front.contact.address') }}</p>
                <div class="ratio ratio-16x9">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3607.2686277238957!2d55.4176249!3d25.2765354!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f5d91ae9d9bfb%3A0x53ad7d26930a3b67!2z2YXYtdmGINin2YTYqSDYp9mE2KjYsdmK2Kkg2KfZhNio2K3Yt9in2Kog2KfZhNio2LHYp9iv2Yog2YTZg9ix2YrYqSDZhNin2YTYq9mE2YjZhg!5e0!3m2!1sar!2sae!4v1716021829007!5m2!1sar!2sae" 
                        width="600" 
                        height="450" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection