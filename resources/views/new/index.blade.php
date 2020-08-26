@extends('layouts.app')

@section('title', $new->getTitle())
@section('description', $new->getDescription())
@push('og')
    <meta property="og:title" content="{{ $new->getTitle() }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ request()->getUri() }}">
    <meta property="og:image" content="{{ asset($new->image ? $new->image->path : 'images/logo.png') }}">
    <meta property="og:description" content="{{ $new->getDescription() }}">
    <meta property="og:site_name" content="Private Estate - недвижимость для жизни">
    <meta property="og:locale" content="ru_RU">
@endpush

@section('content')

    <section class="breadcrumbs-custom no__bg">
        <div class="breadcrumbs-custom-body parallax-content context-dark">
            <div class="container">
                <h2 class="breadcrumbs-custom-title">{{ $new->name }}</h2>
            </div>
        </div>
        <div class="breadcrumbs-custom-footer">
            <div class="container">
                <ul class="breadcrumbs-custom-path">
                    <li><a href="{{ route('page.show') }}">Главная</a></li>
                    <li><a href="{{ route('page.show', ['alias' => 'news']) }}">Наши новости</a></li>
                    <li class="active">{{ $new->name }}</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="section section-content bg-default text-justify">
        <div class="container">
            <div class="row row-xl row-30">
                <div class="col-md-12">
                    {!! $new->text !!}
                </div>
            </div>
        </div>
    </section>

@endsection
