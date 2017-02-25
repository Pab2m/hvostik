<div class="post_lk col-md-12 post{{$post->id}}">
    <div class="row row-1">   
              <div id='foto_pr' class="foto_priv  col-sm-3 col-md-4">
                      {{'<img src="/'.$post->priv_img.'"/>'}}
              </div>
              <div class="text_priv  col-sm-8 col-md-7">
                 <div class="title_zag">
                 <a href="/fyurer/post/{{$post->id}}"><h3>{{$post->title}}</h3></a>
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
                  <div class="post-usser">
                      {{$post->email}}
                  </div>
             </div>
            <div class="col-sm-1 col-md-1 moder">
                    @if((Auth::check())&&(($post->id_user===Auth::user()->id)||(Auth::user()->pravo===88)))
                    <div class="div-moderator"> 
                    <a href="/post/edit/{{$post->id}}"  title="Редактировать объявления"><span class="glyphicon glyphicon-pencil"></span></a>
                    <span class="post-delete glyphicon glyphicon-remove" data-post-id="{{$post->id}}" title="Удалить объявления"></span>
                    </div>
                    @endif
            </div>
    </div>
</div>