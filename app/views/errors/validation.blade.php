@extends('template.main')
@section('content')

@if(isset($errors))
<br><br><br>
@foreach($errors as $error)
<p>{{$error[0]}}</p>
@endforeach
@endif

@stop