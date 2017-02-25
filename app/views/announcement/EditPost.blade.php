@extends('template.main')
@section('title')
Редактировать объявление
@stop
@section('head')
{{HTML::script('script/jquery.maskedinput-1.2.2.js');}}
{{HTML::script('script/uploaderObject.js');}}
{{HTML::script('script/interface.js');}}
<script type="text/javascript">
   var  FUN = new Object(); 
    jQuery(function($) {
 $.mask.definitions['~']='[+-]';
$('input#phone').mask('+7(999) 999-99-99');
    });
    var root = {};
</script>
@stop
@section('content')
@if((Auth::check())&&(($post->id_user===Auth::user()->id)||(Auth::user()->pravo===88)))
<div id="edit_post" class="col-sm-11">
    <h4>Редактировать объявление "<span class="titlePost">{{$post->title}}</span>"</h4>
    <div class="row">
{{Form::open(array('action' => 'PostController@EditPost','id'=>'postEdit','files' =>true,'class'=>"form-horizontal", 'role'=>"form"))}}

{{Form::hidden('id',$post->id, ['placeholder'=>'','name'=>'id', 'class'=>"form-control", "id"=>"id"])}}

  <div id="input_name" class="form-group  has-feedback">
    <div class="col-sm-10">
      {{Form::text('name',$post->name, ['placeholder'=>'Ваше Имя','id'=>'name', 'class'=>"form-control"])}}
    </div>
  </div>


  <div id="input_email" class="form-group has-feedback">
    <div class="col-md-10">
      {{Form::text('email',$post->email, ['placeholder'=>'Ваш Email','id'=>'email','class'=>"form-control"])}}
    </div>  
  </div>

<div id="input_phone" class="form-group">
      <div class="col-sm-10">
          <img src="/{{$post->phone}}"/>
      </div>
    <div class="col-sm-10">
        {{Form::text('phone',null, ['placeholder'=>'Ваш телефон','id'=>'phone','class'=>"form-control",'class'=>"form-control"])}}
    </div>
</div>    

<div id='region' class="col-md-6 form-group has-feedback" style="display: block; clear: both;">
   <select data-placeholder="Регион" style="width:100%;" class="chosen-select" tabindex="7" id="region_select" name="region_select">
        <option value=""></option>
       {{$optionHtmlRegions;}}
  </select>
</div>

<script>  
   root.regionId = {{$post->region_select}};
</script>       

 <div id='site' class="col-md-6 form-group has-feedback" style="display: block; clear: both;">
   <select data-placeholder="Город" style="width:100%;" class="chosen-select" tabindex="7" id="sity_select" name="sity_select">
        <option value=""></option>
       {{$optionHtmlSite}}
  </select>
</div>
<script>
root.siteId = {{$post->sity_select}};
root.regionId = {{$post->region_select}};
</script> 
<div id="categorij" class="form-group has-feedback col-md-6" style="display: block; clear: both;">
   <select data-placeholder="Категория" style="width:100%;" class="chosen-select" tabindex="7" id="category_select" name="category_select">
 <option value=""></option>
 {{$optionHtmlCategory}}
   </select>
</div>
<script>
root.сategoryId = {{$post->category_select}};
</script>
@if($post->category_select == 1)
<script>    
root.porodaKoshkaId = {{$post->poroda_koshek}};  
root.tipId = {{$post->tip_select}};
@if($post->pol)
root.polId = {{$post->pol}};
@endif
@if($post->vozrast)
root.vozrastId = {{$post->vozrast}};
@endif
</script>    
@endif
@if($post->category_select == 3)
<script> 
 root.porodaSobakId = {{$post->poroda_sobak}};  
 root.tipId = {{$post->tip_select}};
 root.polId = {{$post->pol}};
 root.vozrastId = {{$post->vozrast}};
</script>     
@endif
@if($post->category_select == 11)
<script> 
 root.tipId = {{$post->tip_select}};
</script> 
@endif
@if(($post->category_select == 11) || ($post->category_select == 14))
<script> 
 root.tipId = {{$post->tovari_select}};
</script> 
@endif

    <div id="input_title" class="col-sm-10 form-group  has-feedback" >
{{Form::text('title',$post->title, ['placeholder'=>'Названия объявления','id'=>'title','class'=>'form-control'])}}
    </div>
  
<div class="form-group" >
    <div class="col-sm-10" >
 {{Form::textarea('post',$post->post, ['placeholder'=>'Описание','id'=>'post', 'class'=>'form-control', 'rows'=>'8'])}}   
    </div>
</div>  
<h4>Добавить фотографии</h4>
<div class="form-group" >
    <div class="row">
        <div class="col-md-5">   
 {{Form::file('file',['id'=>'file-field', 'class'=>'btn btn-default','multiple'=>'true','accept'=>"image/*,image/jpeg",])}}
        </div>
        <div class="col-md-7">
            <div>
         Обубликовать указанный Email:   {{Form::checkbox('privat_email', '1',true);}}
            </div>
            
 @if(Auth::user()->pravo===88)
 <div>
  Обубликовать обьявления:   {{Form::checkbox('sostoynia', '1',true);}}
 </div> 
 @endif
      </div>
    </div> 
 <div class="col-sm-10">
 
 <div class="form-group" >
    <div class="col-sm-10" >           
 <div id="img-container">
      <ul id="img-list-server">
          {{$post->CoutImgUrl()}}
      </ul>
 </div> 
    </div>
</div> 
     </div>
 <div class="col-sm-10">
 
 <div class="form-group" >
    <div class="col-sm-10" >           
 <div id="img-container">
      <ul id="img-list">

      </ul>
 </div> 
    </div>
</div> 
     </div>     
    
</div> 

 </div>
       
<div class="row">
    <div class="col-md-3"><button id='button_add' class="add btn btn-default" type="button" >Сохранить</button> </div> 
    <div class="col-md-3"><button id='button_post_delet' class="delete btn btn-default" type="button" >Удалить объявления</button> </div> 
</div>
{{Form::close()}}
</div>
{{Form::open(array("action" => "PostController@DeletPosts","id"=>"post-delete","class"=>"form-horizontal", "role"=>"form"))}}
<input type="hidden" name="delet[]" value="{{$post->id}}"/>
{{Form::close()}}
@section('footer-script')
@stop
@else
У вас нет прав редактировать данное объявления!<br>
<a href=''>Войти</a><br>
<a href=''>Зарегистрироваться</a> 
@endif
@stop


