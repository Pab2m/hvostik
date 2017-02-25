@if((Auth::check())&& (Auth::user()->pravo===88))
    @include('admin.template.header')
<div class="container-fluid">
<div class="row main-body">
     <div class="col-sm-3 col-md-2 main">   
       @include('admin.template.left')
     </div>
       
    <div class="col-sm-9  col-md-10  main">
    @yield('content')
    </div>   
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
</div>
    @include('template.footer')
@else

@endif