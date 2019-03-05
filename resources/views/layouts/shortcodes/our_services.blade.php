<div class="row services">
    @foreach($ourServices as $ourService)
        <div class="col-4">
            <div class="img">
                @if($ourService->image)
                <a href="{{ $ourService->url }}">
                    <img src="{{ $ourService->image->path }}" alt="{{ $ourService->image->alt }}" title="{{ $ourService->image->title }}">
                </a>
                @endif
            </div>
            <div class="name">
                <a href="{{ $ourService->url }}">{{ $ourService->name }}</a>
            </div>
            <div class="text">
                {!! $ourService->preview !!}
            </div>
            <a href="{{ $ourService->url }}" class="btn__more">Подробнее</a>
        </div>
    @endforeach
</div>
