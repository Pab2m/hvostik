@extends('admin.template.main')
@section('title')
{{$post->title}}
@stop      
@section('content')
@if((Auth::check())&& (Auth::user()->pravo===88))
<div id="post_podr" class="col-md-6">
<h1 style="text-align: left;">{{$post->title}}</h1>
<div  id="slou-1" class="row">
    <div id="date-post" class="col-md-6">
         Размещено: {{$post->DateVchera($post->created_at, false)}} <span class='glyphicon glyphicon-play ob'></span>  
         Просмотров: {{$post->prosmotry}}
    </div>   
    <div id="edit-post" class="col-md-6">
                <a href="/post/edit/{{$post->id}}">Редактировать, обнавить, удалить</a> объявление
    </div>
  </div>
@if($post->img_url!="")
  <div id="slou-2" class="row">
      <div id="post-left" class="col-md-9 col-xs-12 img-responsive">
          <div id="image">
           <?php $img_url=$post->img_url;    ?>                   
                <a class="img"  rel="group"  href="/{{current($img_url)[0]}}">
                    <img class="image img-responsive"  src="/{{current($img_url)[640]}}"/>
                </a>
          </div>
      </div>
      <div id="post-rigth" class="col-md-3 img-responsive">
           {{$post->PrintFoto()}}
      </div>
  </div>
@endif
 <div id="slou-post" class="container tex">  
       @if(isset($post->cena))
       <div class="container tex">  
        <div class="col-md-3 div-li">Цена</div> 
        <div class="col-md-9" id="cout-cena">{{$post->cena}}  </div> 
       </div>    
       @endif
<div class="row tex">
        <div class="col-md-3 div-li tex">
         Контактное лицо:
        </div> 
        <div class="col-md-9 tex">
         {{$post->name}}
        </div> 
 </div>  
 @if($post->privat_email==1)
  <div class="row tex">
        <div class="col-md-3 div-li tex">
         Email:
        </div> 
        <div class="col-md-2 tex">
          {{$post->email}}
        </div> 
        <div class="col-md-3 tex">
        <button id="email_pusk" type="submit" class="btn btn-default">Отправить Email</button>     
        </div>   
  </div>  
@endif  
 @if(isset($post->phone))
       <div class="row phone tex">
         <div class="col-md-3 div-li tex">
        </div> 
        <div class="col-md-9 ">
       <img src="/{{$post->phone}}"/>
        </div>
       </div>   
@endif  
<div class="row">
     <div class="col-md-3 div-li tex">
        Город
     </div> 
        <div class="col-md-9 tex">
            {{$post->RegionsName()}}, {{$post->CitysName()}}
        </div>
</div> 
<div class="row tex">
 <div class="col-md-3 div-li tex">
     Вид объявления: 
 </div> 
 <div class="col-md-5 tex">
    {{$post->Kroshki()}}
  </div>      
</div> 

<div id="post" class="col-md-8" >
    {{$post->post}}
</div>  
 </div>

</div>
<div id="postID-form" class="col-md-3">
 <div class="border-form-bottop"> 
     <form id='postEditModerazij' class='form-horizontal' role='form'>
  <input id="PostId"  name="postId" type="hidden" value="{{$post->id}}"/>
  <input id="PostUser"  name="postUser" type="hidden" value="{{$post->id_user}}"/>
  <input id="PostSostoynia"  name="PostSostoynia" type="hidden" value="{{$post->sostoynia}}"/>
  @if($post->sostoynia==0)
  <div id="sostPost" class="postModer col-md-12">
      На модерации
  </div>
  <div id="panelInput">
  <input id="" class="PostTrue sostEdit btn btn-default" data-id-so="1" type="button" value="Обубликовать"/>
  <input id="" class="PostDelete sostEdit btn btn-default" data-id-so="2" type="button" value="Снять обьявление"/>
  </div>
  @else 
  @if($post->sostoynia==1)
  <div id="sostPost" class="postPublik col-md-12">
       Обубликованно
  </div>
  <div id="panelInput">
  <input  class="PostFalse sostEdit btn btn-default" data-id-so="0" type="button" value="На модерацию"/>
  <input  class="PostDelete sostEdit btn btn-default" data-id-so="2" type="button" value="Снять обьявление"/>
  </div>
  @else
  @if($post->sostoynia==2)
   <div id="sostPost" class="DeletPublik col-md-12">
       Снятое обьявление 
  </div>
  <div id="panelInput">
  <input class="PostFalse sostEdit btn btn-default" type="button" data-id-so="0"  value="На модерацию"/>
  <input  class="PostTrue sostEdit btn btn-default" type="button" data-id-so="1"  value="Обубликовать"/>
  </div>
  @endif
  @endif
  @endif
@if($post->sostoynia == 1)
<div class="col-md-12" id="aktiv-date-post">
    <div id="chtaem-at-text">Активно до:</div>
    <input type="date" id="chtaem-at" class="btn btn-default" value="{{date("Y-m-d",strtotime($post-> chtaem_at))}}"  /> <!--$teme_ch-->
    <button id="date-save" class="btn btn-default" type="button">Сохранить</button>
    <button id="date-сancel" class="btn btn-default" type="button"><span style="color:red" class="glyphicon glyphicon-remove"></span></button>
</div>  
@else
@if($post->sostoynia == 2)
<div class="col-md-12"  id="aktiv-date-post">
    <div id="chtaem-at-text">Удалится посли:</div>
    <div id="chtaem-at-maybe">
    </div> 
    <input type="date"  id="chtaem-at" class="btn btn-default" placeholder="dd-mm-yyyy"  value="{{$deletetaem_at}}"  /> 
    <button id="date-save" style="display: none" class="btn btn-default" type="button">Сохранить</button>
    <button id="date-сancel" style="display: none" class="btn btn-default" type="button"><span style="color:red" class="glyphicon glyphicon-remove"></span></button>

</div>  
@else
@if($post->sostoynia == 0)
<div class="col-md-12"  id="aktiv-date-post">
      <div id="chtaem-at-text">Активно до (предворительно):</div>
    <div id="chtaem-at-maybe">
       {{date("Y-m-d",strtotime($chtaem_at))}}
    </div> 
      <input autocomplete="on" type="date" style="display: none" id="chtaem-at" class="btn btn-default"  value="{{$chtaem_at}}"  /> <!--chtaem_at-->
    <button id="date-save" style="display: none" class="btn btn-default" type="button">Сохранить</button>
    <button id="date-сancel" style="display: none" class="btn btn-default" type="button"><span style="color:red" class="glyphicon glyphicon-remove"></span></button>
</div>  
@endif
@endif
@endif
  <br>
  <input id="PostIdEdit" class="btn btn-default" type="button" value="Редактировать"/>
  <input id="PostIdUser" class="btn btn-default" type="button" value="Написать автору"/>
  <input id="PostIdVip" class="btn btn-default" type="button" value="Сделать vip"/><br>
  <input id="PostIdDelet" class="btn btn-default" type="button" value="Удалить"/>
     </form>
</div>
</div>
   

@else
Страница не найдина
@endif
@stop
