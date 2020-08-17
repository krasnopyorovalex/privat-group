<!-- Grid Gallery-->
<section class="section section-xl bg-default product-gallery">
    <div class="container">
        <h3 class="wow fadeScale">Фотографии товара</h3>
    </div>
    <div class="container">
        <div class="row row-30 isotope" data-lightgallery="group">
            @foreach ($product->images as $image)
            <div class="col-md-3 col-sm-3 col-lg-3 col-xs-12">
                <!-- Thumbnail Classic-->
                <article class="thumbnail-classic">
                    <div>
                        <a href="{{ $image->getPath() }}" data-lightgallery="item" title="{{ $image->name }}">
                            <img src="" data-src="{{ $image->getThumb() }}" alt="{{ $image->alt }}" title="{{ $image->title }}" />
                        </a>
                    </div>
                </article>
            </div>
            @endforeach
        </div>
    </div>
</section>
