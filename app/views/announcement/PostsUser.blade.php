@extends('template.main')
@section('title')
Личный кабинет
@stop
@section('content')
@if(Auth::check())
<h4>Личный кабинет,{{'  '.$email}}</h4>
<div class="row">
@if(Auth::user()->pravo===88)
<div class="col-md-2">
    <a class="a-add" href="/fyurer/"><span>Админка</span></a>
</div>    
@endif
<div class="col-md-2">
    <a class="a-add" href="/logout"><span>Выйти</span></a>
</div>   
</div>
<div id='content-left' class='col-md-12'>

  <div class="bs-example bs-example-tabs">
    <ul id="myTab" class="nav nav-tabs">
        
      <li class=" {{ (count($posts_true) != 0) || (count($posts_false) == 0) ? "active" : '' }}"><a href="#home" data-toggle="tab">Обубликованные объявления ({{count($posts_true);}})</a></li>
      <li class=" {{ count($posts_false) != 0 ? "active" : '' }}"><a href="#profile" data-toggle="tab">На модерации ({{count($posts_false);}})</a></li>
    </ul>
    <div id="announcement" class="tab-content">
      <div class="tab-pane fade  {{ (count($posts_true) != 0) || (count($posts_false) == 0) ? "in active" : '' }}" id="home">
  @if($posts_true instanceof Illuminate\Pagination\Paginator)   
    @foreach($posts_true as $post) 
         @include('announcement.annoucement-short')      
    @endforeach
    {{$posts_true->links();}}
    @else
    У вас нет обубликованных обьявлений! 
    @endif
     </div>
      <div class="tab-pane fade {{ count($posts_false) != 0 ? "in active" : '' }}" id="profile">
 @if($posts_false instanceof Illuminate\Pagination\Paginator)          
   @foreach($posts_false as $post) 
         @include('announcement.annoucement-short')      
    @endforeach
 @else
 У вас нет не обубликованных обьявлений! 
 @endif
      </div>
    </div>
  </div>
</div>    
@section('footer-script')
<script src="/libs/bootstrap/tab.js"></script>
<script>
$('#myTab a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
})
</script>
@stop

@else
Вы не авторизированы!!!
@endif
@stop