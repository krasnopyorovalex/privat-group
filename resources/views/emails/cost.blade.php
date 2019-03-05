<p>Дата приезда: {{ $data['date_in'] }}</p>
<p>Дата выезда: {{ $data['date_out'] }}</p>
<p>Имя: {{ $data['name'] }}</p>
<p>Телефон: {{ $data['phone'] }}</p>
@if($data['email'])
<p>Email: {{ $data['email'] }}</p>
@endif
