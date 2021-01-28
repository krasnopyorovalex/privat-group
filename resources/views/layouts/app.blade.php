<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="wide wow-animation">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=yes"/>
    <title>@yield('title', '') | Private Estate</title>
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
        <div class="header-contacts">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="header-contacts-items">
                            <address>
                                <span class="icon mdi mdi-map-marker"></span>
                                Ялта, ул. К. Маркса 15а, оф. 3-3
                            </address>
                            <div class="email">
                                <span class="icon mdi mdi-email"></span>
                                <a href="mailto:pr.estate82@gmail.com">pr.estate82@gmail.com</a>
                            </div>
                            <div class="socials">
                                <div>
                                    <a href="https://vk.com/privateestatecrimea " target="_blank" rel="noopener noreferrer">
                                        <span class="fa-vk"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                                        <img class="brand-logo-dark" src="{{ asset('images/logo.svg') }}" alt="Агентство недвижимости - Private Estate" title="Агентство недвижимости - Private Estate" />
                                    </a>
                                </div>
                                <a class="mobile_phone" href="tel:+79789455747">
                                    <span class="icon mdi mdi-phone"></span>
                                    +7 (978) 94-557-47
                                </a>
                                <span class="h-icons-list mobile_phone">
                                    <a href="https://wa.me/79789455747" rel="noopener noreferrer"><img src="{{ asset('images/viber.svg') }}" alt=""></a>
                                    <a href="viber://add?number=79789455747" rel="noopener noreferrer"><img src="{{ asset('images/whatsapp.svg') }}" alt=""></a>
                                </span>
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
                                    <span class="h-icons-list">
                                        <a href="https://wa.me/79789455747" rel="noopener noreferrer"><img src="{{ asset('images/viber.svg') }}" alt=""></a>
                                        <a href="viber://add?number=79789455747" rel="noopener noreferrer"><img src="{{ asset('images/whatsapp.svg') }}" alt=""></a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        @if($categories->count())
                        <div class="container rd-navbar-nav-wrap categories-menu-wrap">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="categories-menu">
                                        <ul>
                                            @foreach($categories as $category)
                                                <li class="{{ $category->alias === request('alias') ? 'active' : '' }}">
                                                    <a href="{{ route('catalog.show', ['alias' => $category->alias]) }}">{{ $category->name }}</a>
                                                    <div class="categories-menu-count hidden">{{ $category->products_count ?: $category->catalogs->sum('products_count') }}</div>
                                                    @if($category->catalogs->count())
                                                    <ul class="categories-sub-menu">
                                                        @foreach($category->catalogs as $subCategory)
                                                        <li>
                                                            <a href="{{ route('catalog.show', ['alias' => $subCategory->alias]) }}">{{ $subCategory->name }}</a>
                                                            <div class="categories-menu-count hidden">{{ $subCategory->products_count }}</div>
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
                                    <p>Мы в соцсетях</p>
                                    <div>
                                        <ul class="list-inline list-social list-inline-sm">
                                            <li><a class="icon mdi mdi-vk" href="https://vk.com/privateestatecrimea" target="_blank" rel="noopener noreferrer"></a></li>
{{--                                            <li><a class="icon mdi mdi-instagram" href="https://www.instagram.com/fabrika_bani/" target="_blank"></a></li>--}}
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="footer-librayalta-link">
                                <div>
                                    <a href="https://librayalta.ru/?14071" target="_blank" rel="nofollow" title="Private Estate, агентство недвижимости, Ялта">
                                        <img src="https://s.libraonline.ru/f/img/libraua_button.png" alt="Каталог предприятий и организаций" width="86px" height="29px">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4 col-xl-3 wow fadeInRight" data-wow-delay=".1s">
                            <div class="footer-classic-title">Контакты</div>
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
                                        <div class="unit-body">
                                            <a href="tel:+79789455747">+7 (978) 94-557-47</a>
                                            <span class="h-icons-list">
                                                <a href="https://wa.me/79789455747" rel="noopener noreferrer"><img src="{{ asset('images/viber.svg') }}" alt=""></a>
                                                <a href="viber://add?number=79789455747" rel="noopener noreferrer"><img src="{{ asset('images/whatsapp.svg') }}" alt=""></a>
                                            </span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-4 wow fadeInRight" data-wow-delay=".2s">
                            <div class="footer-menu">
                                @includeWhen($menu->get('menu_footer'), 'layouts.menus.footer', ['menu' => $menu])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-classic-panel">
                <div class="container">
                    <div class="row row-10 align-items-center justify-content-sm-between">
                        <div class="col-md-auto">
                            <p class="rights"><span>&copy;&nbsp;</span><span class="copyright-year"></span><span>&nbsp;</span><span>ООО "Private Estate"</span><span>.&nbsp;Все права защищены.</span></p>
                        </div>
                        <div class="col-md-auto">
                            <div class="develop">
                                <div class="develop__link">
                                    <a href="https://krasber.ru" target="_blank">
                                        Создание, продвижение и <br>техподдержка сайтов
                                    </a>
                                </div>
                                <div class="develop__logo">
                                    <a href="https://krasber.ru" target="_blank">
                                        <img src="{{ asset('images/logo_green.svg') }}" alt="Веб-студия Красбер">
                                    </a>
                                </div>
                            </div>
                        </div>
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
    @if(app()->environment('production'))
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript" >
        (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
            m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(67358938, "init", {
            clickmap:true,
            trackLinks:true,
            accurateTrackBounce:true,
            webvisor:true
        });
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/67358938" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->
    @endif
</body>
</html>
