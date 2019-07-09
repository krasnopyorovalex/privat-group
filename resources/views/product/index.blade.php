@extends('layouts.app')

@section('title', $product->title)
@section('description', $product->description)
@push('og')
    <meta property="og:title" content="{{ $product->title }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ request()->getUri() }}">
    <meta property="og:image" content="{{ asset($product->image ? $product->image->path : 'images/logo.png') }}">
    <meta property="og:description" content="{{ $product->description }}">
    <meta property="og:site_name" content="Всё для бани">
    <meta property="og:locale" content="ru_RU">
@endpush

@section('content')
    @includeWhen($product->slider, 'layouts.sections.slider', ['slider' => $product->slider])

    <section class="breadcrumbs-custom">
        <div class="parallax-container" data-parallax-img="{{ asset('images/bg-default.jpg') }}">
            <div class="breadcrumbs-custom-body parallax-content context-dark">
                <div class="container">
                    <h2 class="breadcrumbs-custom-title">{{ $product->name }}</h2>
                </div>
            </div>
        </div>
        <div class="breadcrumbs-custom-footer">
            <div class="container">
                <ul class="breadcrumbs-custom-path">
                    <li><a href="{{ route('page.show') }}">Главная</a></li>
                    <li><a href="{{ route('page.show', ['alias' => 'catalog']) }}">Каталог</a></li>
                    <li><a href="{{ route('catalog.show', ['alias' => $product->catalog->alias]) }}">{{ $product->catalog->name }}</a></li>
                    <li class="active">{{ $product->name }}</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Single Product-->
    <section class="section section-sm section-first bg-default">
        <div class="container">
            <div class="row row-30">
                <div class="col-lg-5">
                    @if($product->image)
                    <div class="single-product-image">
                        <img src="{{ $product->image->path }}" alt="{{ $product->image->alt }}" title="{{ $product->image->title }}">
                    </div>
                    @endif
                </div>
                <div class="col-lg-7">
                    <div class="single-product">
                        <h3 class="text-transform-none font-weight-medium">{{ $product->name }}</h3>
                        <div class="group-md group-middle">
                            <div class="single-product-price">Цена: {!! $product->getPrice() !!}</div>
                        </div>
                        {!! $product->text !!}
                        <hr class="hr-gray-100">
                        <div class="group-xs group-middle">
                            <div class="button button-lg button-secondary button-zakaria btn__call-order" data-toggle="modal" data-target="#order" data-product="{{ $product->name }}">Заказать</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @includeWhen($product->gallery, 'layouts.sections.gallery', ['gallery' => $product->gallery])

    @include('layouts.forms.order')

@endsection
