@extends('layouts.app')

@section('title', $page->title)
@section('description', $page->description)
@push('og')
    <meta property="og:title" content="{{ $page->title }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ request()->getUri() }}">
    <meta property="og:image" content="{{ asset($page->image ? $page->image->path : 'images/logo.png') }}">
    <meta property="og:description" content="{{ $page->description }}">
    <meta property="og:site_name" content="Всё для бани">
    <meta property="og:locale" content="ru_RU">
@endpush

@section('content')
    @includeWhen($page->slider, 'layouts.sections.slider', ['slider' => $page->slider])

    <section class="breadcrumbs-custom">
        <div class="parallax-container" data-parallax-img="{{ $page->image ? $page->image->path : asset('images/bg-default.jpg') }}">
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
            <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3Ac4db9bb6e87fa6d628253543b41ef61b3a8bde8c8d8cd63bca063905416cf583&amp;source=constructor" width="100%" height="400" frameborder="0"></iframe>
        </div>
    </section>

@endsection
