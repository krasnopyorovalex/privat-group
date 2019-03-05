<div class="list__items" itemscope="" itemtype="http://schema.org/BlogPosting" itemprop="BlogPost">
    @foreach ($articles as $article)
        <div>
            <div itemscope="" itemprop="image" itemtype="http://schema.org/ImageObject" class="img">
                <figure>
                    <a href="{{ $article->url }}">
                        <img itemprop="url contentUrl" src="{{ asset($article->image->path) }}" alt="{{ $article->image->alt }}" title="{{ $article->image->title }}">
                        <meta itemprop="url" content="{{ asset($article->image->path) }}">
                        <meta itemprop="width" content="365">
                        <meta itemprop="height" content="330">
                    </a>
                </figure>
            </div>
            <div class="text">
                <div class="date">
                    <time itemprop="datePublished" datetime="{{ $article->published_at->format('c') }}">
                        {{ $article->published_at->formatLocalized('%d %b %Y') }} г.
                    </time>
                </div>
                <a href="{{ $article->url }}" class="name">{{ $article->name }}</a>
                <div itemprop="articleBody" class="text">
                    {!! $article->preview !!}
                </div>
                <a href="{{ $article->url }}" class="btn">Читать далее</a>
            </div>
        </div>
    @endforeach
</div>
<div class="pagination">
    {{ $articles->links() }}
</div>
