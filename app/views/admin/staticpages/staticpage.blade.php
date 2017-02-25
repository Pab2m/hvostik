@extends('admin.template.main')
@section('title')
Обубликованные обьявления
@stop      
@section('content')
@if((Auth::check())&& (Auth::user()->pravo===88))

<div id='content-left' class='col-md-7'>
 <div class="title">
     <h3>Статическая страница</h3>
</div>
 <div id="staticpage" class="col-md-12">
     <h1>{{$staticpage->title}}</h1>
     <div id="staticpage-post">
        {{$staticpage->post}} 
     </div>
     <div id="staticpage-url">
         <b>Доступна по url:</b> @if($staticpage->url_yes==1) Да  Url:<b>/staticpage/{{$staticpage->url_yes}}</b> @else Нет @endif
     </div>
     <div id="staticpage-button" style="margin:15px">
          <a class="btn btn-default" href="/fyurer/staticpage/edit/{{$staticpage->id}}">Редактировать статическую страницу</a>
     </div>
</div>
</div>
<div class="col-md-5" id="postAdmin"> 
    <div style="margin:15px">
    <a class="btn btn-default" href="/fyurer/staticpage/add">Добавить статическую страницу</a>
    </div>
</div>

@else
Страница не найдина
@endif
@stop
