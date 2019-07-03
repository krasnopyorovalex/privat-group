<div class="row row-30 row-lg-50">
    @foreach ($catalogs as $catalog)
        <div class="col-sm-4 col-md-3 col-lg-3 col-xs-12">
        <article class="product">
            <div class="product-body">
                @if($catalog->image)
                    <div class="product-figure">
                        <a href="{{ $catalog->url }}">
                            <img src="{{ asset($catalog->image->path) }}" alt="" width="220" height="160">
                        </a>
                    </div>
                @endif
                <h5 class="product-title">
                    <a href="{{ $catalog->url }}">{{ $catalog->name }}</a>
                </h5>
            </div>
            <div class="product-button-wrap">
                <div class="product-button">
                    <a class="button button-secondary button-zakaria fl-bigmug-line-search74" href="{{ $catalog->url }}"></a>
                </div>
            </div>
        </article>
        </div>
    @endforeach
</div>
