<section>
    <div class="owl-carousel owl-theme main__slider">
        @foreach ($slider->images as $image)
        <div>
            <div class="main__slider-img">
                <img src="{{ asset($image->getPath()) }}" alt="{{ $image->alt  }}" title="{{ $image->title }}">
            </div>
            <div class="caption">
                <div class="caption__text">
                    {{ $image->name }}
                </div>
                <div class="caption__btn">
                    <a href="{{ $image->link }}" class="btn">Подробнее</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
