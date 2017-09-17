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
 
</div>
    @include('template.footer')
@else

@endif