@extends('layouts.app')

@section('title', $service->title)
@section('description', $service->description)
@push('og')
    <meta property="og:title" content="{{ $service->title }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ request()->getUri() }}">
    <meta property="og:image" content="{{ asset($service->image ? $service->image->path : 'img/logo.png') }}">
    <meta property="og:description" content="{{ $service->description }}">
    <meta property="og:site_name" content="Всё для бани">
    <meta property="og:locale" content="ru_RU">
@endpush

@section('content')
    @includeWhen($service->slider, 'layouts.sections.slider', ['slider' => $service->slider])

    <section class="breadcrumbs-custom">
        <div class="parallax-container" data-parallax-img="{{ $service->image ? $service->image->path : '' }}">
            <div class="breadcrumbs-custom-body parallax-content context-dark">
                <div class="container">
                    <h2 class="breadcrumbs-custom-title">{{ $service->name }}</h2>
                </div>
            </div>
        </div>
        <div class="breadcrumbs-custom-footer">
            <div class="container">
                <ul class="breadcrumbs-custom-path">
                    <li><a href="{{ route('page.show') }}">Главная</a></li>
                    <li><a href="{{ route('page.show', ['alias' => 'services']) }}">Наши услуги</a></li>
                    <li class="active">{{ $service->name }}</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="section section-content bg-default text-justify">
        <div class="container">
            <div class="row row-xl row-30 justify-content-center">
                <div class="col-md-12">
                    {!! $service->text !!}
                </div>
            </div>
        </div>
    </section>

    @if($service->images)
    <div class="container">
        <div class="row row-30 isotope" data-lightgallery="group">
            @foreach ($service->images as $image)
                <div class="col-md-4 col-sm-4 col-lg-4 col-xs-12">
                    <!-- Thumbnail Classic-->
                    <article class="thumbnail-classic">
                        <div class="thumbnail-classic-figure">
                            <a href="{{ $image->getPath() }}" data-lightgallery="item" title="{{ $image->name }}">
                                <img src="{{ $image->getThumb() }}" alt="{{ $image->alt }}" title="{{ $image->title }}" />
                            </a>
                        </div>
                    </article>
                </div>
            @endforeach
        </div>
    </div>
    @endif

@endsection