@extends('layouts.app')

@section('title', $new->getTitle())
@section('description', $new->getDescription())
@push('og')
    <meta property="og:title" content="{{ $new->getTitle() }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ request()->getUri() }}">
    <meta property="og:image" content="{{ asset($new->image ? $new->image->path : 'img/logo.png') }}">
    <meta property="og:description" content="{{ $new->getDescription() }}">
    <meta property="og:site_name" content="Вилла «SANY»">
    <meta property="og:locale" content="ru_RU">
@endpush

@section('content')
    @includeWhen($new->slider, 'layouts.sections.slider', ['slider' => $new->slider])

    <section class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>{{ $new->name }}</h1>
                    <ul>
                        <li><a href="{{ route('page.show') }}">Главная</a></li>
                        <li><a href="{{ route('page.show',['alias' => 'news']) }}">Новости</a></li>
                        <li>{{ $new->name }}</li>
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
                        @if($new->image)
                        <img src="{{ asset($new->image->path) }}" alt="{{ $new->image->alt }}" title="{{ $new->image->title }}" class="responsive">
                        @endif
                        {!! $new->text !!}
                    </div>
                </div>
                <div class="col-3 flex-start">
                    @include('layouts.partials.sb_list')
                </div>
            </div>
        </div>
    </main>


    @includeWhen($new->gallery, 'layouts.sections.gallery', ['gallery' => $new->gallery])

@endsection
