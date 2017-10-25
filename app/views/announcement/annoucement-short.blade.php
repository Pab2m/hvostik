<div class="post_lk  post{{$post->id}}">
            <div class="row">
              <div class="title-annoucement">    
                 <div class="post-a-h3" style="">
                     <a href="/post/{{$post->id}}"><h3>{{$post->title}}</h3></a>
                 </div>
                 <div class="moder-user-post">
                    @if((Auth::check())&&(($post->id_user===Auth::user()->id)||(Auth::user()->pravo===88)))
                    <div class="div-moderator"> 
                    <a href="/post/edit/{{$post->id}}"  title="Редактировать объявления"><span class="glyphicon glyphicon-pencil"></span></a>
                    <span class="post-delete glyphicon glyphicon-remove" data-post-id="{{$post->id}}" title="Удалить объявления"></span>
                    </div>
                    @endif
                 </div>
                 </div> 
              <div class="foto_priv col-xs-3 col-md-3">
                  <a href="/post/{{$post->id}}"> {{'<img class="img-responsive" src="/'.$post->priv_img.'"/>'}}</a>
              </div>
              <div class="text_priv  col-sm-9 col-md-9 col-xs-12">
                 <div class="title_zag">
                 <div class="pyti_post">
                     {{$post->Kroshki()}}
                 </div>
                 <div class="site">
                     Город:  {{$post->RegionsName()}}, {{$post->CitysName()}}
                 </div>
                 </div>
                    <div class="text_post">
                        {{$post->DateVchera($post->created_at, false)}}
                    </div>  
             </div>
            </div>    
</div>