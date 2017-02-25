@extends('admin.template.main')
@section('title')
Обубликованные обьявления
@stop      
@section('content')
@if((Auth::check())&& (Auth::user()->pravo===88))

<div id='content-left' class='col-md-7'>
 <div class="title">
     <h3>Статическии страницы</h3>
</div>
@if(count($staticpages_all)!=0)  
<table class="table">
    <tr>
        <td>#</td><td>id</td><td>title</td><td>url</td> 
    </tr>
     <?php $i=1;?>
     @foreach($staticpages_all as $staticpage)
     <tr>
         <td>{{$i}}</td><td>{{$staticpage->id}}</td><td><a href="/fyurer/staticpage/{{$staticpage->id}}">{{$staticpage->title}}</a></td><td>{{$staticpage->url}}</td>
     </tr>     
      <?php $i++;?>
     @endforeach 
</table> 
{{$staticpages_all->links();}}
@else
Стратических страниц нет!
@endif       
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
