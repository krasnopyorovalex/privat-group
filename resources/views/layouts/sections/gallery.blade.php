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
                    <div>
                        <a href="{{ $image->getPath() }}" data-lightgallery="item" title="{{ $image->name }}">
                            <img src="" data-src="{{ $image->getPath() }}" alt="{{ $image->alt }}" title="{{ $image->title }}" />
                        </a>
                    </div>
                </article>
            </div>
            @endforeach
        </div>
    </div>
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-12 text-center">
                <a class="button button-sm button-secondary button-zakaria" href="{{ route('page.show', ['alias' => 'projects']) }}">Смотреть все проекты</a>
            </div>
        </div>
    </div>
</section>
