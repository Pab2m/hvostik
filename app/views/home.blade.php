@extends('template.main')
@section('title')
Руки добра 
@stop
 @section('content')
     <div id="title">
         <h1>{{$title_content}}</h1>
     </div> 
      <div id='content-left' class='col-md-12'>
      <div id="announcement" class="container-fluid">     
     @foreach($post_all as $post)   
              @include('announcement.annoucement-short') 
     @endforeach
     {{$post_all->links();}}
     </div>
      </div>

@stop
     
