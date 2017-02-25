@extends('admin.template.main')
@section('title')
Обубликованные обьявления
@stop      
@section('content')
@if((Auth::check())&& (Auth::user()->pravo===88))

<div id='content-left' class='col-md-7'>
 <div class="title">
  Зарегистрированные пользователи 
</div>
@if(count($users_all)!=0)    
<table class="table">
    <td>#</td><td>id</td><td>Email</td>
     <?php $i=1; ?>
     @foreach($users_all as $user) 
     <tr>
         <td>{{$i}}</td><td>{{$user->id}}</td><td>{{$user->email}}</td>
     </tr>
     <?php $i++;?>
     @endforeach 
</table>
{{$users_all->links();}}
@else

@endif       
</div>
<div class="col-md-5">
    
</div>

@else
Страница не найдина
@endif
@stop
