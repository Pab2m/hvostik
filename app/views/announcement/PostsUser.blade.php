@extends('template.main')
@section('title')
Личный кабинет
@stop
@section('content')
@if(Auth::check())
<h4>Личный кабинет,{{'  '.$email}}</h4>
<div class="row">
@if(Auth::user()->pravo===88)
<div class="col-md-2">
    <a class="a-add" href="/fyurer/"><span>Админка</span></a>
</div>    
@endif
<div class="col-md-2">
    <a class="a-add" href="/logout"><span>Выйти</span></a>
</div>   
</div>
<div id='content-left' class='col-md-12'>

  <div class="bs-example bs-example-tabs">
    <ul id="myTab" class="nav nav-tabs">
      <li class="active"><a href="#home" data-toggle="tab">Обубликованные объявления ({{count($posts_true);}})</a></li>
      <li><a href="#profile" data-toggle="tab">На модерации ({{count($posts_false);}})</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane fade in active" id="home">
  @if($posts_true instanceof Illuminate\Pagination\Paginator)   
    @foreach($posts_true as $post) 
         @include('announcement.annoucement-short')      
    @endforeach
    {{$posts_true->links();}}
    @else
    У вас нет обубликованных обьявлений! 
    @endif
     </div>
      <div class="tab-pane fade" id="profile">
 @if($posts_false instanceof Illuminate\Pagination\Paginator)          
   @foreach($posts_false as $post) 
         @include('announcement.annoucement-short')      
    @endforeach
 @else
 У вас нет не обубликованных обьявлений! 
 @endif
      </div>
    </div>
  </div>
</div>    
@section('footer-script')
<script src="/libs/bootstrap/tab.js"></script>
<script>
$('#myTab a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
})
</script>
@stop





<!--<script>
    $(function () {
        $('#button_post_right a').on('click',function(){
          $('#post_lk').css('display','none');  
          $('#second').css('display','block'); 
          $('input.delet:checked').prop('checked',false);
          $('input.delet_post').remove();
        });

       $('#button_post_left a').on('click',function(){
           $('#second').css('display','none'); 
          $('#post_lk').css('display','block');  
           $('input.delet:checked').prop('checked',false);
           $('input.delet_post').remove();
        });
    
    $('#delet_button').click(function(){
    var trueCheckbox=$("input.delet:checked");

    trueCheckbox.each(function(index,element){
     $("form#rivate_office").append("<input class='delet_post' type='hidden' name='delet[]' value='"+$(element).val()+"'>");
   
    });
    
    var trueCheckboxSize=trueCheckbox.length;
      if(trueCheckboxSize!=0){
        var deletTrue=confirm('Удалить ('+trueCheckbox.length+') объявлений(я)'); 
        if(deletTrue){ 
      $('form#rivate_office').submit();
     }
      }else{alert('Выберити объявления!');}
    });
});
</script>-->

@else
Вы не авторизированы!!!
@endif
@stop