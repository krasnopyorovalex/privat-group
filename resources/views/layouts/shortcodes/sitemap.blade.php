<ul class="sitemap">
    @if(count($pages))
        @foreach($pages as $page)
            <li>
                <a href="{{ $page->url }}">{{ $page->name }}</a>
                @if(strstr($page->text,'{projects}') && count($projects))
                    <ul>
                        @foreach($projects as $project)
                            <li>
                                <a href="{{ $project->url }}">{{ $project->name }}</a>
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
                    @foreach($ourServices as $ourService)
                        @if(count($ourService->ourServiceItems))
                            <ul>
                                @foreach($ourService->ourServiceItems as $ourServiceItem)
                                    <li>
                                        <a href="{{ $ourServiceItem->url }}">{{ $ourServiceItem->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    @endforeach
                @endif
                @if(strstr($page->text,'{catalog}') && count($catalog))
                    <ul>
                        @foreach($catalog as $catalogItem)
                            <li>
                                <a href="{{ $catalogItem->url }}">{{ $catalogItem->name }}</a>
                                @if($catalogItem->products)
                                <ul>
                                    @foreach($catalogItem->products as $product)
                                        <li>
                                            <a href="{{ $product->url }}">{{ $product->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    @endif
</ul>
