@extends('template.main')
@section('title')
Вход
@stop
@section('content')
<div id="content">
    @if(Auth::check())
     <div id='enter_html' class="col-md-6">   
    Вы уже авторизованны, как {{Auth::user()->email;}}<br>
    <a href="/private_office">Личный кабинет</a><br>
    <a href="/logout">Выйти</a>
     </div>
    @else
    <div id='vhod'>
    <h2>Вход</h2>
   </div>
    <div id='enter_html' class="col-md-6">   
    <h3>Вход на сайт</h3>
     {{Form::open(['url'=>'/login', 'id'=>'vhod_form','class'=>'form-horizontal', 'role'=>'form','method' => 'post'])}}   
  <div class="form-group"> 
    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
       {{Form::text('email',null, ['placeholder'=>'Email','id'=>'email','type'=>'email', 'class'=>'form-control' ])}} 
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Пароль</label>
    <div class="col-sm-10">
      {{Form::password('password', ['placeholder'=>'Password','id'=>'password','type'=>'password', 'class'=>'form-control'])}}  
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox" name="remember" value="remember-me"> Запомнить меня
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default" id="vhod_botton" name="vhod_botton">Войти</button>
    </div>
  </div>      
 {{Form::close()}}
 <div class="row">
 <div class="col-md-6">
    <a href="/registration">Регистрация</a>
 </div> 
 <div class="col-md-6 div_right">    
    <a href="/password/remind">Забыли пароль?</a>
</div>
</div>
 <div id="a_vk" class="row">
     <a href='{{HomeController::authVk()}}'>ВКонтакте</a></li>
 </div> 
</div> 
     @endif
</div>


@stop
