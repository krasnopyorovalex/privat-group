<section class="rooms">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="title">Наши номера</div>
            </div>
            <div class="col-12">
                <div class="small__text">
                    <p>Donec porta diam eu massa. Quisque diam lorem, interdum vitae,dapibus ac, scelerisque vitae, pede. Donec eget tellus non erat lacinia fermentum. Donec in velit vel ipsum auctor pulvinar.</p>
                </div>
            </div>
        </div>
        <div class="row rooms__slider">
            @foreach($services as $service)
                <div class="col-4">
                    <div class="rooms__slider-img">
                        @if ($service->image)
                        <a href="{{ $service->url }}"><img src="{{ $service->image->path }}" alt="{{ $service->image->alt }}" title="{{ $service->image->title }}"></a>
                        @endif
                    </div>
                    <div class="caption">
                        <div class="caption__name">
                            <a href="{{ $service->url }}">{{ $service->name }}</a>
                        </div>
                        <div class="caption__price">
                           {{ $service->price }}
                        </div>
                        <div class="caption__text">
                            {!! $service->short_text !!}
                        </div>
                        <div class="caption__btn">
                            <a href="{{ $service->url }}" class="btn">Перейти к номеру</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
