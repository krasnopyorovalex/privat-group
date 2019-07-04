@extends('layouts.app')

@section('title', $page->title)
@section('description', $page->description)
@push('og')
    <meta property="og:title" content="{{ $page->title }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ request()->getUri() }}">
    <meta property="og:image" content="{{ asset($page->image ? $page->image->path : 'img/logo.png') }}">
    <meta property="og:description" content="{{ $page->description }}">
    <meta property="og:site_name" content="Всё для бани">
    <meta property="og:locale" content="ru_RU">
@endpush

@section('content')
    @includeWhen($page->slider, 'layouts.sections.slider', ['slider' => $page->slider])

    <section class="breadcrumbs-custom">
        <div class="parallax-container" data-parallax-img="{{ $page->image ? $page->image->path : '' }}">
            <div class="breadcrumbs-custom-body parallax-content context-dark">
                <div class="container">
                    <h2 class="breadcrumbs-custom-title">{{ $page->name }}</h2>
                </div>
            </div>
        </div>
        <div class="breadcrumbs-custom-footer">
            <div class="container">
                <ul class="breadcrumbs-custom-path">
                    <li><a href="{{ route('page.show') }}">Главная</a></li>
                    <li class="active">{{ $page->name }}</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="section section-content bg-default text-justify">
        <div class="container">
            <div class="row row-xl row-30 justify-content-center">
                <div class="col-md-12">
                    {!! $page->text !!}
                </div>
            </div>
        </div>
    </section>

    @includeWhen($page->gallery, 'layouts.sections.gallery', ['gallery' => $page->gallery])

    <section class="section">
        <div class="yandex-map-container">
            <script charset=utf-8 async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Ace6eeb18be41210fad23ae6362d774483db8f1ed4b28eba8181464ac5c684de3&amp;width=100%25&amp;height=400&amp;lang=ru_RU&amp;scroll=false"></script>
        </div>
    </section>

@endsection
