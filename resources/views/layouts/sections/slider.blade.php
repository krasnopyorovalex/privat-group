<!-- Swiper-->
<section class="section swiper-container swiper-slider swiper-slider-1" data-autoplay="5000">
    <div class="swiper-wrapper context-dark text-center">
        @foreach ($slider->images as $image)
            <div class="swiper-slide darken" data-slide-bg="{{ asset($image->getPath()) }}">
                <div class="swiper-slide-caption section-md">
                    <div class="container">
                        @if($image->name)
                            <div class="swiper-title-2" data-caption-animate="fadeInLeft"
                                 data-caption-delay="200">{{ $image->name }}</div>
                        @endif
                        @if($image->alt)
                            <div class="swiper-title-2" data-caption-animate="fadeScale"
                                 data-caption-delay="100">{{ $image->alt }}</div>
                        @endif
                        @if($image->title)
                            <h2 class="swiper-title-2" data-caption-animate="fadeInRight"
                                data-caption-delay="200">{{ $image->title }}</h2>
                        @endif
                        @if($image->link)
                            <div class="button-wrap" data-caption-animate="fadeInUp" data-caption-delay="300">
                                <a class="button button-lg button-shadow-3 button-secondary button-zakaria"
                                   data-toggle="modal" data-target="#callback" href="{{ $image->link }}">
                                    Подробнее
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{--    <!-- Swiper Pagination-->--}}
    {{--    <div class="swiper-pagination"></div>--}}
    {{--    <!-- Swiper Navigation-->--}}
    {{--    <div class="swiper-button-prev"></div>--}}
    {{--    <div class="swiper-button-next"></div>--}}
</section>
