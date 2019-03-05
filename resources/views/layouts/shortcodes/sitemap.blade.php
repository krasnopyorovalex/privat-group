<ul class="sitemap">
    @if (count($pages))
        @foreach($pages as $page)
            <li>
                <a href="{{ route('page.show', ['alias' => $page->alias]) }}">{{ $page->name }}</a>
                @if ($page->template == 'page.blog' && count($articles))
                    <ul>
                        @foreach($articles as $blog)
                            <li>
                                <a href="{{ route('article.show', ['alias' => $blog->alias]) }}">{{ $blog->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                @endif
                @if ($page->alias == 'turi' && count($services))
                    <ul>
                        @foreach($services as $service)
                            <li>
                                <a href="{{ route('page.show', ['alias' => $service->alias]) }}">{{ $service->name }}</a>
                                @if (count($service->services))
                                   <ul>
                                       @foreach($service->services as $subService)
                                           <li>
                                               <a href="{{ route('page.show', ['alias' => $subService->alias]) }}">{{ $subService->name }}</a>
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