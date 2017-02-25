@extends('template.main')
@section('head')

@stop
@section('title')
{{$staticpage->title}}
@stop
@section('content')

<div id="post_podr" class="col-md-12">
    <h1>{{$staticpage->title}}</h1>
    <div class="col-md-10">
        {{$staticpage->post}}
    </div>    
</div>

@stop