@extends('layouts.app')

@section('title', $article->getTitle())
@section('description', $article->getDescription())
@push('og')
    <meta property="og:title" content="{{ $article->title }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ request()->getUri() }}">
    <meta property="og:image" content="{{ asset($article->image ? $article->image->path : 'images/logo.png') }}">
    <meta property="og:description" content="{{ $article->description }}">
    <meta property="og:site_name" content="Всё для бани">
    <meta property="og:locale" content="ru_RU">
@endpush

@section('content')
    @includeWhen($article->slider, 'layouts.sections.slider', ['slider' => $article->slider])

    <section class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>{{ $article->name }}</h1>
                    <ul>
                        <li><a href="{{ route('page.show') }}">Главная</a></li>
                        <li><a href="{{ route('page.show',['alias' => 'articles']) }}">Статьи</a></li>
                        <li>{{ $article->name }}</li>
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
                        @if($article->image)
                        <img src="{{ asset($article->image->path) }}" alt="{{ $article->image->alt }}" title="{{ $article->image->title }}" class="responsive">
                        @endif
                        {!! $article->text !!}
                    </div>
                </div>
                <div class="col-3 flex-start">
                    @include('layouts.partials.sb_list')
                </div>
            </div>
        </div>
    </main>


    @includeWhen($article->gallery, 'layouts.sections.gallery', ['gallery' => $article->gallery])

@endsection
