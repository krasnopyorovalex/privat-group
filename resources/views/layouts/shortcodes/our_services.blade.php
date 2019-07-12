@foreach ($ourServices as $ourService)
    @if(count($ourService->ourServiceItems))

        <div class="our_service-name heading-3" id="service_{{ $ourService->id }}">{{ $ourService->name }}</div>

        <div class="list__items our_services">
        <div class="row">
            @foreach($ourService->ourServiceItems as $ourServiceItem)
                <div class="col-sm-6 col-lg-4 col-md-4 col-xs-12">
                    <!-- Post Classic-->
                    <article class="post post-classic box-md">
                        @if(isset($ourServiceItem->images[0]))
                            <figure>
                                <a class="post-classic-figure" href="{{ $ourServiceItem->url }}">
                                    <img src="{{ asset($ourServiceItem->images[0]->getThumb()) }}" alt="" width="370" height="239">
                                </a>
                            </figure>
                        @endif
                        <div class="post-classic-content">
                            <h5 class="post-classic-title"><a href="{{ $ourServiceItem->url }}">{{ $ourServiceItem->name }}</a></h5>
                            <div class="btn__box text-center">
                                <a class="button button-sm button-secondary button-zakaria" href="{{ $ourServiceItem->url }}">Подробнее</a>
                            </div>
                        </div>
                    </article>
                </div>
            @endforeach
        </div>
        </div>
    @endif
@endforeach
