@extends('front.layouts.main')

@section('content')
<main class="py-3 col-12 d-flex flex-column">
    <div class="w-100 d-flex justify-content-center mb-3">
        <h3 class="align-self-start mx-auto d-block">@lang('front.about.title')</h3>
    </div>
    <div class="card border-0 shadow-sm p-3 col-md-8 mx-auto">
        <p class="fw-bold mb-0">@lang('front.about.content.welcome.title')</p>
        @foreach(__('front.about.content.welcome.paragraphs') as $paragraph)
            <p class="mb-2">{{ $paragraph }}</p>
        @endforeach
        
        <p class="fw-bold mb-0">@lang('front.about.content.mission.title')</p>
        <p class="mb-2">@lang('front.about.content.mission.text')</p>
        
        <p class="fw-bold mb-0">@lang('front.about.content.vision.title')</p>
        <p class="mb-2">@lang('front.about.content.vision.text')</p>
        
        <p class="fw-bold mb-0">@lang('front.about.content.who_we_are.title')</p>
        @foreach(__('front.about.content.who_we_are.paragraphs') as $paragraph)
            <p class="mb-0">{{ $paragraph }}</p>
        @endforeach
        
        <p class="fw-bold mb-0">@lang('front.about.content.values.title')</p>
        <ul>
            @foreach(__('front.about.content.values.items') as $item)
            <li class="d-flex gap-2">
                <p class="fw-bold mb-0">{{ $item['title'] }}</p>
                <p class="mb-0">{{ $item['text'] }}</p>
            </li>
            @endforeach
        </ul>
        
        <p>@lang('front.about.content.closing')</p>
    </div>
</main>
@endsection