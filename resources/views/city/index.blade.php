@extends('layouts.app')

@section('title', $city->title)
@section('description', $city->description)
@push('og')
    <meta property="og:title" content="{{ $city->title }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ request()->getUri() }}">
    <meta property="og:image" content="{{ asset($city->image ? $city->image->path : 'images/logo.png') }}">
    <meta property="og:description" content="{{ $city->description }}">
    <meta property="og:site_name" content="Private Estate - недвижимость для жизни">
    <meta property="og:locale" content="ru_RU">
@endpush

@section('content')
    <section class="breadcrumbs-custom">
        <div class="breadcrumbs-custom-body parallax-content context-dark bg-inside-pages">
            <div class="container">
                <h1 class="breadcrumbs-custom-title">{{ $city->name }}</h1>
            </div>
        </div>
        <div class="breadcrumbs-custom-footer">
            <div class="container">
                <ul class="breadcrumbs-custom-path">
                    <li><a href="{{ route('page.show') }}">Главная</a></li>
                    <li class="active">{{ $city->name }}</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Section Shop-->
    <section class="section section-xxl bg-default text-md-left">
        <div class="container">
            <div class="row row-50">
                <div class="col-lg-4 col-xl-3">
                    <div class="aside row row-30 row-md-50 justify-content-md-between">
                        <div class="aside-item col-sm-6 col-lg-12">
                            <div class="aside-title">
                                <button class="rd-navbar-toggle"><span></span></button>
                                Категории каталога
                            </div>
                            <div class="aside-menu">
                                @if($catalogs)
                                    <ul class="list-shop-filter">
                                        @foreach($catalogs as $cat)
                                            <li class="{{ $cat->alias === request('alias') ? 'active' : '' }}">
                                                <a href="{{ $cat->url }}">{{ $cat->name }}</a>
                                                <div class="line hidden"></div>
                                                <div class="count hidden">{{ $cat->products_count ?: $cat->catalogs->sum('products_count') }}</div>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="aside row row-30 row-md-50 justify-content-md-between">
                        <div class="aside-item col-sm-6 col-lg-12">
                            <div class="aside-title">
                                <button class="rd-navbar-toggle"><span></span></button>
                                Выберите город
                            </div>
                            <div class="aside-menu">
                                @if($cities)
                                    <ul class="list-shop-filter">
                                        @foreach($cities as $city)
                                            <li class="{{ $city->alias === request('alias') ? 'active' : '' }}">
                                                <a href="{{ $city->url }}">{{ $city->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-xl-9">
                    <div class="row row-30 row-lg-50">
                        @if($grouped)
                            @foreach($grouped as $groupAlias => $products)
                                <div class="col-12 mb-3">
                                    <div class="group-name">
                                        <a href="{{ route('catalog.show', ['alias' => $groupAlias]) }}">
                                            {{ $catalogList->get($groupAlias) }}
                                        </a>
                                    </div>
                                </div>
                                @if($products)
                                    @foreach($products as $product)
                                        <div class="col-12">
                                            <article class="product-modern text-center text-sm-left">
                                                <div class="unit unit-spacing-0 flex-column flex-sm-row">
                                                    <div class="unit-left">
                                                        <!-- Owl Carousel-->
                                                        <div class="owl-carousel owl-style-5" data-nav="true" data-items="1" data-margin="30" data-dots="false" data-autoplay="false">
                                                            @if($product->image)
                                                                <article class="product-creative">
                                                                    <div class="product-figure">
                                                                        <img src="{{ $product->image->getThumb() }}" class="left-img main-img" alt="{{ $product->name }}" title="{{ $product->image->title }}" />
                                                                    </div>
                                                                </article>
                                                            @endif
                                                            @if($product->images->count())
                                                                @foreach($product->images->take(2) as $image)
                                                                    <article class="product-creative">
                                                                        <div class="product-figure">
                                                                            <img src="" class="left-img" data-src="{{ $image->getThumb() }}" alt="{{ $image->getAlt($loop->index) }}" title="{{ $image->title }}" />
                                                                        </div>
                                                                    </article>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="unit-body">
                                                        <div class="product-modern-body">
                                                            <div class="h4 product-modern-title">
                                                                <a href="{{ $product->url }}">{{ $product->name }}</a>
                                                            </div>
                                                            @if($product->address)
                                                                <div class="product-address-wrap">
                                                                    <div class="product-address">
                                                                        <span class="icon mdi mdi-map-marker"></span>
                                                                        {{ $product->address }}
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            <div class="product-price-wrap">
                                                                <div class="product-price">
                                                                    @if($product->on_request)
                                                                        Цена под запрос
                                                                    @else
                                                                        {!! $product->getPrice() !!}
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <p class="product-modern-text">{!! $product->preview !!}</p>
                                                            <a class="button button-primary" href="{{ $product->url }}">Подробнее</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if($product->label)
                                                    <span class="product-badge product-badge-{{ $product->label }}">{{ $product->getLabelName($product->label) }}</span>
                                                @endif
                                            </article>
                                        </div>
                                    @endforeach
                                @endif
                            @endforeach
                        @endif
                    </div>

                    @if($productsForLinks)
                    <div class="pagination-wrap">
                        <nav>
                            {{ $productsForLinks->links() }}
                        </nav>
                    </div>
                    @endif
                </div>
                @if($city->text)
                    <div class="col-lg-12 col-xl-12">
                        <div class="row row-30 row-lg-50">
                            <div class="col-12">
                                <div class="seo-text">
                                    {!! $city->text !!}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
