<!-- Grid Gallery-->
<section class="section section-xl bg-default product-gallery">
    <div class="container">
        <div class="row row-30 isotope" data-lightgallery="group">
            @foreach ($product->images as $image)
            <div class="col-md-3 col-sm-3 col-lg-3 col-6">
                <!-- Thumbnail Classic-->
                <article class="thumbnail-classic">
                    <div>
                        <a href="{{ $image->getPath() }}" data-lightgallery="item" title="{{ $image->name }}">
                            <img src="{{ $image->getThumb() }}" alt="{{ $image->getAlt($loop->index) }}" title="{{ $image->title }}" />
                        </a>
                    </div>
                </article>
            </div>
            @endforeach
        </div>
    </div>
</section>
