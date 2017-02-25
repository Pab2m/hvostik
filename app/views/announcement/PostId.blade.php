@extends('template.main')
@section('head')
<!--{{HTML::script('script/jquery.fancybox/jquery.fancybox-1.2.1.js');}}
{{HTML::script('script/jquery.fancybox/jquery.fancybox-1.2.1.pack.js');}}
 {{HTML::style('script/jquery.fancybox/jquery.fancybox.css');}}-->
	<script type="text/javascript">
		$(document).ready(function() {
			$("a.img").fancybox();
                        $('button#phone_b').on('click',function(){
                           var phone='<img src="/{{$post->phone}}">';  
                         $('span#phone_s').html(phone);   
                        });
		});
	</script>
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
           <?php $img_url=$post->img_url;    ?>                   
                <a class="img"  rel="group"  href="/{{current($img_url)[0]}}">
                    <img class="img-responsive"  src="/{{current($img_url)[640]}}"/>
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
        <button id="email" type="submit" class="btn btn-default">Показать Email</button>     
        </div> 
     
        <div class="col-md-3 tex">
        <button id="email_pusk" type="submit" class="btn btn-default">Отправить Email</button>     
        </div>   
  </div>
 @else
 <div class="row tex">
        <div class="col-md-3 div-li tex">

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
        <button id="fone" type="submit" class="btn btn-default">Показать номер</button> 
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
 <div class="col-md-9 tex">
    {{$post->Kroshki()}}
  </div>      
</div> 

<div id="post" class="container" >
    {{$post->post}}
</div>  
 </div>
   <input id="PostId"  name="postId" type="hidden" value="{{$post->id}}"/>
    
<script type="text/javascript">
	    $(function() {
	$('.image').on('click', function(event) {
                event.preventDefault();
		var image = $('#image');
                var StImageW = image.outerWidth(); 
                var StImageH = image.outerHeight();

               // console.log('image= ');
                //console.log(image);
            var imageRel = $(this).attr('href');
                console.log(imageRel);
            var ImgOriginal=$(this).data('fooBar')
		image.fadeIn('slow');//.hide()
		image.html('<a class="img"  rel="group" href="'+ImgOriginal+'"><img src="' + imageRel + '" class="image img-responsive" ></a>');
                image.outerWidth(StImageW);
                image.outerHeight(StImageH);
                $("a.img").fancybox();
		return false;	
	});
        $('#fone').on('click',function(){
           $(this).parent().html('<img src="/{{$post->phone}}"/>');
        });
        $('#email').on('click',function(){
           $(this).parent().html('{{$post->email}}');
        });
});
        </script>    
</div>

@stop