<!-- Section Product and Clients-->
<section class="section section-sm section-first bg-default text-md-left">
    <div class="container">
        <div class="row row-30 justify-content-center align-items-md-center">
            <div class="col-xl-12">
                <div class="owl-carousel owl-style-6" data-items="2" data-sm-items="3" data-md-items="4" data-lg-items="5" data-margin="30" data-dots="true">
                    @foreach($partners as $partner)
                        @if($partner->image)
                            <img src="{{ $partner->image->path }}" alt="{{ $partner->image->alt }}" title="{{ $partner->image->title }}" width="120" height="114"/>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
