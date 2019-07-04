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

    <section class="section section-inset-2 bg-default text-md-left">
        <div class="container">
            <div class="row row-30 align-items-center justify-content-center justify-content-xl-between">
                <div class="col-md-4 col-lg-4 col-xs-12">
                    <iframe width="100%" height="250" src="https://www.youtube.com/embed/zIFEGZRzkXc" frameborder=0 allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                <div class="col-md-4 col-lg-4 col-xs-12">
                    <iframe width="100%" height="250" src="https://www.youtube.com/embed/VsD61yrHfMI" frameborder=0 allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                <div class="col-md-4 col-lg-4 col-xs-12">
                    <iframe width="100%" height="250" src="https://www.youtube.com/embed/VsD61yrHfMI" frameborder=0 allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </section>

    <!-- About Us-->
    <section class="section section-inset-2 bg-default text-md-left">
        <div class="container">
            <div class="row row-30 align-items-center justify-content-center justify-content-xl-between">
                <div class="col-sm-6 col-md-5 col-lg-6 wow fadeInLeft"><img src="images/about-8-576x410.jpg" alt="" width="576" height="410"/>
                </div>
                <div class="col-md-7 col-lg-6 col-xl-5">
                    <h4 class="title-style-1 wow fadeInRight">A Few Words About Our Farm</h4>
                    <h2 class="wow fadeInRight" data-wow-delay=".1s">About us</h2>
                    <p class="offset-top-md-20 wow fadeInRight" data-wow-delay=".2s">Farm is made up of two certified organic properties, where our farmers are constantly growing organic vegetables, crops, and fruits of the highest quality in the US.</p>
                    <div class="group-xl group-middle d-md-flex justify-content-md-between wow fadeInRight" data-wow-delay=".3s">
                        <div>
                            <div class="group-xl group-middle"><a class="button button-sm button-icon-3 button-secondary button-zakaria" href="about-us.html"><span class="mdi mdi-arrow-right"></span></a>
                                <div class="team-navy">
                                    <div class="team-navy-name"><a href="index.html#">Смотреть все</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @includeWhen($advantages, 'layouts.sections.advantages')
    @includeWhen($partners, 'layouts.sections.partners')
    @includeWhen($ourServices, 'layouts.sections.our_services')
    @includeWhen($page->gallery, 'layouts.sections.gallery', ['gallery' => $page->gallery])

    <section class="section">
        <div class="yandex-map-container">
            <script charset=utf-8 async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Ace6eeb18be41210fad23ae6362d774483db8f1ed4b28eba8181464ac5c684de3&amp;width=100%25&amp;height=400&amp;lang=ru_RU&amp;scroll=false"></script>
        </div>
    </section>

@endsection
