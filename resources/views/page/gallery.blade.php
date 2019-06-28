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

    <section class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>{{ $page->name }}</h1>
                    <ul>
                        <li><a href="{{ route('page.show') }}">Главная</a></li>
                        <li>{{ $page->name }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <main>
        <div class="container">
            <div class="row">
                <div class="col-12 flex-start">
                    <div class="content page__content">
                        {!! $page->text !!}
                    </div>
                </div>
            </div>
        </div>
        @if(count($gallery))
            <div class="gallery__filter">
                <ul>
                    <li class="active" data-filter="all">Все фото</li>
                    @foreach($gallery as $item)
                        <li data-filter="cat__{{ $item->id }}">{{ $item->name }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="gallery__box">
                @foreach($gallery as $item)
                    @if(count($item->images))
                        @foreach($item->images as $image)
                            <figure class="cat__{{ $image->gallery_id }} all">
                                <img src="{{ $image->getThumb() }}" alt="{{ $image->alt }}" title="{{ $image->title }}">
                                <a href="{{ $image->getPath() }}" data-lightbox="gallery">
                                    <svg class="icon">
                                        <use xlink:href="{{ asset('img/symbols.svg#search') }}"></use>
                                    </svg>
                                </a>
                            </figure>
                        @endforeach
                    @endif
                @endforeach
            </div>
        @endif
    </main>

    @includeWhen($page->gallery, 'layouts.sections.gallery', ['gallery' => $page->gallery])

@endsection
