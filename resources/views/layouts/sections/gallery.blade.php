<!-- Grid Gallery-->
<section class="section section-xl bg-default">
    <div class="container">
        <h2 class="wow fadeScale">{{ $gallery->name }}</h2>
    </div>
    <div class="container">
        <div class="row row-30 isotope" data-lightgallery="group">
            @foreach ($gallery->images as $image)
            <div class="col-md-4 col-sm-4 col-lg-4 col-xs-12">
                <!-- Thumbnail Classic-->
                <article class="thumbnail-classic">
                    <div class="thumbnail-classic-figure">
                        <a href="{{ $image->getPath() }}" data-lightgallery="item" title="{{ $image->name }}">
                            <img src="{{ $image->getThumb() }}" alt="{{ $image->alt }}" title="{{ $image->title }}" />
                        </a>
                    </div>
                </article>
            </div>
            @endforeach
        </div>
    </div>
</section>
