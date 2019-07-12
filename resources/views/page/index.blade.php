@extends('layouts.app')

@section('title', $page->title)
@section('description', $page->description)
@push('og')
<meta property="og:title" content="{{ $page->title }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ request()->getUri() }}">
    <meta property="og:image" content="{{ asset($page->image ? $page->image->path : 'images/logo.png') }}">
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
                    <div class="youtube-box" data-embed="zIFEGZRzkXc">
                        <div class="btn-play"></div>
                    </div>
                </div>
                <div class="col-md-4 col-lg-4 col-xs-12">
                    <div class="youtube-box" data-embed="VsD61yrHfMI">
                        <div class="btn-play"></div>
                    </div>
                </div>
                <div class="col-md-4 col-lg-4 col-xs-12">
                    <div class="youtube-box" data-embed="L_-_w791HsM">
                        <div class="btn-play"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Us-->
    <section class="section section-inset-2 bg-default text-md-left">
        <div class="container">
            <div class="row row-30 align-items-start justify-content-center">
                <div class="col-sm-4 col-md-4 col-lg-4 wow fadeInLeft"><img src="{{ asset('images/director.jpg') }}" alt="Прокопенко Сергей" />
                </div>
                <div class="col-md-8 col-lg-8">
                    <h4 class="title-style-1 wow fadeInRight decorate">Приветствую Вас на нашем сайте.</h4>
                    <p class="offset-top-md-20 wow fadeInRight decorate" data-wow-delay=".2s">Немного расскажу о нашей компании. Компания на рынке Крыма с 2014 года. За время работы компании построено множество объектов от маленьких парных в квартире до полноценных СПА зон с несколькими видами бань, мокрыми зонами, бассейнами и купелями. <br />Мы используем в строительстве передовые технологии и оборудование только надежных производителей. Заказывая строительство или оборудование в нашей компании Вы приобретаете не только товар или услугу, Вы приобретаете бесценный опыт, добытый нами. Если Вы планируете построить баню, сауну, хамам или СПА комплекс Вы получите в нашей компании Весь спектр услуг от разработки концепции и дизайн проекта, до реализации проекта под ключ.</p>
                    <p class="offset-top-md-20 wow fadeInRight decorate" data-wow-delay=".2s"><b>С Уважением Прокопенко Сергей</b></p>
                    <div class="group-middle d-md-flex justify-content-md-start wow fadeInRight" data-wow-delay=".3s">
                        <div class="form_question">
                            <div>
                                <div class="form_info"><p>Задать вопрос директору</p></div>
                                <form action="{{ route('send.question') }}" class="rd-form rd-mailform rd-form-inline rd-form-inline-2" method="post" id="form__subscribe">
                                    @csrf
                                    <div class="form-wrap">
                                        <input class="form-input" id="subscribe-form-2-email" type="text" name="name" autocomplete="off" placeholder="Имя" required="" />
                                    </div>
                                    <div class="form-wrap">
                                        <input class="form-input" id="subscribe-form-2-email" type="text" name="phone" autocomplete="off" placeholder="Телефон" required="" />
                                    </div>
                                    <div class="form-button submit">
                                        <button class="button button-sm button-secondary button-zakaria" type="submit">
                                            Задать вопрос Директору
                                        </button>
                                    </div>
                                </form>
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
