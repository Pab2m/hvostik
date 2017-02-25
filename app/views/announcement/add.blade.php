@extends('template.main')
@section('title')
Добавить объявление
@stop
@section('head')
{{HTML::script('script/jquery.maskedinput-1.2.2.js');}}
{{HTML::script('script/uploaderObject.js');}}
{{HTML::script('script/interface.js');}}
<script type="text/javascript">
           jQuery(function($) {  
            $.mask.definitions['~']='[+-]';
            $('input#phone').mask('+7(999) 999-99-99');
                });
</script>
@stop
@section('content')
@if(Auth::check())
<div id="add_post" class="col-sm-11">
<h4>Опубликовать объявление</h4>
{{Form::open(array('action' => 'PostController@postAdd','id'=>'add','files' =>true,'class'=>"form-horizontal", 'role'=>"form"))}}
  <div id="input_name" class="form-group  has-feedback">
    <div class="col-sm-10">
      {{Form::text('name',null, ['placeholder'=>'Ваше Имя','id'=>'name', 'class'=>"form-control"])}}
    </div>
  </div>
  <div id="input_email" class="form-group has-feedback">
    <div class="col-md-10">
      {{Form::email('email',Auth::user()->email, ['placeholder'=>'Ваш Email','id'=>'email','class'=>"form-control"])}}
    </div>  
  </div>
  <div id="input_phone" class="form-group">
    <div class="col-sm-10">
        {{Form::text('phone',null, ['placeholder'=>'Ваш телефон','id'=>'phone','class'=>"form-control",'class'=>"form-control"])}}
    </div>
  </div>
 
<div id='region' class="col-md-6 form-group has-feedback">
   <select data-placeholder="Регион" style="width:100%;" class="chosen-select" tabindex="7" id="region_select" name="region_select">
           
  </select>
</div>

<div id="categorij" class="form-group has-feedback col-md-6" >
   <select data-placeholder="Категория" style="width:100%;" class="chosen-select" tabindex="7" id="category_select" name="category_select">
 
    </select>
</div>

    <div id="input_title" class="col-sm-10 form-group  has-feedback" >
{{Form::text('title',null, ['placeholder'=>'Названия объявления','id'=>'title','class'=>'form-control'])}}
    </div> 
<div class="form-group" >
    <div  id="input_post" class="col-sm-10" >
 {{Form::textarea('post',null, ['placeholder'=>'Описание','id'=>'post', 'class'=>'form-control', 'rows'=>'8'])}}   
    </div>
</div>  

<h4>Добавить фотографии</h4>
<div class="form-group" >
    <div class="row">
        <div class="col-md-5">   
 {{Form::file('file',['id'=>'file-field', 'class'=>'btn btn-default','multiple'=>'true','accept'=>"image/*,image/jpeg",])}}
        </div>
        <div class="col-md-7">
            <div>
         Обубликовать указанный Email:   {{Form::checkbox('privat_email', '1',true,['id'=>"privat_email"]);}}
            </div>
            
 @if(Auth::user()->pravo===88)
 <div>
  Обубликовать обьявления:   {{Form::checkbox('sostoynia', '1',true);}}
 </div> 
 @endif
      </div>
    </div> 
 <div class="col-sm-10">
  <span>
    <img src="/images/add_foto.png" alt="" />
  </span>
 
 <div class="form-group" >
    <div class="col-sm-10" >           
 <div id="img-container">
      <ul id="img-list">
          
      </ul>
 </div> 
    </div>
</div> 
     </div>
</div>  

 <button id='button_add_annou' class="add btn btn-default" type="button" >Опубликовать</button> 

  
{{Form::close()}}
</div>
@else
Для подачи объявления необходимо авторизироваться 
@endif
@stop