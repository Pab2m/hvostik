@extends('template.main')
 
@section('title')
Сброс пароля
@stop
 
@section('content')
<br><br><br>
    <div class="container">
        @if (Session::has('error'))
            <div class="alert alert-danger">
                {{ Session::get('error') }}
            </div>
        @endif
 
        <h2>Сброс пароля</h2>
        
        {{ Form::open(array('url' => action('RemindersController@postReset'), 'method' => 'post', 'role' => 'form', 'class' => 'form-horizontal')) }}
        <ul>
        <li> Ваш E-Mail</li>
        <li> {{ Form::email('email', null, array('class' => 'form-control')) }}</li>
        <li> Новый пароль</li>
        <li>{{ Form::password('password', array('class' => 'form-control')) }}</li>
        <li>Повторите</li>
        <li>{{ Form::password('password_confirmation', array('class' => 'form-control')) }}</li>
        <li> <input type="hidden" name="token" value="{{ $token }}" /></li>
         <li> <button type="submit" class="btn btn-primary">Сбросить</button></li>
          </ul>
        {{ Form::close() }}
    </div>
@stop