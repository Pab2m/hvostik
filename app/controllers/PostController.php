<?php
class PostController extends BaseController {
    
    public function add(){
        if(Auth::check()){
         return View::make('announcement.add', array('optionHtmlRegions'=>$this->optionHtmlRegion(), 'optionHtmlCategory'=>$this->optionHtmlCategory(true)));
        }else{
            Session::flash('ErrorAvtoriz', 'Для подачи объявления необходимо авторизироваться !'); 
            return View::make('vhod');//$this->getMessage('Ошибка авторизации');
            }
  }
    
  private static function ValidatePost($data){
        $rules = array('name' => 'required',
                       'email'=>'required|email',
                       'title'=>'required',
                       'post'=>'required');     
         $messages = array(
               'name' => 'Вы некоректно ввели имя',
               'email' => 'Вы некоректно ввели E-mail',
               'title' => 'Введите названия объявления',
               'post' => 'Введите описание объявления',
                                                        );
         $validator=Validator::make($data, $rules, $messages); 
         $False['name']=$False['email']=$False['region_select']=$False['sity_select']= $False['category_select']=false;
         if(isset($data['name'])){
             $False['name']=true;
         }
         if(isset($data['email'])){
             $False['email']=true;
         }
         if(isset($data['phone'])){
             $False['phone']=true;
         }
         if(isset($data['region_select'])){
             $False['region_select']=true;
         }
         if(isset($data['sity_select'])){
             $False['sity_select']=true;
         }
          if(isset($data['category_select'])){
          $False['category_select']=true;
          
          if((isset($data['poroda_koshek'])) && ($data['category_select']==1)){
          $False['poroda_koshek']=$False['tip_select']=false;  
              if(isset($data['poroda_koshek'])){
              $False['poroda_koshek']=true;}
              if(isset($data['tip_select'])){
              $False['tip_select']=true;}
          }elseif((isset($data['poroda_sobak']))&&($data['category_select']==3)){
              if(isset($data['poroda_sobak'])){
              $False['poroda_sobak']=true;}

              if(isset($data['tip_select'])){
              $False['tip_select']=true;}
          }elseif($data['category_select']===11){
               $False['uslugi_select']=false;
               if(isset($data['category_select'])){
                $False['uslugi_select']=true;
               }
          }elseif($data['category_select']===14){
              $False['tovari_select']=false;
            if($data['tovari_select']){
              $False['tovari_select']=true;
              }
              }
          }
          foreach ($False as $value){
              if($value == false){
               return $this->getMessage('Ошибка!!! Возможно одно из полей незаполнино');   
              }
          }
        return true;  
  }  

  

  public function postAdd(){
            if(Auth::check()){ 
            $data=Input::all();
            unset($data['file']);
            $data['id_user']=Auth::user()->id;
          
          PostController::ValidatePost($data);
          
          if(isset($data['img'])&&($data['img']!==0)){  
          $data['img_url']=Post::PostImgSeve($data['img'], $data['id_user']);
          unset($data['img']);
         // $data['priv_img']=$data['img_url'][0][240];
          $data['priv_img']=Post::PriveiFoto($data['img_url'][0][0], $data['id_user']);
          $data['img_url']=serialize($data['img_url']);
          }else{$data['priv_img']='images_post/hvostuk240x200.png';}
          
        if($data['phone']){
        $e=Post::PhoneImg($data['phone'],$data['id_user']);
        }else{$e='';}
        
       foreach($data as &$value){
             $value=strip_tags($value);
        }
        if($e){
        $data['phone']=$e;}else{unset($data['phone']);}
        $Post=Post::create($data);
  //     dd($Post);
        $Post->MailPostAdd();
        if(Auth::user()->pravo===88){
        $Post->sostoynia=1;  }
        $Post-> id_user = Auth::user()->id;
        $Post->save();
        $redirect = Redirect::route('announcement_goot',array('title'=>$data['title']));
        
          return $redirect;  
          }
            else 
                return $this->getMessage('Вы не авторизованы!!!');
        }
        
public function AddTrue($title){      
     return View::make('announcement.true',array('title'=>$title));
}


public function str_size($str,$length)
               { $str = iconv("UTF-8","windows-1251", $str); $str = substr($str, 0, $length); $str = iconv("windows-1251", "UTF-8", $str); $str .= "..."; return $str;
              }
      
public  function PostsUser(){
          if(Auth::check()){
          $posts_true=Post::PostsUser(1);
          $posts_false=Post::PostsUser(0);
                 
      return View::make('announcement.PostsUser', array('email'=>Auth::user()->email,'posts_true'=>$posts_true,'posts_false'=>$posts_false));
          }else {
              
       return Redirect::to('/vhod');}
}
      
public function DeletPosts(){
         $data=Input::all(); 
         if(isset($data['delet'])){return Post::deletePost($data['delet']);}
     }
      
public function EditPostMake($id, $maket='announcement.EditPost'){ 
    $post=Post::IdPost($id);
    if(!$post instanceof Post){
    $post = new Post;   }
    if( (Auth::check())&&(($post->id_user===Auth::user()->id)||(Auth::user()->pravo===88)) && (isset($post->id))){
   $select_site='<option value=""></option>  '.$this->optionHtmlSity($post->region_select);
return View::make($maket,array('post'=>$post,'optionHtmlRegions'=>$this->optionHtmlRegion(), 'optionHtmlCategory'=>$this->optionHtmlCategory(true), 'optionHtmlSite'=>$select_site,'BaseController' => new BaseController));
    }
return  $post->getMessage('Упс ошибка!!!','/private_office');}
    

public function EditPost(){
            $data=Input::all(); 
            $post=Post::IdPost($data['id']);
            $data['id_user']=Auth::user()->id;
            if((Auth::check())&&(($data['id_user']===$post->id_user)|| Auth::user()->pravo===88)){ 
                
         PostController::ValidatePost($data);
          //Удаление уже имеющихся на сервере картинок  
  if((isset($data['deletImg']))||(isset($data['img']))) { 

   $url_img=unserialize($post->img_url);   
  
   $Img=array();
   //.* Фото для удаления
    if((isset($data['deletImg']) && (gettype($data['deletImg'])=='array') ) ){
        $Img=Post::DeleteImg($data['deletImg'],$url_img);//Img=ImgDelete
        unset($data['deletImg']);
    } else{
        if($url_img!==false){
        $Img=$url_img; }    
      unset($url_img);
     }
  //Фото для удаления *\ 
    //$data['img'] -- подгружаймые фото 
    if(isset($data['img'])){
       $data['img_url']=array_merge($Img, Post::PostImgSeve($data['img'], $data['id_user'])); 
    } else if(count($Img)!=0){$data['img_url']=$Img;} 
    else {$data['img_url']=array();}
    if(count($data['img_url'])!==0){
        $data['priv_img']=Post::PriveiFoto(current($data['img_url'])[0], $data['id_user']);
    } else {   
            $data['priv_img']='images_post/hvostuk240x200.png'; 
    }
    if(count($data['img_url']) !==0 ){
    $data['img_url']=serialize($data['img_url']);
    } else {$data['img_url'] = '';}
  }
  unset($data["file"]); 
  unset($data["img"]);

          foreach($data as &$value){
             $value=strip_tags($value);
        }
    if($data['phone']){
        if($post->phone){
        unlink($post->phone);}
        $data['phone']=Post::PhoneImg($data['phone'],$data['id_user']);
        }else{unset($data['phone']);}
         unset($data['id_user']); unset($data['file']);
         if((Auth::user()->pravo===88)&&(isset($data['sostoynia'])&&($data['sostoynia']==1))){
             $post->sostoynia = 1; 
             $post->save();}
         else{$post->sostoynia = 0; $post->save();}
         if((isset($data['admin_panel'])&&($data['admin_panel']==true))){
             $redirect=Redirect::route('announcement_admin_goot',array('id'=>$data['id'])); 
         }else{
         $redirect = Redirect::route('announcement_goot',array('title'=>$data['title']));    } 
         unset($data['admin_panel']);
        $post -> guardedNULL();// Заполняем NULL поля перед изменениями
        $post -> update($data);
         return $redirect;  
         }else return $this->getMessage('Вы не авторизованы!!!');   
}


public function PostId($id){ 
   $post=Post::IdPost($id);
    if($post instanceof Post){
        $post->prosmotry=++$post->prosmotry;
        $post->save();
    if($post->img_url){
        $post->img_url=unserialize($post->img_url);
    }         
    return View::make('announcement.PostId',array('post'=>$post));}
    else{
        return $this->getMessage('Страница ненайдина!!!');
    }
       }
    
public function addImg(){
    $data=Input::all();
return Post::PostImgSeveTmp($data);
}

public function StaticPage($url){
    $staticpage = Staticpage::StaticpageUrl($url);
    if($staticpage!==0){
        return View::make('staticpage.staticpage',array('staticpage'=>$staticpage)); 
    }else{
        return $this->getMessage('Страница ненайдина!!!');;
    }
}
  
}

