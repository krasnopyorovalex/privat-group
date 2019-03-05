<div class="rooms__list">
    @foreach($services as $service)
        <div class="rooms__list-item">
            <div class="rooms__list-item-img">
                @if ($service->image)
                    <a href="{{ $service->url }}"><img src="{{ $service->image->path }}" alt="{{ $service->image->alt }}" title="{{ $service->image->title }}"></a>
                @endif
            </div>
            <div class="rooms__list-item-text">
                <a href="{{ $service->url }}" class="name">{{ $service->name }}</a>
                <div class="price">{{ $service->price }}</div>
                <div class="preview">
                    {!! $service->short_text !!}
                </div>
                <div class="buttons">
                    <a href="{{ $service->url }}" class="btn">Подробнее</a>
                </div>
            </div>
        </div>
    @endforeach
</div>
