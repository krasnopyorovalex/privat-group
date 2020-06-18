<!-- Our Blog-->
<section class="section section-sm section-last bg-default">
    <div class="container">
        <h2 class="wow fadeScale">Наши услуги</h2>
    </div>
    <div class="container">
        <div class="row row-30 align-items-center justify-content-center justify-content-xl-between">
        @foreach($ourServices as $ourService)
            <div class="col-md-4 col-sm-6 col-xs-12">
                <!-- Post Creative-->
                <article class="post post-creative">
                    @if($ourService->image)
                        <a class="post-creative-figure" href="{{ route('page.show', ['alias' => 'services']) }}#service_{{ $ourService->id }}">
                            <img src="" data-src="{{ $ourService->image->path }}" alt="{{ $ourService->image->alt }}" title="{{ $ourService->image->title }}" width="420" height="368"/>
                        </a>
                    @endif
                    <div class="post-creative-content">
                        <h5 class="post-creative-title">
                            <a href="{{ route('page.show', ['alias' => 'services']) }}#service_{{ $ourService->id }}">
                                {{ $ourService->name }}
                            </a>
                        </h5>
                        <div class="btn__box">
{{--                            <div class="button button-sm button-secondary button-zakaria btn__call-order-service" data-toggle="modal" data-target="#order_service" data-service="{{ $ourService->name }}">Заказать</div>--}}
                            <a class="button button-sm button-secondary button-zakaria" href="{{ route('page.show', ['alias' => 'services']) }}#service_{{ $ourService->id }}">Подробнее</a>
                        </div>
                    </div>
                </article>
            </div>
        @endforeach
        </div>
    </div>
</section>
{{--@include('layouts.forms.order_service')--}}
