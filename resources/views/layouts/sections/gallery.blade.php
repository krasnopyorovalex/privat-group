<section class="gallery">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="title">
                    {{ $gallery->name }}
                </div>
            </div>
        </div>
    </div>

    <div class="gallery__box">
        @foreach ($gallery->images as $image)
            <figure>
                <img src="{{ $image->getThumb() }}" alt="{{ $image->alt }}" title="{{ $image->title }}">
                <a href="{{ $image->getPath() }}" data-lightbox="gallery">
                    <svg class="icon">
                        <use xlink:href="/img/symbols.svg#search"></use>
                    </svg>
                </a>
            </figure>
        @endforeach
    </div>
</section>
