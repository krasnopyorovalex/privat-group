<ul class="sitemap">
    @if(count($pages))
        @foreach($pages as $page)
            <li>
                <a href="{{ route('page.show', ['alias' => $page->alias]) }}">{{ $page->name }}</a>
                @if(strstr($page->text,'{articles}') && count($articles))
                    <ul>
                        @foreach($articles as $article)
                            <li>
                                <a href="{{ $article->url }}">{{ $article->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                @endif
                @if(strstr($page->text,'{rooms}') && count($services))
                    <ul>
                        @foreach($services as $service)
                            <li>
                                <a href="{{ $service->url }}">{{ $service->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                @endif
                @if(strstr($page->text,'{news}') && count($news))
                    <ul>
                        @foreach($news as $new)
                            <li>
                                <a href="{{ $new->url }}">{{ $new->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                @endif
                @if(strstr($page->text,'{our_services}') && count($ourServices))
                    <ul>
                        @foreach($ourServices as $ourService)
                            <li>
                                <a href="{{ $ourService->url }}">{{ $ourService->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    @endif
</ul>
