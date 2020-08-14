<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="wide wow-animation">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=yes"/>
    <title>@yield('title', 'Все для бани')</title>
    <meta name="description" content="@yield('description', '')">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#eee">
    @stack('og')
    <link href="{{ mix('css/app.min.css') }}" rel="stylesheet">
    <link href="{{ asset('favicon.ico') }}" rel="shortcut icon" type="image/x-icon" />
    <link rel="canonical" href="@yield('canonical', request()->url())"/>
</head>
<body>
    <div class="page">
        <!-- Page Header-->
        <header class="section page-header">
            <!-- RD Navbar-->
            <div class="rd-navbar-wrap">
                <nav class="rd-navbar rd-navbar-classic" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static" data-lg-device-layout="rd-navbar-fixed" data-xl-layout="rd-navbar-static" data-xl-device-layout="rd-navbar-static" data-xxl-layout="rd-navbar-static" data-xxl-device-layout="rd-navbar-static" data-lg-stick-up-offset="100px" data-xl-stick-up-offset="100px" data-xxl-stick-up-offset="100px" data-lg-stick-up="true" data-xl-stick-up="true" data-xxl-stick-up="true">
                    <div class="rd-navbar-main-outer">
                        <div class="rd-navbar-main">
                            <!-- RD Navbar Panel-->
                            <div class="rd-navbar-panel">
                                <!-- RD Navbar Toggle-->
                                <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
                                <!-- RD Navbar Brand-->
                                <div class="rd-navbar-brand">
                                    <a class="brand" href="{{ route('page.show') }}">
                                        <img class="brand-logo-dark" src="{{ asset('images/logo.svg') }}" alt="Все для бани" title="Строительство бань, саун и хамамов"/>
                                    </a>
                                </div>
                                <a class="visible-xs mobile_phone" href="tel:+79789455747">
                                    <span class="icon mdi mdi-phone"></span>
                                    +7 (978) 94-557-47
                                </a>
                            </div>
                            <div class="rd-navbar-nav-wrap">
                                @includeWhen($menu->get('menu_header'), 'layouts.menus.header', ['menu' => $menu])
                            </div>
                            <div class="rd-navbar-main-element connection-elements">
{{--                                <div>--}}
{{--                                    <a href="https://www.instagram.com/fabrika_bani/" target="_blank">--}}
{{--                                        <span class="fa-instagram"></span>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                                <div>--}}
{{--                                    <a href="https://www.youtube.com/channel/UCigKb7WaQgDwppkEODoFMuw" target="_blank">--}}
{{--                                        <span class="fa-youtube-play"></span>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
                                <div>
                                    <a href="tel:+79789455747" class="h-phone">
                                        <span class="fa-phone"></span>
                                        +7 (978) 94-557-47
                                    </a>
                                </div>
                            </div>
                        </div>
                        @if($categories->count())
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="categories-menu">
                                        <ul>
                                            @foreach($categories as $category)
                                                <li>
                                                    <a href="#">{{ $category->name }}</a>
                                                    <div class="categories-menu-count">122</div>
                                                    @if($category->catalogs->count())
                                                    <ul class="categories-sub-menu">
                                                        @foreach($category->catalogs as $subCategory)
                                                        <li>
                                                            <a href="#">{{ $subCategory->name }}</a>
                                                            <div class="categories-menu-count">{{ $subCategory->products_count }}</div>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </nav>
            </div>
        </header>

        @yield('content')

        <!-- Page Footer-->
        <footer class="section footer-classic">
            <div class="footer-classic-body section-lg">
                <div class="container">
                    <div class="row row-40 row-md-50 justify-content-xl-between">
                        <div class="col-sm-6 col-lg-4 col-xl-3 wow fadeInRight">
                            <div class="footer-classic-brand">
                                <a class="brand" href="{{ route('page.show') }}">
                                    <img class="brand-logo-dark" src="{{ asset('images/logo.svg') }}" alt=""/>
                                </a>
                            </div>
                            <ul class="list-schedule">
                                <li><span>Понедельник-пятница:</span><span>9:00-18:00</span></li>
                                <li><span>Суббота-воскресенье:</span><span>Выходные</span></li>
                            </ul>
                            <div class="footer-classic-social">
                                <div class="group-lg group-middle">
                                    <p>Мы в соцсеятх</p>
                                    <div>
                                        <ul class="list-inline list-social list-inline-sm">
                                            <li><a class="icon mdi mdi-youtube-play" href="https://www.youtube.com/channel/UCigKb7WaQgDwppkEODoFMuw" target="_blank"></a></li>
                                            <li><a class="icon mdi mdi-instagram" href="https://www.instagram.com/fabrika_bani/" target="_blank"></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4 col-xl-3 wow fadeInRight" data-wow-delay=".1s">
                            <h4 class="footer-classic-title">Контакты</h4>
                            <ul class="contacts-creative">
                                <li>
                                    <div class="unit unit-spacing-sm flex-column flex-md-row">
                                        <div class="unit-left"><span class="icon mdi mdi-map-marker"></span></div>
                                        <div class="unit-body">
                                            298600, Республика Крым, Ялта г., ул. К. Маркса, д. 15а, оф. 3-3
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="unit unit-spacing-sm flex-column flex-md-row">
                                        <div class="unit-left"><span class="icon mdi mdi-phone"></span></div>
                                        <div class="unit-body"><a href="tel:+79789455747">+7 (978) 94-557-47</a></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-4 wow fadeInRight" data-wow-delay=".2s">
{{--                            <h4 class="footer-classic-title">Информация</h4>--}}
{{--                            <p>Получи бесплатную консультацию и статью "10 критических ошибок при строительстве бани или сауны"</p>--}}
{{--                            <form action="{{ route('send.subscribe') }}" class="rd-form rd-mailform rd-form-inline rd-form-inline-2" method="post" id="form__subscribe">--}}
{{--                                @csrf--}}
{{--                                <div class="form-wrap">--}}
{{--                                    <input class="form-input" id="subscribe-form-2-email" type="text" name="phone" autocomplete="off" placeholder="Телефон" required="" />--}}
{{--                                </div>--}}
{{--                                <div class="form-wrap">--}}
{{--                                    <input class="form-input" id="subscribe-form-2-email" type="email" name="email" autocomplete="off" placeholder="E-mail" required="" />--}}
{{--                                </div>--}}
{{--                                <div class="form-button submit">--}}
{{--                                    <button class="button button-icon-2 button-zakaria button-secondary" type="submit"><span class="fl-bigmug-line-paper122"></span></button>--}}
{{--                                </div>--}}
{{--                            </form>--}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-classic-panel">
                <div class="container">
                    <div class="row row-10 align-items-center justify-content-sm-between">
                        <div class="col-md-auto">
                            <p class="rights"><span>&copy;&nbsp;</span><span class="copyright-year"></span><span>&nbsp;</span><span>СТРОИТЕЛЬСТВО БАНЬ, САУН И ХАМАМОВ В СЕВАСТОПОЛЕ И КРЫМУ</span><span>.&nbsp;Все права защищены.</span></p>
                        </div>
                        <div class="col-md-auto"></div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <div class="snackbars" id="form-output-global"></div><div class="notify"></div>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/core.min.js') }}"></script>
    <script src="{{ mix('js/app.min.js') }}"></script>
</body>
</html>
