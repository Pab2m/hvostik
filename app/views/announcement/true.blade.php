@extends('template.main')
@section('title')
Объявление добавлино успешно
@stop
@section('content')
<br><br><br> 
@if(Auth::check())

<h4>Ваше обьявление "{{$title}}" добавлино.</h4>
После <b>модерации</b> оно появится на сайте!

@else
Для подачи объявления необходимо авторизироваться 
@endif
@stop