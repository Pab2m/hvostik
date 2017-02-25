@extends('admin.template.main')
@section('title')
Мой фурар - Редaктировать объявления
@stop

@section('content')
@if((Auth::check())&& (Auth::user()->pravo===88))
<body>
    <h1>Админ панел Хвостик</h1>
<!--    http://codepen.io/Brejkish/pen/ojOGEJ-->
<p id='admin-name'>Вы зашли как - {{Auth::user()->email}} </p>
<article>
  <nav class="btn-bar nav-light">
    <a href="#" class="btn btn-glass">
      Все обьявления
    </a>
    <a href="#" class="btn btn-glass btn-primary">
      <i class="fa fa-fw fa-lg fa-chevron-right"></i> Primary
    </a>
    <a href="#" class="btn btn-glass btn-success">
      <i class="fa fa-fw fa-lg fa-check"></i> Success
    </a>
    <a href="#" class="btn btn-glass btn-warning">
      <i class="fa fa-fw fa-lg fa-exclamation "></i> Warning
    </a>
    <a href="#" class="btn btn-glass btn-danger">
      <i class="fa fa-fw fa-lg fa-times"></i> Danger
    </a>
    <a href="#" class="btn btn-glass btn-info">
      <i class="fa fa-fw fa-lg fa-info "></i> Info
    </a>
  </nav>
</article>

<article>
  <nav class="btn-bar nav-dark">
    <a href="#" class="btn btn-glass">
      Default
    </a>
    <a href="#" class="btn btn-glass btn-primary">
      <i class="fa fa-fw fa-lg fa-chevron-right"></i> Primary
    </a>
    <a href="#" class="btn btn-glass btn-success">
      <i class="fa fa-fw fa-lg fa-check"></i> Success
    </a>
    <a href="#" class="btn btn-glass btn-warning">
      <i class="fa fa-fw fa-lg fa-exclamation "></i> Warning
    </a>
    <a href="#" class="btn btn-glass btn-danger">
      <i class="fa fa-fw fa-lg fa-times"></i> Danger
    </a>
    <a href="#" class="btn btn-glass btn-info">
      <i class="fa fa-fw fa-lg fa-info "></i> Info
    </a>
  </nav>
</article>
<!--<article>
  <section>
    Are you sure you want to delete <code>somefile.txt</code>?
  </section>
  <nav class="btn-bar nav-light">
    <a href="#" class="btn btn-glass btn-success">
      <i class="fa fa-fw fa-lg fa-check"></i> Ok
    </a>
    <a href="#" class="btn btn-glass btn-danger">
      <i class="fa fa-fw fa-lg fa-times"></i> No
    </a>
  </nav>
</article>-->

<article>
    
  <section>
  
     <div id="content">
<h4>Редaктировать объявления "{{$post->title}}"</h4>
{{Form::open(array('action' => array('PostController@EditPost'),'id'=>'add','files' =>true))}}

<ul id="list_input">
<li id="name"><span class="label_span">Ваше имя</span>{{Form::text('name',$post->name, ['placeholder'=>'Имя','id'=>'name_add'])}}</li>
<li id="email"><span class="label_span">Электронная почта</span>{{Form::text('email',$post->email, ['placeholder'=>'E-mail','id'=>'email_add'])}}</li>
 <li><span class="label_span">Телефон</span>{{Form::text('phone',null, ['placeholder'=>'Телефон','id'=>'phone'])}}</li>
 <!--<li>{{Form::select('size', array('L' => 'Большой', 'S' => 'Маленький'))}}</li>-->
 <li id="region"><span class="label_span">Регион</span>
  <select data-placeholder="Регион" style="width:350px;" class="chosen-select" tabindex="7" id="region_select_add" name="region_select_add">
            <option value=""></option>
            {{$optionHtmlRegions;}}
  </select>
</li>
<li id="site"><span class="label_span">Город</span>
    <select data-placeholder="Город" style="width:350px;" class="chosen-select" tabindex="7" id="sity_select_add" name="sity_select_add">
       {{$optionHtmlSite}}    
  </select>
</li>
<li id="category"><span class="label_span">Категория</span>
    <select data-placeholder="Категория" style="width:350px;" class="chosen-select" tabindex="7" id="category_select_add" name="category_select_add">
<option value=""></option>
  {{$optionHtmlCategory}}
</select>
</li>
 </ul>

<ul id='list_input2'>
 <li id='li_title'><span class="label_span">Названия объявления</span>{{Form::text('title',$post->title, ['placeholder'=>'Названия объявления','id'=>'title'])}}</li>
 <li id='li_post'><div id="li_post_div">
     <div id="li_post_div_left">
     <span class="label_span">Описание объявления</span>
     </div>
     <div id="li_post_div_right">    
     {{Form::textarea('post',$post->post, ['placeholder'=>'Описание','id'=>'post'])}}
      </div>
                    </div>
 </li>
  <li id='li_image'>   
<span class="label_span label_span_margin">Фотографии</span>
 <div class='upload-field-customized'>
 {{Form::file('file',['id'=>'file-field','multiple'=>'true','accept'=>"image/*,image/jpeg"])}}
  <span>
    <img src="/images/add_foto.png" alt="" />
  </span>
</div>
 </li>

<li> <div id="img-container">
      <ul id="img-list">
          
      </ul>
 </div></li>
 @if(Auth::user()->pravo==88)
 <li> Обубликовать обьявления:   {{Form::checkbox('sostoynia', '1',false);}}</li>
 @endif
   <?php
   if($post->img_url){
   echo '<ul id="ul_li_delet">';
   $img_url=unserialize($post->img_url); $i=0;
   foreach($img_url as $img_url1){
   echo '<li class="li_delet"><img src="/'.$img_url1[240].'"><div class="deletImg_ser" data-foo-bar="'.$i.'"  >Удалить</div></li>';
   $i++;
  }
  echo '</ul>';
   }
   ?>  
 <input id='id' type="hidden" value="{{$post->id}}" name='id'>
 <input id='admin_panel' type="hidden" value=true name='admin_panel'>
 
 <li><div id="button_seyv" class="add"></div></li>
 </ul>

{{Form::close()}}
</div> 
      
  </section>
  <nav class="btn-bar nav-dark">
    <a href="" class="btn btn-glass btn-success save">
      <i class="fa fa-fw fa-lg fa-check"></i> Сохранить и обубликовать 
    </a>
    <a href="#" class="btn btn-glass btn-danger">
      <i class="fa fa-fw fa-lg fa-times"></i> Reject
    </a>
    <a href="#" class="btn btn-glass btn-info">
      <i class="fa fa-fw fa-lg fa-code"></i> Diff
    </a>
  </nav>
</article>
<script>
    $(document).ready(function(){
    var BdRegion=$('li#region select#region_select_add option[value="{{$post->region_select_add}}"]');
    BdRegion.attr("selected", "selected");
    $('div#region_select_add_chosen  span').text(BdRegion.text());
    var BdSity=$('li#site select#sity_select_add option[value="{{$post->sity_select_add}}"]');
    BdSity.attr("selected", "selected");
    $('div#sity_select_add_chosen  span').text(BdSity.text());
    var BdCategory=$('li#category select#category_select_add option[value="{{$post->category_select_add}}"]');
    BdCategory.attr("selected", "selected");
    $('div#category_select_add_chosen span').text(BdCategory.text());
        
	var typeValue=BdCategory.val();
        var url_ajax=null;
        if(typeValue==1){
            url_ajax='poroda_koshek'; 
        } else
        if(typeValue==3){
            url_ajax='poroda_sobak';
        } else 
        if((typeValue==11)){
            url_ajax='uslugi_select';
        }  else
        if(typeValue==14){
            url_ajax='tovari_select';
        } else 
        if(typeValue==16){
            url_ajax='drugii_jivotnih';
        }
    var str='/ajax/type/'+url_ajax;

          $.ajax({
          url: str,
          success: function(data) {
        //  $('li#divPoroda').html(data);
        if(data){
          $("#list_input").append("<li id='divPorod'>"+data+"</li>");
          Selekt_poisk();
          
@if(($post->category_select_add==1)||($post->category_select_add==3))
 // alert('Сработола {{$post->category_select_add}}');  
             <?php
             if(isset($post->poroda_koshek)){
               $poroda=$post->poroda_koshek;
             }elseif(isset($post->poroda_sobak)){
               $poroda=$post->poroda_sobak; 
             }elseif(isset($post->poroda_sobak)){
                 
             }
             ?>                              
          var BdPoroda=$('li#divPorod select#poroda_select_add option[value="{{$poroda}}"]');
          //console.log(BdPoroda);
          BdPoroda.attr("selected", "selected");
          $('div#poroda_select_add_chosen span').text(BdPoroda.text())
         
         var BdPol=$('span#pol input[value="{{$post->pol}}"]');
         
         BdPol.attr("checked","checked");
         
         var BdVozrast=$('span#vozrast input[value="{{$post->vozrast}}"]');
         BdVozrast.attr("checked","checked");
           var str='/ajax/tip';
            
          $.ajax({
         url: str,
         success: function(data) {
         // $('li#divPoroda').html(data);
         $("li.cena").remove();
         $("li#li_tip").remove();
          $("#list_input").append("<li id='li_tip'>"+data+"</li>");
          Selekt_poisk();
           
          var BdTip=$('li#li_tip select#tip_select_add option[value="{{$post->tip_select_add}}"]');
          console.log(BdTip);
          BdTip.attr("selected", "selected");
          $('div#tip_select_add_chosen span').text(BdTip.text());
@if($post->tip_select_add==7)
          $("#list_input").append('<li class="cena"><input id="cena_add"  placeholder="Цена" name="cena" value="{{$post->cena}}"></li>');
@endif 
}
                });
@else
@if($post->category_select_add==11)
          var BdUslugiTip=$('li#divPorod select#uslugi_select_add option[value="{{$post->uslugi_select_add}}"]');
          console.log(BdUslugiTip);
          BdUslugiTip.attr("selected", "selected");
          $('div#uslugi_select_add_chosen span').text(BdUslugiTip.text());
              
@else
@if($post->category_select_add==14)
          var BdTovariTip=$('li#divPorod select#tovari_select_add option[value="{{$post->tovari_select_add}}"]');
          console.log(BdTovariTip);
          BdTovariTip.attr("selected", "selected");
          $('div#tovari_select_add_chosen span').text(BdTovariTip.text());

@endif
@endif

@endif      
           
         }}
                });
                

    });
    
</script>
</body>    
@else
Страница ненайдина
@endif
@stop