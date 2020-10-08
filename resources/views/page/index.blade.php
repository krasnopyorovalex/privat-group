@extends('layouts.app')

@section('title', $page->title)
@section('description', $page->description)
@push('og')
<meta property="og:title" content="{{ $page->title }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ request()->getUri() }}">
    <meta property="og:image" content="{{ asset($page->image ? $page->image->path : 'images/logo.png') }}">
    <meta property="og:description" content="{{ $page->description }}">
    <meta property="og:site_name" content="Private Estate - недвижимость для жизни">
    <meta property="og:locale" content="ru_RU">
@endpush

@section('content')

    @includeWhen($page->slider, 'layouts.sections.slider', ['slider' => $page->slider])

    <section class="section section-inset-2 bg-default text-md-left main-text">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    {!! $page->text !!}
                </div>
            </div>
        </div>
    </section>

    @includeWhen($advantages, 'layouts.sections.advantages')

    <!-- About Us-->
    <section class="section section-inset-2 bg-default text-md-left">
        <div class="container">
            <div class="row row-30 align-items-start justify-content-center">
                <div class="col-sm-4 col-md-4 col-lg-4 wow fadeInLeft">
                    <img src="" data-src="{{ asset('images/director.jpg') }}" alt="" class="img-big" />
                </div>
                <div class="col-md-8 col-lg-8">
                    <h4 class="wow fadeInRight decorate title">Дорогие друзья!</h4>
                    <p class="offset-top-md-20 wow fadeInRight decorate" data-wow-delay=".2s">
                        Приветствуем Вас на сайте Агентства Private Estate!<br />
                        Полуостров Крым - это не только место, уникальное по климатическим условиям и красоте морских и горных пейзажей. В наши дни это перспективный регион, развитие инфраструктуры и строительства в котором происходит с нарастающими темпами.<br/>
                        Поэтому приобретение недвижимости в Крыму, а особенно на южном его побережье - дальновидное и своевременное решение. В то же время поиск и приобретение своего жилья в Ялте, Гурзуфе, Форосе и Мисхоре имеют свои нюансы, которые требуют профессионального подхода.<br/>
                        Изменение законодательной базы, факторы изменения спроса и стоимости земельных участков, домовладений и квартир, потенциальные риски и способы их устранения - это те ценные сведения, которые систематически собирают и используют специалисты Private Estate.<br/>
                        Всеми знаниями рынка недвижимости ЮБК, актуальными на сегодняшний день, мы рады будем поделиться с Вами, чтобы Вы как можно скорее переехали в новое жильё или начали строительство на собственном участке.<br/>
                        Помимо индивидуального подбора недвижимости и экспертной оценки Вы получаете гарантию юридической чистоты сделки, сопровождение на всех её этапах и максимально сжатые сроки оформления всех необходимых документов.<br/>
                        Только Агентство Private Estate предоставляет исключительную возможность дистанционно приобрести крымскую недвижимость с максимальной юридической защитой Ваших законных прав и интересов, поскольку мы стремимся к построению долгосрочных доверительных отношений и минимизации расходов наших Клиентов.<br/>
                        <br />
                        Обращение к нашим экспертам рынка недвижимости с многолетним опытом работы сохранит не только Ваше время и душевное спокойствие при общении с посредниками и госорганами, но – во многих случаях – и значительные денежные средства.<br />
                        Private Estate осуществляет полный спектр услуг: от первичной консультации по рыночной ситуации, составления списка недостающих документов или подбора объектов до момента получения документов на право собственности.<br />
                        Только Агентство Private Estate предоставляет исключительную возможность дистанционно приобрести крымскую недвижимость с максимальной юридической защитой Ваших законных прав и интересов.<br />
                    </p>
                    <p class="offset-top-md-20 wow fadeInRight decorate" data-wow-delay=".2s"><b>С уважением, коллектив "Private Estate"</b></p>
                    <div class="group-middle d-md-flex justify-content-md-start wow fadeInRight" data-wow-delay=".3s">
                        <div class="form_question">
                            <div>
                                <div class="form_info"><p>Задать вопрос</p></div>
                                <form action="{{ route('send.question') }}" class="rd-form rd-mailform rd-form-inline rd-form-inline-2" method="post" id="form__subscribe" onsubmit="yaCounter67358938.reachGoal('VOPROS-NA-GLAVNOJ'); return true">
                                    @csrf
                                    <div class="form-wrap">
                                        <input class="form-input" id="subscribe-form-2-email" type="text" name="name" autocomplete="off" placeholder="Имя" required="" />
                                    </div>
                                    <div class="form-wrap">
                                        <input class="form-input" id="subscribe-form-2-email" type="text" name="phone" autocomplete="off" placeholder="Телефон" required="" />
                                    </div>
                                    <div class="form-button submit">
                                        <button class="button button-sm button-secondary" type="submit">
                                            Задать вопрос
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

    <section class="section-banner">
        <img src="{{ asset('images/banner-01.png') }}" alt="">
    </section>

    <section class="section">
        <div class="yandex-map-container" id="map-yandex"></div>
    </section>
@endsection
