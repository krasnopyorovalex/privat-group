@extends('layouts.app')

@section('title', $catalog->title)
@section('description', $catalog->description)
@push('og')
    <meta property="og:title" content="{{ $catalog->title }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ request()->getUri() }}">
    <meta property="og:image" content="{{ asset($catalog->image ? $catalog->image->path : 'img/logo.png') }}">
    <meta property="og:description" content="{{ $catalog->description }}">
    <meta property="og:site_name" content="Всё для бани">
    <meta property="og:locale" content="ru_RU">
@endpush

@section('content')
    @includeWhen($catalog->slider, 'layouts.sections.slider', ['slider' => $catalog->slider])

    <section class="breadcrumbs-custom">
        <div class="parallax-container">
            <div class="breadcrumbs-custom-body parallax-content context-dark">
                <div class="container">
                    <h2 class="breadcrumbs-custom-title">{{ $catalog->name }}</h2>
                </div>
            </div>
        </div>
        <div class="breadcrumbs-custom-footer">
            <div class="container">
                <ul class="breadcrumbs-custom-path">
                    <li><a href="{{ route('page.show') }}">Главная</a></li>
                    <li><a href="{{ route('page.show', ['alias' => 'catalog']) }}">Каталог</a></li>
                    <li class="active">{{ $catalog->name }}</li>
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
                            <h6 class="aside-title">Категории каталога</h6>
                            <div class="row row-10 row-lg-20 gutters-10">
                                @if($catalogs)
                                <ul class="list-shop-filter">
                                    @foreach($catalogs as $catalog)
                                    <li class="{{ $catalog->alias === request('alias') ? 'active' : '' }}"><a href="{{ $catalog->url }}">{{ $catalog->name }}</a></li>
                                    @endforeach
                                </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-xl-9">
                    <div class="row row-30 row-lg-50">
                        @if($products)
                            @foreach($products as $product)
                                <div class="col-sm-6 col-md-4 col-lg-6 col-xl-4">
                                    <!-- Product-->
                                    <article class="product">
                                        <div class="product-body">
                                            @if($product->image)
                                            <div class="product-figure">
                                                <a href="{{ $product->url }}">
                                                    <img src="{{ $product->image->path }}" alt="{{ $product->image->alt }}" title="{{ $product->image->title }}" width="220" height="160"/>
                                                </a>
                                            </div>
                                            @endif
                                            <h5 class="product-title"><a href="{{ $product->url }}">{{ $product->name }}</a></h5>
                                            <div class="product-price-wrap">
                                                <div class="product-price">{!! $product->getPrice() !!}</div>
                                            </div>
                                        </div>
                                        @if($product->label)
                                        <span class="product-badge product-badge-{{ $product->label }}">{{ $product->getLabelName($product->label) }}</span>
                                        @endif
                                        <div class="product-button-wrap">
                                            <div class="product-button">
                                                <a class="button button-secondary button-zakaria fl-bigmug-line-search74" href="{{ $product->url }}"></a>
                                            </div>
                                            <div class="product-button">
                                                <div class="button button-primary button-zakaria fl-bigmug-line-shopping202"></div>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="pagination-wrap">
                        <!-- Bootstrap Pagination-->
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                <li class="page-item page-item-control disabled"><a class="page-link" href="grid-shop.html#" aria-label="Previous"><span class="icon" aria-hidden="true"></span></a></li>
                                <li class="page-item active"><span class="page-link">1</span></li>
                                <li class="page-item"><a class="page-link" href="grid-shop.html#">2</a></li>
                                <li class="page-item"><a class="page-link" href="grid-shop.html#">3</a></li>
                                <li class="page-item page-item-control"><a class="page-link" href="grid-shop.html#" aria-label="Next"><span class="icon" aria-hidden="true"></span></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
