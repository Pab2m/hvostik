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
            <div id="div-sost-posts" class="col-md-12">
                
            </div>
        </div>
   
    </div>
</div>

@else
Страница не найдина
@endif
@stop
