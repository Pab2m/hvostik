@extends('template.main')
@section('title')
Руки добра 
@stop
@section('content')
@foreach($post_all as $post) 
<div class='post_lk'>
           <div class="left">  
                 {{'<img src="'.$post->priv_img.'"/>'}}
           </div>
           <div class="right">
             <div class="title">  
               <a class="title" href="">{{$post->title}}</a>
             </div>
               
             <div class="short_text">
             <span>{{$post->post}}</span>
             </div>   
               <div class="panel">
                   <a href="/post/{{$post->id}}">Подробней</a><br>
                   @if(Auth::user()->id===$post->id_user)
                   <a href="/post/edit/{{$post->id}}">Редактировать</a>
                   <input class="delet" type="checkbox" name="delet[]" value="{{$post->id}}" >
                   @endif
               </div> 
           </div>              
</div>    
@endforeach
@stop