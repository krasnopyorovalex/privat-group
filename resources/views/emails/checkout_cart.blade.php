<p>ФИО: {{ $data['fio'] }}</p>
<p>Телефон: {{ $data['phone'] }}</p>
@if(isset($data['email']))
    <p>Email: {{ $data['email'] }}</p>
@endif
@if(isset($data['address']))
    <p>Адрес: {{ $data['address'] }}</p>
@endif
<p>---------------------------------</p>
<p><b>Описание заказа:</b></p>
<table style="width: 100%" cellpadding="7" border="1">
    <thead>
    <tr>
        <th>Наименование товара</th>
        <th>Цена</th>
        <th>Количество</th>
        <th>Сумма</th>
    </tr>
    </thead>
    <tbody>
    @foreach(app('cart')->getContent() as $item)
        <tr>
            <td>
                @if($item->attributes->image)
                    <a style="display: inline-block; vertical-align: middle;" href="{{ $item->attributes->url }}">
                        <img src="{{ $item->attributes->image }}" alt="" width="146" height="132"/>
                    </a>
                @endif
                <a style="display: inline-block; vertical-align: middle;" href="{{ $item->attributes->url }}">{{ $item->name }}</a>
            </td>
            <td>{{ number_format($item->price, 0, '.', ' ') }} &#8381;</td>
            <td>
                {{ $item->quantity }}
            </td>
            <td>{{ number_format($item->quantity * $item->price, 0, '.', ' ') }} &#8381;</td>
        </tr>
    @endforeach
    <tr>
        <td colspan="4">
            Общая цена: <b>{{ app('cart')->getTotal() }}</b> &#8381;
        </td>
    </tr>
    </tbody>
</table>
