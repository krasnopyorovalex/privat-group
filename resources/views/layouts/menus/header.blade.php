<!-- RD Navbar Nav-->
<ul class="rd-navbar-nav">
    @foreach($menu->get('menu_header') as $item)
        <li class="rd-nav-item{!! add_css_class($item) !!}">
            <a class="rd-nav-link" itemprop="url" href="{{ $item->link }}">{{ $item->name }}</a>
            @if (count($item->menuItems))
                <ul class="rd-menu rd-navbar-dropdown">
                @foreach($item->menuItems as $subItem)
                        <li class="rd-dropdown-item"><a href="{{ $subItem->link }}">{{ $subItem->name }}</a></li>
                    @endforeach
                </ul>
            @endif
        </li>
    @endforeach
</ul>
