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
	<link rel="stylesheet" href="/libs/font-awesome-4.2.0/css/font-awesome.min.css" />
	<link rel="stylesheet" href="/libs/fancybox/jquery.fancybox.css" />
	<link rel="stylesheet" href="/libs/owl-carousel/owl.carousel.css" />
	<link rel="stylesheet" href="/libs/countdown/jquery.countdown.css" />
        <script src="https://raw.githubusercontent.com/LeaVerou/prefixfree/gh-pages/prefixfree.min.js"></script>
        <link rel="stylesheet" href="/libs/chosen.css" />
	<link rel="stylesheet" href="/css/fonts.css" />
         <link rel="stylesheet" href="/css/bootstrap.css" />
	<link rel="stylesheet" href="/css/main.css" />
         <link rel="stylesheet" href="/css/a-main.css" />
	<link rel="stylesheet" href="/css/bootstrap_skin.css" />
	<link rel="stylesheet" href="/css/media.css" />  
        <link rel="stylesheet" href="/css/pikaday.css" /> 
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
        <script src="/js/chosen.jquery.min.js"></script>
        <script src="/script/yepnope.js"></script>
        <script src="/script/moment.js"></script>
        <script src="/script/pikaday.min.js"></script>
        <script src="/script/moment.js"></script>
        {{HTML::script('/script/main.js');}}
          
@yield('head')
        {{HTML::script('/script/a_main.js');}}
<title>@yield('title') - hvostyk.ru</title>
</head>  
 <body>
 <!--   <div id="navebar" class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Админ панель</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/fyurer/">Админ панель</a>
          <a class="navbar-brand" href="/">Главная</a>
          <a class="navbar-brand" href="/fyurer/posts/0">Объявления на модерации (<span id="sost0">{{Post::PostCount(0)}}</span>)</a>
          <a class="navbar-brand" href="/fyurer/posts/1">Обубликованные (<span id="sost1">{{Post::PostCount(1)}}</span>)</a>
          <a class="navbar-brand" href="/fyurer/posts/2">Снятые объявления (<span id="sost2">{{Post::PostCount(2)}}</span>)</a>
          <a class="navbar-brand" href="/fyurer/posts/3">Объявления на удаление(<span id="sost3">{{Post::PostCount(3)}}</span>)</a>
          <a class="navbar-brand" href="/fyurer/users/">Пользователи ({{User::UserCount(3)}})</a>
        </div>
      </div>
    </div>
     -->
  <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button  type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Админ панель</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a id="gormon-menu" class="navbar-brand" href="#">Админ панель</a> 
        </div>
        <div class="collapse navbar-collapse">
          <ul  class="nav navbar-nav">
            <li class=""> <a class="navbar-brand" href="/fyurer/">Админ панель</a></li>
             <li><a class="navbar-brand" href="/">Главная</a></li>
             <li><a class="navbar-brand" href="/fyurer/posts/0">Объявления на модерации (<span id="sost0">{{Post::PostCount(0)}}</span>)</a></li>
             <li><a class="navbar-brand" href="/fyurer/posts/1">Обубликованные (<span id="sost1">{{Post::PostCount(1)}}</span>)</a></li>
             <li><a class="navbar-brand" href="/fyurer/posts/2">Снятые объявления (<span id="sost2">{{Post::PostCount(2)}}</span>)</a></li>
             <li><a class="navbar-brand" href="/fyurer/posts/3">Объявления на удаление(<span id="sost3">{{Post::PostCount(3)}}</span>)</a></li>
             <li><a class="navbar-brand" href="/fyurer/users/">Пользователи ({{User::UserCount(3)}})</a></li>
            
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>