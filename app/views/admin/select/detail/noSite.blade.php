@extends('admin.template.main')
@section('title')
Обубликованные обьявления
@stop      
@section('head')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" />
<script type='text/javascript' src='//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js'></script>
<!--<script src='http://cdn.datatables.net/plug-ins/28e7751dbec/integration/bootstrap/3/dataTables.bootstrap.js'></script>-->
<script>
    $(document).ready(function(){
      $('table#table').DataTable({"paging": false});
    });
</script>
@stop
@section('content')
@if((Auth::check())&& (Auth::user()->pravo===88))
<div id='content-left' class='col-md-9'>
 <div class="title">
     <h3>{{$title}}</h3>
</div>

<div class="row">
    
<div id="json-panel" class="col-md-6">    
    @if($json)
    <div id="date-json-fail" class="col-md-8">
        Дата создания {{$db}}.json файла:<br>{{date('Y-m-d H:i:s',filemtime($json_url));}}
    </div>
    <button id="button-json-updat" class="btn btn-default" value="{{$db}}" type="button">Обновить JSON файл</button> 
    @endif 
</div>
    
    <div class="col-md-2">
        <button id="button-create-element" class="btn btn-default" value="" type="button">Добавить новый элемент</button> 
    </div>
</div>
   
<div class="row" id="table_select_updata">
    @if($db !=='citys')
 <table class="table" id="table-noregion" data-select="{{$db}}">
     <thead>
     <tr>
         <td>#</td><td>id/value</td><td>name</td><td>Опции</td>
     </tr>
     </thead>
     @foreach($countrys as $value)
     <tr>
         <td><div class="N"><div>{{$i++}}</div></div></td>
         <td><div class="value id"><div class="content">{{$value->$id}}</div></div></td>
         <td><div class="name"><div class="content">{{$value->name}}</div></div></td>  
         <td class="option"><span class="edit-pole glyphicon glyphicon-cog" data-value="{{$value->$id}}" data-name="{{$value->name}}"></span></td>
     </tr>
     @endforeach
</table>
 @else

    <div id="region-region" class="col-md-3">
      <select data-placeholder="Регион" style="width: 100%; display: none;" class="chosen-select" tabindex="-1" id="region_select_amin_site" name="region_select_admin">
            <option value=""></option>
        @foreach($countrys as $value)    
            <option value="{{$value->id}}">{{$value->name}}</option>
        @endforeach
      </select>
   </div>
 <div id="table" class="col-md-12">
   Выбирете регион!!!  
 </div>
        
 @endif
</div>
</div>    
<div class="col-md-3" id="postAdmin"> 
    <div style="margin:15px">
   
    </div>
</div>

@else
Страница не найдина
@endif
@stop