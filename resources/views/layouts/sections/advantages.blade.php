<!-- Services-->
<section class="section parallax-container" data-parallax-img="images/parallax-3.jpg">
    <div class="parallax-content section-xxl context-dark darken">
        <div class="container">
            <div class="row row-30 box-ordered">
                @foreach($advantages as $advantage)
                <div class="col-sm-6 col-lg-4 wow fadeInLeft" data-wow-delay=".3s">
                    <article class="box-icon-modern">
                        <div class="box-icon-modern-header">
                            <div class="box-icon-modern-count box-ordered-item"></div>
                            <div class="box-icon-modern-svg">
                                @if($advantage->image)
                                    <img src="{{ asset($advantage->image->path) }}" alt="{{ $advantage->image->alt }}" title="{{ $advantage->image->title }}">
                                @endif
                            </div>
                        </div>
                        <h4 class="box-icon-modern-title">{{ $advantage->name }}</h4>
                        @if($advantage->preview)
                        <p class="box-icon-modern-text">
                            {!! strip_tags($advantage->preview) !!}
                        </p>
                        @endif
                    </article>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
