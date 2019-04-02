{!! '<'.'?xml version="1.0" encoding="UTF-8"?>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
    @if (count($pages))
        @foreach($pages as $page)
        <url>
            <loc>{{ $page->url }}</loc>
            <lastmod>{{ Illuminate\Support\Carbon::parse($page->updated_at)->format("Y-m-d\\TH:i:sP") }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>{{ $page->alias == 'index' ? 1 : 0.9 }}</priority>
        </url>
        @endforeach
    @endif
    @if (count($services))
        @foreach($services as $service)
            <url>
                <loc>{{ $service->url }}</loc>
                <lastmod>{{ Illuminate\Support\Carbon::now()->format("Y-m-d\\TH:i:sP") }}</lastmod>
                <changefreq>daily</changefreq>
                <priority>0.9</priority>
            </url>
        @endforeach
    @endif
    @if (count($articles))
        @foreach($articles as $article)
            <url>
                <loc>{{ $article->url }}</loc>
                <lastmod>{{ Illuminate\Support\Carbon::parse($article->published_at)->format("Y-m-d\\TH:i:sP") }}</lastmod>
                <changefreq>daily</changefreq>
                <priority>0.8</priority>
            </url>
        @endforeach
    @endif
    @if (count($news))
        @foreach($news as $new)
            <url>
                <loc>{{ $new->url }}</loc>
                <lastmod>{{ Illuminate\Support\Carbon::parse($new->published_at)->format("Y-m-d\\TH:i:sP") }}</lastmod>
                <changefreq>daily</changefreq>
                <priority>0.8</priority>
            </url>
        @endforeach
    @endif
    @if (count($ourServices))
        @foreach($ourServices as $ourService)
            <url>
                <loc>{{ $ourService->url }}</loc>
                <lastmod>{{ Illuminate\Support\Carbon::parse($ourService->published_at)->format("Y-m-d\\TH:i:sP") }}</lastmod>
                <changefreq>daily</changefreq>
                <priority>0.8</priority>
            </url>
        @endforeach
    @endif
</urlset>
