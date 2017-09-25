@extends('template.main')
@section('head')
 <script src="\libs\jquery.mousewheel.min.js"></script>
 <script src="\script\ad-script.js"></script>
@stop
@section('title')
{{$post->title}}
@stop
@section('content')

<div id="post_podr" class="col-md-12">
    <h1>{{$post->title}}</h1>
  <div  id="slou-1" class="row">
    <div id="date-post" class="col-md-6">
         Размещено: {{$post->DateVchera($post->created_at, false)}} <span class='glyphicon glyphicon-play ob'></span>  
         Просмотров: {{$post->prosmotry}}
    </div>   
    <div id="edit-post" class="col-md-6">
                <a href="/post/edit/{{$post->id}}">Редактировать, обнавить, удалить</a> объявление
    </div>
  </div>

@if($post->img_url!='')
  <div id="slou-2" class="row">
      <div id="post-left" class="col-md-9 col-xs-12 img-responsive">
          <div id="image">
           <?php $i=0; ?>    
              @foreach ($post->img_url as $value)
                <a 
                   @if ($i === 0) {{'rel="gallery1" class="img show"'}} @else {{'class="img hide"  rel="gallery1"'}} @endif 
                   href="/{{$value[0]}}">
                    <img class="img-responsive"  src="/{{$value[640]}}"/>
                </a>
              <?php $i++;?>
              @endforeach
          </div>
      </div>
      <div id="post-rigth" class="col-md-3 col-sm-3 img-responsive">
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
        <div class="col-md-3 col-sm-3 col-xs-7 div-li tex">
         Контактное лицо:
        </div> 
        <div class="col-md-9 col-sm-9 col-xs-5 tex">
         {{$post->name}}
        </div> 
 </div>  
 @if($post->privat_email==1)
  <div class="row tex">
        <div class="col-md-3 col-sm-3 col-xs-5 div-li tex">
         Email:
        </div> 
        <div class="col-md-2 col-sm-9 col-xs-7 tex">
        <button id="show-email" type="submit" class="btn btn-default" email-secret="{{Crypt::encrypt($post->email)}}">Показать Email</button>     
        </div> 
     
        <div class="col-md-3 tex">
        <button id="email-pusk-post" type="submit" class="btn btn-default">Отправить Email</button>     
        </div>   
  </div>
 @else
 <div class="row tex">
        <div class="col-md-3 div-li tex">

        </div> 
     
        <div class="col-md-3 tex">
        <button id="email-pusk-post" type="submit" class="btn btn-default">Отправить Email</button>     
        </div>   
  </div>
 
 @endif  
 
 @if(isset($post->phone))
       <div class="row phone tex">
         <div class="col-md-3 div-li tex">
        </div> 
        <div class="col-md-9 ">
        <button id="show-fone" type="submit" class="btn btn-default">Показать номер</button> 
        <img id="post-img-phone" class="img-responsive" src="/{{$post->phone}}" style="display: none"/>
        </div>
       </div>   
@endif  
<div class="row" style="height: 34px">
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
 <div class="col-md-9 tex">
    {{$post->Kroshki()}}
  </div>      
</div> 

<div id="post" class="container" >
    {{$post->post}}
</div>  
 </div>
   <input id="PostId"  name="postId" type="hidden" value="{{$post->id}}"/>
    
 
</div>

@stop