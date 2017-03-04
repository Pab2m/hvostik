<!DOCTYPE HTML>
<!--[if lt IE 7]><html lang="ru" class="lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if IE 7]><html lang="ru" class="lt-ie9 lt-ie8"><![endif]-->
<!--[if IE 8]><html lang="ru" class="lt-ie9"><![endif]-->
<!--[if gt IE 8]><!-->
<html lang='ru'>
<!--<![endif]-->
  <head>  
      <meta charset="utf-8" />	
	<meta name="description" content="" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="shortcut icon" href="favicon.png" />
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <script src="/script/yepnope.js"></script>
        <script src="/js/chosen.jquery.min.js"></script>
        {{HTML::script('/script/main.js');}}
	<link rel="stylesheet" href="/libs/font-awesome-4.2.0/css/font-awesome.min.css" />
	<link rel="stylesheet" href="/libs/fancybox/jquery.fancybox.css" />
	<link rel="stylesheet" href="/libs/owl-carousel/owl.carousel.css" />
	<link rel="stylesheet" href="/libs/countdown/jquery.countdown.css" />
        <script src="/script/prefixfree.min.js"></script>
        <link rel="stylesheet" href="/libs/chosen.css" />
	<link rel="stylesheet" href="/css/fonts.css" />
         <link rel="stylesheet" href="/css/bootstrap.css" />
	<link rel="stylesheet" href="/css/main.css" />
	<link rel="stylesheet" href="/css/bootstrap_skin.css" />
	<link rel="stylesheet" href="/css/media.css" />  
         
@yield('head')
<title>@yield('title') - бесплатная доска объявлений о животных</title>
</head>  
    
<body>
    <div id="panel-annoucement" class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="col-md-4">
          <span class="navbar-brand" href="#">Панель управления объявлениями</span>
        </div>
        <div class="col-md-4">
          <ul class="nav navbar-nav">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Обьявления выбранные для удаления <span id="post-del-size"></span> <b class="caret"></b></a>
            </li>
          </ul>
                 </div>
          <div class="col-md-4 bbb">
        {{Form::open(array('action' => 'PostController@DeletPosts','id'=>'delete-posts','class'=>"form-horizontal dropdown-toggle", 'role'=>"form"))}}
            <button type="button" class="btn btn-default  allDelet">Удалить</button>
            <button type="button" class="btn btn-default allNone">Отменить</button>
        {{Form::close()}}
          </div>
      </div>
        
    </div>
    
    <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Название модали</h4>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
        <button type="button" class="btn btn-primary">Сохранить изменения</button>
      </div>
    </div>
  </div>
</div>
    
<div id="head-100" class="container-fluid">
<div class='container'>
  <div class="row">
      <div id="header-left" class="col-md-9">
          <div id="header-1" class="row">
              <div class="col-md-6">
                  <h1>Доска объявлений о животных</h1>
                  <div id="rukidobra">
                            <img src="/img/logo.jpg" />
                  </div> 
              </div>   
            <div class="row">  
                <div class="col-md-6">
                @if(Auth::check())    
                    <div id="user">
                        Вы зашли как <span>{{Auth::user()->email}}</span>
                    </div>
                @else
                    <div id="users-vhod">
                        <div class="col-md-6"><a href="/vhod">Войти на сайт</a></div>
                        <div class="col-md-6"><a href="/registration">Зарегистрироваться</a></div>
                    </div> 
                @endif
                </div>     
              <div  class="col-md-3">
              <div id="private_kabinet">  
                    <a id="a_add" href="/private_office">
                        <span>
                            Личный кабинет
                        </span>
                    </a>
                </div>   
              </div> 
              <div class="col-md-3">
                 <div id="add_obivlenij">  
                    <a id="a_add" href="/add_announcement">
                        <span>
                            Подать обьявления
                        </span>
                    </a>
                </div>    
              </div>         
         </div>
          </div>
          
        <div id="nav" class="row">
    <div class='col-md-2 nav-2'>
        <a href="/">
            <span>
            Главная
            </span>
        </a>
    </div>
    <div class='col-md-2 nav-2'>
         <a href="/">
            <span>
                <img src="/img/kote.png"/>
                Кошки
            </span>
        </a>
    </div>
    <div class='col-md-2 nav-2'>
        <a href="/">
            <span>
                <img src="/img/doc.png"/>
                Собаки
            </span>
        </a>
    </div>
    <div class='col-md-2 nav-2'>
        <a href="/">
            <span>
                <img src="/img/kost.png"/>
               Товары
            </span>
        </a>
    </div>
    <div class='col-md-2     nav-2'>
        <a href="/">
            <span>
                <img src="/img/usluci.png"/>
               Услуги
            </span>
        </a>
    </div>
   
</div>  
   </div>        
{{Form::open(array('action' => array('SearchController@searchData', 'get'),'id'=>'formSearch','class'=>"form-horizontal", 'role'=>"form", "method"=>"get"))}}       
<div id='search' class="col-md-9">
    <div class="col-xs-10">
   <input type="text" name="textsearch" id="text">
    </div>
    <div class="col-xs-2">
        <div id="button-search">
            <span class='naiti_text'>Найти</span>
            <span class='naiti_img'><img src="img/search.png"></span>
        </div>
    </div>
</div>         
      
 
<div id='select' class="row col-xs-11">
   <div id="searc_region" class='col-md-3'>
      <select data-placeholder="Регион" style="width:250px;" class="chosen-select" tabindex="7" id="region_select_search" name="region_select">
           <option value=""></option>
            
      </select>
   </div>
    <div id="searc_category"  class='col-md-3'>
     <select data-placeholder="Категория" style="width:250px;" class="chosen-select" tabindex="7" id="category_select_search" name="category_select">
     <option value=""></option>
 
     </select>
   </div> 

</div>
</form>
  </div>   
      <div id="header-right" class="col-md-3">
          
      </div> 
</div>
</div>    