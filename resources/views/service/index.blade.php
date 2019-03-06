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
                    <h1>{{ $service->name }}</h1>
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
                    @if($anotherRooms)
                        <div class="sb__title">Другие номера</div>
                        @foreach($anotherRooms as $room)
                            <div class="sb__room">
                                @if($room->image)
                                <div class="img">
                                    <a href="{{ $room->url }}">
                                        <img src="{{ $room->image->path }}" alt="{{ $room->image->alt }}" title="{{ $room->image->title }}">
                                    </a>
                                </div>
                                @endif
                                <div class="text">
                                    <a href="{{ $room->url }}" class="name">{{ $room->name }}</a>
                                    <div class="price">{{ $room->price }}</div>
                                </div>
                            </div>
                        @endforeach
                    @endif
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
