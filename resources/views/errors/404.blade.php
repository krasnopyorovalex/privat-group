<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="wide wow-animation">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=yes"/>
    <title>404 - Страница не найдена</title>
    <meta name="description" content="404 - Страница не найдена">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#eee">
    <meta name="robots" content="noindex, nofollow" />
    <link href="{{ mix('css/app.min.css') }}" rel="stylesheet">
    <link href="{{ asset('favicon.ico') }}" rel="shortcut icon" type="image/x-icon" />
</head>
<body>
    <div class="preloader">
        <div class="preloader-body">
            <div class="cssload-bell">
                <div class="cssload-circle">
                    <div class="cssload-inner"></div>
                </div>
                <div class="cssload-circle">
                    <div class="cssload-inner"></div>
                </div>
                <div class="cssload-circle">
                    <div class="cssload-inner"></div>
                </div>
                <div class="cssload-circle">
                    <div class="cssload-inner"></div>
                </div>
                <div class="cssload-circle">
                    <div class="cssload-inner"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="page">
        <section class="section section-single context-dark bg-image bg_404" style="background-image: url('/images/bg-404.jpg');">
            <div class="section-single-inner">
                <header class="section-single-header page-header">
                    <div class="page-head-inner">
                        <a class="brand" href="{{ route('page.show') }}">
                            <img class="brand-logo-light img_404" src="{{ asset('images/logo.png') }}" alt="Все для бани" />
                        </a>
                    </div>
                </header>

                <div class="section-single-main">
                    <div class="container">
                        <div class="title-modern">404</div>
                        <h3 class="font-weight-light text-spacing-100">Страница не найдена</h3>
                        <a class="button button-lg button-secondary button-zakaria" href="{{ route('page.show') }}">Вернуться на главную</a>
                    </div>
                </div>
            </div>
        </section>
    </div>

<div class="snackbars" id="form-output-global"></div>
<script src="{{ asset('js/core.min.js') }}"></script>
<script src="{{ mix('js/app.min.js') }}"></script>
</body>
</html>
