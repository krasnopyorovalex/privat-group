@if ($paginator->hasPages())
    <ul>
        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                    @else
                        <li><a class="page-link" href="{{ route('page.show', ['alias' => request('alias'), 'page' => ($page == 1 ? false : $page)]) }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach
    </ul>
@endif
