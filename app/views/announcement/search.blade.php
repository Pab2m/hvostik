@extends('template.main')
@section('title')
Поиск 
@stop
 @section('content')
 <script id="get-search">
     var root = {};
     root.search = {};
 <?php
 echo "root.search['post'] = '".$post."';\n";
 foreach ($getData as $key=>$value){
     if($key != "post"){
     echo  "root.search['".$key."'] = ".$value.";\n";
     } 
 }
 ?>
 </script>
 <div id="title">
 <h1>Результат поиска:</h1>
 <div id="search-data">
  
 </div>
</div>
      <div id='content-left' class='col-md-12'>
     @foreach($query as $post) 
              @include('announcement.annoucement-short')  
     @endforeach
     {{$queryList;}}
      </div>

@stop
     