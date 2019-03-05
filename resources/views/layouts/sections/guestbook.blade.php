<section class="guest">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="title">Гостевая книга</div>
            </div>
        </div>
        <div class="row">
            @foreach($guestbookLast as $item)
            <div class="col-4">
                <div class="guest__text">
                    {!! $item->text !!}
                </div>
                <div class="guest__footer">
                    <div class="guest__footer-name">{{ $item->name }}</div>
                    <div class="guest__footer-date">{{ $item->published_at->formatLocalized('%d %b %Y') }} г.</div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-12">
                <div class="btn__see-all">
                    <a href="{{ route('page.show', ['alias' => 'guestbook']) }}" class="btn">Читать все отзывы</a>
                </div>
            </div>
        </div>
    </div>
</section>
