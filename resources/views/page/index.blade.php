@extends('layouts.app')

@section('title', $page->title)
@section('description', $page->description)
@push('og')
<meta property="og:title" content="{{ $page->title }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ request()->getUri() }}">
    <meta property="og:image" content="{{ asset($page->image ? $page->image->path : 'img/logo.png') }}">
    <meta property="og:description" content="{{ $page->description }}">
    <meta property="og:site_name" content="Вилла «SANY»">
    <meta property="og:locale" content="ru_RU">
@endpush

@section('content')

    @includeWhen($page->slider, 'layouts.sections.slider', ['slider' => $page->slider])

    @include('layouts.sections.advantages')

    @includeWhen($services, 'layouts.sections.services')

    @includeWhen($ourServicesInMain, 'layouts.sections.our_services')

    @includeWhen($guestbookLast, 'layouts.sections.guestbook')

    @include('layouts.sections.booking')

    <main class="main__text">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>{{ $page->name }}</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-9">
                    <div class="seo__text content">
                        {!! $page->text !!}
                    </div>
                </div>
                <div class="col-3">
                    <div class="poem">
                        <div class="poem__title">«СКИФ»</div>
                        <p>Из нереальности,<br> А может из Мечты,<br>
                            Возник Поселок<br> Удивительной красы.</p>
                        <p>Здесь все имеет<br> Притягательную власть,<br>
                            Куда б ни посмотрел,<br>
                            На что б ни бросил взгляд.<br>
                            Дома архитектурно хороши-<br>
                            Ни дать, ни взять, ну просто<br>
                            Женихи!</p>
                        <p>И как невеста в белом у венца<br>
                            Внизу стоит ротонда,<br> Величава и горда.<br>
                            И улицу Чудесную вершит…</p>
                        <p>А море! Море - знай себе шумит!<br>
                            Но главное хочу сказать в итоге,<br>
                            Живут на этой улице Поповы!<br>
                            Прекрасная, скажу я вам, чета.</p>
                        <p>Теперь я знаю вас,<br>
                            А вы меня!<br> Спасибо Вам за все!</p>
                        <p class="poem__author">Расима, Римма.<br>Сентябрь 2008 г.</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @includeWhen($page->gallery, 'layouts.sections.gallery', ['gallery' => $page->gallery])

@endsection
