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
    @if (count($projects))
        @foreach($projects as $project)
            <url>
                <loc>{{ $project->url }}</loc>
                <lastmod>{{ Illuminate\Support\Carbon::parse(date('Y-m-d'))->format("Y-m-d\\TH:i:sP") }}</lastmod>
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
    @if (count($cities))
        @foreach($cities as $city)
            <url>
                <loc>{{ $city->url }}</loc>
                <lastmod>{{ Illuminate\Support\Carbon::parse($city->updated_at)->format("Y-m-d\\TH:i:sP") }}</lastmod>
                <changefreq>daily</changefreq>
                <priority>0.8</priority>
            </url>
        @endforeach
    @endif
    @if (count($ourServices))
        @foreach($ourServices as $ourService)
            @if(count($ourService->ourServiceItems))
                @foreach($ourService->ourServiceItems as $ourServiceItem)
                <url>
                    <loc>{{ $ourServiceItem->url }}</loc>
                    <lastmod>{{ Illuminate\Support\Carbon::parse(date('Y-m-d'))->format("Y-m-d\\TH:i:sP") }}</lastmod>
                    <changefreq>daily</changefreq>
                    <priority>0.8</priority>
                </url>
                @endforeach
            @endif
        @endforeach
    @endif
    @if (count($catalog))
        @foreach($catalog as $catalogItem)
                <url>
                    <loc>{{ $catalogItem->url }}</loc>
                    <lastmod>{{ Illuminate\Support\Carbon::parse($catalogItem->updated_at)->format("Y-m-d\\TH:i:sP") }}</lastmod>
                    <changefreq>daily</changefreq>
                    <priority>0.8</priority>
                </url>
            @if(count($catalogItem->products))
                @foreach($catalogItem->products as $product)
                    <url>
                        <loc>{{ $product->url }}</loc>
                        <lastmod>{{ Illuminate\Support\Carbon::parse($product->updated_at)->format("Y-m-d\\TH:i:sP") }}</lastmod>
                        <changefreq>daily</changefreq>
                        <priority>0.8</priority>
                    </url>
                @endforeach
            @endif
        @endforeach
    @endif
</urlset>
