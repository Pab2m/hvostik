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
 <div id="table_config_updata" class="table-responsive">
  <table  class="table" data-select="config">
      <tr>
          <td>№</td>
          <td>Имя</td>
          <td>Значения</td>
          <td>Комментарий</td>
          <td class="option">Опции</td>
      </tr>
      @foreach($confiBd as $value)
       <tr>
          <td>{{$value->id}}</td>
          <td class=""><div class="content ">{{$value->name}}</div></td>
          <td><div class="content name">{{$value->config}}</div></td>
          <td>{{$value->comment}}</td>
          <td td class="option"><span class="edit-pole ButtonUpdataConfig glyphicon glyphicon-cog" data-value="{{$value->id}}" data-name="{{$value->config}}"></span></td>
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
