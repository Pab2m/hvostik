@extends('admin.template.main')
@section('title')
Обубликованные обьявления
@stop      
@section('content')
@if((Auth::check())&& (Auth::user()->pravo===88))

<div id='content-left' class='col-md-7'>
 <div class="title">
     <h3>Редактирование статическую страницу</h3>
</div>
    <div id="staticpage-add">
    {{Form::open(array('action' => 'AdminController@adminStaticpageAdd','id'=>'form-staticpage-add','files' =>false,'class'=>"form-horizontal", 'role'=>"form"))}}
  <div id="input_name" class="form-group  has-feedback">
    <div class="col-sm-10">
      {{Form::text('title',null, ['placeholder'=>'Названия (Загаловок)','id'=>'title', 'class'=>"form-control"])}}
    </div>
  </div>
  <div id="input_post" class="form-group  has-feedback">
    <div class="col-sm-10">
      {{Form::textarea('post',null, ['placeholder'=>'html код','id'=>'post', 'class'=>"form-control"])}}
    </div>
  </div>  
    <div class="row">  
        <div class="col-md-5">
  <div id="input_post" class="form-group  has-feedback">
    <div class="col-sm-10">
        <button id="buttonAdd" name="buttonAdd" class="btn btn-default" type="button">Добавить статическую страницу</button>
    </div>
  </div>    
        </div>
        <div class="col-md-3">
            <div class="form-group  has-feedback">
                <input id="true_url" name="true_url" type="checkbox" value="1" checked/>   
            Вывод через url
            </div>
        </div>    
    </div>    
   {{Form::close()}}     
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
