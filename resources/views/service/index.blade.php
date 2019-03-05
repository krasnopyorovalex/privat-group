@extends('layouts.app')

@section('title', $service->title)
@section('description', $service->description)
@push('og')
<meta property="og:title" content="{{ $service->title }}">
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ request()->getUri() }}">
    <meta property="og:image" content="{{ asset($service->image ? $service->image->path : 'img/logo.png') }}">
    <meta property="og:description" content="{{ $service->description }}">
    <meta property="og:site_name" content="Бравый турист">
    <meta property="og:locale" content="ru_RU">
@endpush
@section('content')
    <section class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Стандарт</h1>
                    <ul>
                        <li><a href="{{ route('page.show') }}">Главная</a></li>
                        <li><a href="{{ route('page.show', ['alias' => 'nomera']) }}">Наши номера</a></li>
                        <li>{{ $service->name }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <main>
        <div class="container">
            <div class="row">
                <div class="col-9 flex-start">
                    @if ($service->gallery && count($service->gallery->images))
                    <div class="room__slider">
                        <div class="big__carousel owl-theme owl-carousel">
                            @foreach ($service->gallery->images as $image)
                                <img src="{{ $image->getPath() }}" alt="{{ $image->alt }}" title="{{ $image->title }}">
                            @endforeach
                        </div>
                        <div class="thumbs__carousel owl-theme owl-carousel">
                            @foreach ($service->gallery->images as $image)
                                <img src="{{ $image->getThumb() }}" alt="{{ $image->alt }}" title="{{ $image->title }}" data-index="{{ $loop->index }}">
                            @endforeach
                        </div>
                    </div>
                    @endif
                    @if (count($service->originTabs))
                    <div class="tabs">
                        <ul>
                            @foreach ($service->originTabs as $tab)
                                <li>{{ $tab->name }}</li>
                            @endforeach
                        </ul>
                        <div class="content">
                            @foreach ($service->originTabs as $tab)
                                <div>
                                    {!! $service->tabs[$tab->id] !!}
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
                <div class="col-3 flex-start">
                    @include('layouts.forms.sb_booking')
                    <div class="sb__title">Другие номера</div>
                    <div class="sb__room">
                        <div class="img">
                            <a href="#">
                                <img src="./img/sb__room-img.jpg" alt="alt">
                            </a>
                        </div>
                        <div class="text">
                            <a href="#" class="name">Апартаменты</a>
                            <div class="price">от 5200 руб/сутки</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="content room__text">
                        {!! $service->text !!}
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
