@extends('layouts.app')

@section('title', 'Новый заказ')

@section('content')
<h1>@yield('title')</h1>

<form action="{{route('orderCreate')}}" method="post">
	@csrf
	<label>ФИО</label>
    <input type="text" name="surname" placeholder="Фамилия">
	<input type="text" name="name" placeholder="Имя">
	<input type="text" name="middle_name" placeholder="Отчество">
	<br><label>Остальное</label>
	<input type="text" name="phone_number" placeholder="Номер телефона">
	<input type="text" name="sum" placeholder="Сумма">
	<input type="text" name="ttn" placeholder="ТТН">
	<input type="text" name="message" placeholder="Комментарий">
	<br><br>
	<input type="submit">
</form>
@endsection