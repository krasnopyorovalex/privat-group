@extends('layouts.app')

@section('title', $page->title)
@section('description', $page->description)
@section('canonical', route('page.show', ['alias' => request('alias')]))
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

    <section class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>{{ $page->name }}</h1>
                    <ul>
                        <li><a href="{{ route('page.show') }}">Главная</a></li>
                        <li>{{ $page->name }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <main>
        <div class="container">
            <div class="row">
                <div class="col-9">
                    <div class="content page__content">
                        @if(count($guestbookAll))
                            <div class="guest__book-list">
                                @foreach($guestbookAll as $item)
                                    <div class="guest__book-list-item">
                                        <div class="author">№{{ $item->getIndex($loop->index, request('page')) }} {{ $item->name }}, {{ $item->published_at->formatLocalized('%d %b %Y') }} г.</div>
                                        <div class="text">
                                            {!! $item->text !!}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        {!! $page->text !!}
                    </div>
                    <div class="pagination">
                        {{ $guestbookAll->links() }}
                    </div>
                </div>
                <div class="col-3 flex-start">
                    @include('layouts.forms.guestbook')
                </div>
            </div>
        </div>
    </main>


    @includeWhen($page->gallery, 'layouts.sections.gallery', ['gallery' => $page->gallery])

@endsection
