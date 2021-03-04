@extends('layouts.app')

@section('title', 'Заказ')

@section('content')
<h1>@yield('title') №{{$data->id}}</h1>
<a href="/orders">Назад</a>

<div class="alert">
	<h1>Имя: {{ $data->name}}</h1>
	<h2>Номер телефона: {{ $data->phone_number}}</h2>
	<h2>Комментарий: {{ $data->message}}</h2>
	<p>Сумма: {{ $data->sum}} Статус: {{ $data->status}} ТТН: {{ $data->ttn}}</p>
	<a href="{{route('order-delete', $data->id)}}">Удалить</a>
</div>
@endsection