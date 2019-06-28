@extends('layouts.app')

@section('title', $ourService->title)
@section('description', $ourService->description)
@push('og')
    <meta property="og:title" content="{{ $ourService->title }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ request()->getUri() }}">
    <meta property="og:image" content="{{ asset($ourService->image ? $ourService->image->path : 'img/logo.png') }}">
    <meta property="og:description" content="{{ $ourService->description }}">
    <meta property="og:site_name" content="Всё для бани">
    <meta property="og:locale" content="ru_RU">
@endpush

@section('content')
    @includeWhen($ourService->slider, 'layouts.sections.slider', ['slider' => $ourService->slider])

    <section class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>{{ $ourService->name }}</h1>
                    <ul>
                        <li><a href="{{ route('page.show') }}">Главная</a></li>
                        <li><a href="{{ route('page.show',['alias' => 'our-services']) }}">Наши услуги</a></li>
                        <li>{{ $ourService->name }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <main>
        <div class="container">
            <div class="row">
                <div class="col-9 flex-start">
                    <div class="content page__content">
                        @if($ourService->image)
                        <img src="{{ asset($ourService->image->path) }}" alt="{{ $ourService->image->alt }}" title="{{ $ourService->image->title }}" class="responsive">
                        @endif
                        {!! $ourService->text !!}
                    </div>
                </div>
                <div class="col-3 flex-start">
                    @include('layouts.partials.sb_list')
                </div>
            </div>
        </div>
    </main>


    @includeWhen($ourService->gallery, 'layouts.sections.gallery', ['gallery' => $ourService->gallery])

@endsection
