@extends('admin.template.main')
@section('title')
Обубликованные обьявления
@stop      
@section('content')
@if((Auth::check())&& (Auth::user()->pravo===88))

<div id='content-left' class='col-md-7'>
 <div class="title">
    {{$title}}
</div>
@if(count($post_all)!=0)    
     @foreach($post_all as $post) 
              @include('admin.annoucement.annoucement-short')  
     @endforeach 
{{$post_all->links();}}
@else

@endif       
</div>
<div class="col-md-5" id="postAdmin"> 
    <div style="margin: 15px">
        <button type="button" class="btn btn-default" id="postControl"> Снять, удалить объявления завершённые по времени</button> 
        <div class="container">
            <div id="div-sost-posts" class="col-md-12"  style="display: none">
                <div class='row'>
                  <div class='col-mg-12'>
                   Объявлений на снятия: <b id="snjtPostCount"></b> шт.<br>
                   Объявлений на удаление: <b id ="deletPostCount"></b> шт.<br>
                  </div>
                 </div>
                 <div class='row'>
                 <div class='col-md-12'>
                 <button id='otchet-sostpost' class='btn btn-default'>Удалить/Снять объявленния</button>
                 </div></div>
            </div>
        </div>
   
    </div>
</div>

@else
Страница не найдина
@endif
@stop
