@extends('template.main')
 
@section('title')
Сброс пароля
@stop
 
@section('content')
    <div id ="enter_html">
        @if (Session::has('error'))
            <div class="alert alert-danger">
                {{ Session::get('error') }}
            </div>
        @endif
 
        <h3>Сброс пароля</h3>
        {{ Form::open(array('url' => action('RemindersController@postReset'), 'method' => 'post', 'role' => 'form', 'class' => 'form-horizontal',"id"=>"form-registr")) }}
        <div class="form-group">
       <div class="col-sm-3">    
        <label for="inputEmail3" class="ccontrol-label">E-Mail</label>
       </div> 
       <div class="col-sm-8">
          {{ Form::email('email', null, ['placeholder'=>'Email',"type"=>"email", "class"=>"form-control", "id"=>"inputEmail3"]) }}
       </div>

      </div>
        <div class="form-group">
       <div class="col-sm-3">    
        <label for="inputEmail3" class="ccontrol-label">Новый пароль</label>
       </div> 
       <div class="col-sm-8">
          {{ Form::password('password', ['placeholder'=>'Пароль',"type"=>"password", "class"=>"form-control", "id"=>"inputPassword3"]) }}
       </div>
      <div class="col-sm-1 padding0">
      
      </div>     
      </div>
          <div class="form-group">
       <div class="col-sm-3">    
        <label for="inputEmail3" class="ccontrol-label">Повторите</label>
       </div> 
       <div class="col-sm-8">
          {{ Form::password('password_confirmation', ['placeholder'=>'Повторите пароль',"type"=>"password", "class"=>"form-control", "id"=>"repeat_inputPassword3"]) }}
          <input type="hidden" name="token" value="" />
       </div>
       <div class="col-sm-1 padding0">
      
       </div>    
      </div>
    <div class="form-group">
    <div class="col-sm-offset-3 col-sm-10">
       <button id="registracion" class="btn btn-primary">Сбросить пароль</button>
    </div>
  </div>
        {{ Form::close() }}
    </div>
@stop