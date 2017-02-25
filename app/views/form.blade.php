@extends('template.main')
@section('content')
<br><br><br> 
<h4>Добавить объявления</h4>
{{Form::open(array('action' => 'AjaxController@AdminPostEditDate','method'=>'POST'))}}
{{Form::text('post_id')}}</br>
{{Form::text('input_id')}}</br>
{{Form::text('value')}}</br>
{{Form::submit('Отправить')}}</br>
{{Form::close()}}

@stop