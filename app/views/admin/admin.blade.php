@extends('admin.template.main')
@section('title')
Обубликованные обьявления
@stop      
@section('content')
@if((Auth::check())&& (Auth::user()->pravo===88))
<div id='content-left' class='col-md-7'>
  
    
    
    
</div>

@else
Страница не найдина
@endif
@stop
