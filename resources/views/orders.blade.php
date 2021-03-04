@extends('layouts.app')

@section('title', 'Заказы')

@section('content')
<h1>@yield('title')</h1>
<div id="app "></div>
<form method="get" action="{{route('search')}}">
	
		<input type="text" name="s" placeholder="Введите имя">
		<button type="submite">Поиск</button>
	</form>

<table class="tableOrder">
	<tr style="background-color: #0c0c0c; color: white">
	<th>№</th>
	<th>ФИО</th>
	<th>СУММА</th>
	<td>ОПЛАТА</th>
	<th>СТАТУС</th>
	<th>ТТН</th>
</tr>
@foreach($data as $el)
<tr onclick="document.location='{{route('order-data-one', $el->id)}}'">
	<td>{{$el->id}}</td>
	<td>{{$el->surname}} {{$el->name}} {{$el->middle_name}}</td>
	<td>{{$el->sum}}</td>
	<td>{{$el->payment}}</td>
	<td>{{$el->status}}</td>
	<td>{{$el->ttn}}</td>
	
</tr>
@endforeach
</table>
<a href="{{route('orderNew')}}">Новый заказ</a>
@endsection