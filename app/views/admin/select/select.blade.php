@extends('admin.template.main')
@section('title')
Настройки системы
@stop      
@section('content')
@if((Auth::check())&& (Auth::user()->pravo===88))
 
<div id='content-left' class='col-md-9'>
 <div class="title">
     <h3>Все Select</h3>
</div>
    
    <div id="AllSelect-admin" class="row">
        <div class="col-md-3 ">
    <div id="countrys">
      <select data-placeholder="Страна" style="width: 100%; display: none;" class="chosen-select" tabindex="-1" id="countrys_select_add" name="countrys_select_add">
            <option value=""></option>
            {{$countrys}}
      </select>
   </div>
            <div class="col-md-12 selekt">
              <a class="btn btn-default" href="/fyurer/select/detail/countrys">Подробней</a>
            </div>
        </div>    
        <div class="col-md-3"> 
     <div id="region">
      <select data-placeholder="Регион" style="width: 100%; display: none;" class="chosen-select" tabindex="-1" id="region_select_add" name="region_select_admin">
            <option value=""></option>
            {{$regions}}
      </select>
   </div>
              <div class="col-md-12 selekt">
              <a class="btn btn-default" href="/fyurer/select/detail/regions">Подробней</a>
            </div>
        </div>
        <div class="col-md-3 site_select"> 
          <div id="site_select">
<select data-placeholder="Город" style="width: 100%; display: none;" class="chosen-select" tabindex="-1" id="sity_select_admin" name="sity_select_admin">
    <option value=""></option>  
</select>
          </div>
             <div class="col-md-12 selekt">
              <a class="btn btn-default" href="/fyurer/select/detail/citys">Подробней</a>
            </div>
      </div>   
      <div class="col-md-3"> 
<div id="categorij_select_admin" class=" has-feedback">
   <select data-placeholder="Категория" style="width: 100%; display: none;" class="chosen-select" tabindex="-1" id="category_select_admin" name="category_select_admin">
    <option value=""></option>
        {{$category}}
    </select>
  </div>
               <div class="col-md-12 selekt">
              <a class="btn btn-default" href="/fyurer/select/detail/category">Подробней</a>
            </div>
      </div>  
        <div class="col-md-3"> 
       <div id="cot_select" class=""> 
      <select data-placeholder="Порода кошек" style="width: 100%; display: none;" class="chosen-select" tabindex="-1" id="poroda_select_add_cot" name="poroda_koshek">
          <option value=""></option> 
          {{$cot_select}}
      </select>
           </div> 
                  <div class="col-md-12 selekt">
              <a class="btn btn-default" href="/fyurer/select/detail/poroda-koshek">Подробней</a>
            </div>
       </div>    
        <div class="col-md-3"> 
        <div id="sob_select" class=""> 
      <select data-placeholder="Порода собак" style="width: 100%; display: none;" class="chosen-select" tabindex="-1" id="poroda_select_add_sobak" name="poroda-sobak">
          <option value=""></option> 
          {{$sob_select}}
      </select>
           </div> 
            <div class="col-md-12 selekt">
              <a class="btn btn-default" href="/fyurer/select/detail/poroda-sobak">Подробней</a>
            </div>
       </div>  
        <div  class="col-md-3">
            <div id="tip">
           <select data-placeholder="Тип объявления" style="width: 100%; display: none;" class="chosen-select" tabindex="-1" id="tip_select_add" name="tip_select_add">
               <option value=""></option> 
               {{$tip}}
           </select>
              </div>
                 <div class="col-md-12 selekt">
              <a class="btn btn-default" href="/fyurer/select/detail/tip">Подробней</a>
            </div>
        </div>
         <div  class="col-md-3">
             <div id="tovari">
           <select data-placeholder="Товары для животных" style="width: 100%; display: none;" class="chosen-select" tabindex="-1" id="tovari-add" name="tovari">
               <option value=""></option> > 
               {{$tovari_select}}
           </select>
              </div>   
                     <div class="col-md-12 selekt">
              <a class="btn btn-default" href="/fyurer/select/detail/tovari">Подробней</a>
            </div>
        </div>
           <div  class="col-md-3">
               <div id="uslugi"> 
           <select data-placeholder="Услуги для животных" style="width: 100%; display: none;" class="chosen-select" tabindex="-1" id="uslugi-add" name="uslugi">
               <option value=""></option> 
               {{$uslugi_select}}
           </select>
                  </div>
               <div class="col-md-12 selekt">
              <a class="btn btn-default" href="/fyurer/select/detail/uslugi">Подробней</a>
            </div>
        </div>
    </div>
    
    
    
</div>
<div class="col-md-3" id="postAdmin"> 
    <div style="margin:15px">
   
    </div>
</div>
 
   
@else
Страница не найдина
@endif
@stop