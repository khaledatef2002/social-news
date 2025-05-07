@extends('front.layouts.main')

@section('content')
<main class="py-3 col-12 d-flex flex-column">
    <div class="w-100 d-flex justify-content-center mb-3">
        <h3 class="align-self-start mx-auto d-block">@lang('front.terms.title')</h3>
    </div>
    <div class="card border-0 shadow-sm p-3 col-md-8 mx-auto">
        <ol>
            <li>
                <p class="fw-bold mb-0">@lang('front.terms.content.introduction.title')</p>
            </li>
            <p>@lang('front.terms.content.introduction.text')</p>
            
            <li>
                <p class="fw-bold mb-0">@lang('front.terms.content.user_obligations.title')</p>
            </li>
            <ul class="mb-2">
                @foreach(trans('front.terms.content.user_obligations.items', [], app()->getLocale()) as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
            
            <li>
                <p class="fw-bold mb-0">@lang('front.terms.content.publishing_terms.title')</p>
            </li>
            <ul class="mb-2">
                @foreach(__('front.terms.content.publishing_terms.items') as $item)
                <li>{{ $item }}</li>
                @endforeach
            </ul>
            
            <li>
                <p class="fw-bold mb-0">@lang('front.terms.content.intellectual_property.title')</p>
            </li>
            <ul class="mb-2">
                @foreach(__('front.terms.content.intellectual_property.items') as $item)
                <li>{{ $item }}</li>
                @endforeach
            </ul>
            
            <li>
                <p class="fw-bold mb-0">@lang('front.terms.content.privacy_policy.title')</p>
            </li>
            <ul class="mb-2">
                @foreach(__('front.terms.content.privacy_policy.items') as $item)
                <li>{{ $item }}</li>
                @endforeach
            </ul>
            
            <li>
                <p class="fw-bold mb-0">@lang('front.terms.content.comments.title')</p>
            </li>
            <ul class="mb-2">
                @foreach(__('front.terms.content.comments.items') as $item)
                <li>{{ $item }}</li>
                @endforeach
            </ul>
            
            <li>
                <p class="fw-bold mb-0">@lang('front.terms.content.modifications.title')</p>
            </li>
            <ul class="mb-2">
                @foreach(__('front.terms.content.modifications.items') as $item)
                <li>{{ $item }}</li>
                @endforeach
            </ul>
            
            <li>
                <p class="fw-bold mb-0">@lang('front.terms.content.disclaimer.title')</p>
            </li>
            <ul class="mb-2">
                @foreach(__('front.terms.content.disclaimer.items') as $item)
                <li>{{ $item }}</li>
                @endforeach
            </ul>
            
            <p class="fw-bold">@lang('front.terms.content.conclusion')</p>
        </ol>
    </div>
</main>
@endsection