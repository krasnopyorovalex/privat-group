<section class="services">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="title">Наши услуги</div>
            </div>
        </div>
        <div class="row">
            @foreach($ourServicesInMain as $ourService)
                <div class="col-3">
                    @if ($ourService->image)
                    <div class="img">
                        <a href="{{ $ourService->url }}">
                            <img src="{{ $ourService->image->path }}" alt="{{ $ourService->image->alt }}" title="{{ $ourService->image->title }}">
                        </a>
                    </div>
                    @endif
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
        <div class="row">
            <div class="col-12">
                <div class="btn__see-all">
                    <a href="{{ route('page.show',['alias' => 'our-services']) }}" class="btn">Смотреть все услуги</a>
                </div>
            </div>
        </div>
    </div>
</section>
