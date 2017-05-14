@extends('admin.template.main')
@section('title')
Настройке системы
@stop      
@section('content')
@if((Auth::check())&& (Auth::user()->pravo===88))
 <div id='content-left' class='col-md-9'>
 <div class="title">
     <h3>Настройки системы</h3>
</div>
     <button  class="btn btn-default">Добавить</button>
<div id="AllConfig-admin" class="row">
    @if(count($confiBd) === 0)
        Настроек системы нет!!!
    @else
 <div class="table-responsive">
  <table class="table">
      <tr>
          <td>№</td>
          <td>Имя</td>
          <td>Значения</td>
          <td>Комментарий</td>
          <td><span class="glyphicon glyphicon-cog"></span></td>
      </tr>
      @foreach($confiBd as $value)
       <tr>
          <td>{{$value->id}}</td>
          <td>{{$value->name}}</td>
          <td>{{$value->config}}</td>
          <td>{{$value->comment}}</td>
          <td><span class="ButtonUpdataConfig glyphicon glyphicon-cog" data-value="{{$value->id}}" data-name="{{$value->name}}"></span></td>
      </tr>
      @endforeach
  </table>
</div>
    
    @endif
</div>
 </div>     
 
   
@else
Страница не найдина
@endif
@stop
