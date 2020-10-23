<div class="row" itemscope="" itemtype="http://schema.org/BlogPosting" itemprop="BlogPost">
    @foreach ($news as $new)
        <div class="col-sm-6 col-lg-4">
            <!-- Post Classic-->
            <article class="post post-classic box-md">
                @if($new->image)
                <figure itemscope="" itemprop="image" itemtype="http://schema.org/ImageObject">
                    <a class="post-classic-figure" href="{{ $new->url }}">
                        <img itemprop="url contentUrl" src="{{ asset($new->image->path) }}" alt="" width="370" height="239">
                        <meta itemprop="url" content="{{ asset($new->image->path) }}">
                        <meta itemprop="width" content="370">
                        <meta itemprop="height" content="239">
                    </a>
                </figure>
                @endif
                <div class="post-classic-content">
                    <div class="post-classic-time">
                        <time itemprop="datePublished" datetime="{{ $new->published_at->format('c') }}">
                            {{ $new->published_at->formatLocalized('%d %B %Y') }}
                        </time>
                    </div>
                    <div class="post-classic-title"><a href="{{ $new->url }}">{{ $new->name }}</a></div>
                    <p itemprop="articleBody" class="post-classic-text">{!! strip_tags($new->preview) !!}</p>
                </div>
            </article>
        </div>
    @endforeach
</div>

<div class="pagination-wrap">
    <!-- Bootstrap Pagination-->
    <nav aria-label="Page navigation">
        {{ $news->links() }}
    </nav>
</div>
