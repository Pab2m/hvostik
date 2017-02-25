<div id="title">
 <h1>Результат поиска:</h1>
 <div id="search-data">
  
 </div>
</div>
@if(sizeof($query)!==0)
@foreach($query as $post) 
@include('announcement.annoucement-short')      
@endforeach
@else
<h4>Объявлений нет!!!</h4>
@endif
<div id="paginate">
{{$queryList}}
</div>  


     
