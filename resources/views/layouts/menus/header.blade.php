<ul>
    @foreach($menu->get('menu_header') as $item)
        <li{!! add_css_class($item) !!}>
            <a itemprop="url" href="{{ $item->link }}">{{ $item->name }}</a>
            @if (count($item->menuItems))
                <ul>
                    @foreach($item->menuItems as $subItem)
                        <li><a href="{{ $subItem->link }}">{{ $subItem->name }}</a></li>
                    @endforeach
                </ul>
            @endif
        </li>
    @endforeach
</ul>
<a href="tel:89787547499" class="phone__mob">
    <svg>
        <use xlink:href="{{ asset('img/symbols.svg#phone_mob') }}"></use>
    </svg>
</a>
<a href="{{ route('page.show', ['alias' => 'booking']) }}" class="btn btn__booking">
    Забронировать
</a>
<div class="burger-mob">
    <span></span>
</div>
