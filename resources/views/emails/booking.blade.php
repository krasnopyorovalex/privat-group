<p>Категория номера: {{ $data['room'] }}</p>
<p>Дата приезда: {{ $data['date_in'] }}</p>
<p>Дата выезда: {{ $data['date_out'] }}</p>
<p>Количество взрослых: {{ $data['count_adults'] }}</p>
@if($data['count_child'])
<p>Количество детей: {{ $data['count_child'] }}</p>
@endif
<p>ФИО: {{ $data['fio'] }}</p>
<p>Телефон: {{ $data['phone'] }}</p>
<p>Email: {{ $data['email'] }}</p>
@if($data['dop__info'])
    <p>Дополнительная информация: {{ $data['dop__info'] }}</p>
@endif
