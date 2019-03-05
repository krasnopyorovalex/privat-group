<div class="sb__list">
    @if (count($guestbookLast))
    <div class="guest__box">
        <div class="title">
            Новые отзывы
        </div>
        @foreach($guestbookLast as $item)
            <div class="guest__box-item">
                <p>{{ $item->getPreview() }}</p>
                <div class="author">
                    {{ $item->name }}, {{ $item->published_at->formatLocalized('%d %b %Y') }} г.
                </div>
            </div>
        @endforeach
        <a href="{{ route('page.show', ['alias' => 'guestbook']) }}" class="btn">Читать все</a>
    </div>
    @endif
</div>
