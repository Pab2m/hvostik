@extends('admin.template.main')
@section('title')
Обубликованные обьявления
@stop      
@section('content')
@if((Auth::check())&& (Auth::user()->pravo===88))

<div id='content-left' class='col-md-7'>
 <div class="title">
     <h3>Редактировать статическую страницу</h3>
</div>
    <div id="staticpage-edit">
    {{Form::open(array('action' => 'AdminController@adminStaticpageEditForm','id'=>'form-staticpage-edit','files' =>false,'class'=>"form-horizontal", 'role'=>"form"))}}
  <div id="input_name" class="form-group  has-feedback">
    <div class="col-sm-10">
      {{Form::text('title',$staticpage->title, ['placeholder'=>'Названия (Загаловок)','id'=>'title', 'class'=>"form-control"])}}
    </div>
  </div>
     <div id="input_url" class="form-group  has-feedback">
    <div class="col-sm-10">
      {{Form::text('url',$staticpage->url, ['placeholder'=>'url','id'=>'title', 'class'=>"form-control"])}}
    </div>
  </div>
  <div id="input_post" class="form-group  has-feedback">
    <div class="col-sm-10">
      {{Form::textarea('post',$staticpage->post, ['placeholder'=>'html код','id'=>'post', 'class'=>"form-control"])}}
      <input name="staticpageId" value="{{$staticpage->id}}" type="hidden"/>
    </div>
  </div>  
    <div class="row">  
        <div class="col-md-5">
  <div id="input_post" class="form-group  has-feedback">
    <div class="col-sm-10">
        <button id="buttonEdit" name="buttonEdit" class="btn btn-default" type="button">Сохранить</button>
    </div>
  </div>    
        </div>
        <div class="col-md-3">
            <div class="form-group  has-feedback">
                @if($staticpage->url_yes==1) 
                <?php $checked="checked" ?>
                @else 
                <?php $checked="" ?>
                @endif
                <input id="true_url" name="true_url" type="checkbox" value="1"  {{$checked}}/>   
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
