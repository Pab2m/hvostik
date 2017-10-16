@extends('template.main')
@section('head')
<script src='https://www.google.com/recaptcha/api.js'></script>
@stop
@section('title')
Регистрация
@stop
@section('content')
<div id='enter_html' class="col-md-7">
    <h3>Регистрация</h3>  
    {{Form::open(["class"=>"form-horizontal", "role"=>"form","id"=>"form-registr"])}}   
  <div class="form-group">
   <div class="col-sm-2">    
    <label for="inputEmail3" class="ccontrol-label">Email</label>
   </div> 
    <div class="col-sm-9">
      {{Form::text('email',null, ['placeholder'=>'Email',"type"=>"email", "class"=>"form-control", "id"=>"inputEmail3"])}}
    </div>
  </div>
  <div class="form-group">
   <div class="col-sm-2">   
    <label for="inputPassword3" class="control-label">Пароль</label>
   </div> 
    <div class="col-sm-9">
      {{Form::password('password', ['placeholder'=>'Пароль',"type"=>"password", "class"=>"form-control", "id"=>"inputPassword3"])}}
    </div>
    <div class="col-sm-1 padding0">
      
    </div>
  </div>
     <div class="form-group">
    <div class="col-sm-2">
    <label for="inputPassword3" class="control-label">Пароль</label>
    </div>
    <div class="col-sm-9">
      {{Form::password('repeat_password', ['placeholder'=>'Повторите пароль',"type"=>"password", "class"=>"form-control", "id"=>"repeat_inputPassword3"])}}
    </div>
    <div class="col-sm-1 padding0">
        
    </div>
  </div>
<div class="form-group container">
    <div class="g-recaptcha" data-sitekey="6LcQUxgTAAAAAIPKtxdvQpU6khJph9w3s80swrpi"></div>
  </div> 
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      {{Form::button('Зарегистрироваться',["type"=>"button", "class"=>"btn btn-default", "id"=>"registracion"])}}      
    </div>
  </div>
{{Form::close()}}
</div>


@stop