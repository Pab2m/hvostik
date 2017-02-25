<?php

class HomeController extends BaseController {

    public function index() {
        if((isset($_GET['code']) && ($_GET['code']))){
            return Redirect::to('/user/auth/vk/'.$_GET['code']);
        }else{
   $post_all=Post::AllPost();     
    return View::make('home', array('post_all'=>$post_all,'title_content'=>'Все объявления'));}
    
        }

        public static function authVk(){
 
      $Constant= new Constant;
         $client_id = $Constant->const_vk['client_id']; // ID приложения
         $client_secret = $Constant->const_vk['client_secret']; // Защищённый ключ
         $redirect_uri = $Constant->const_vk['redirect_uri']; // Адрес сайта
    $url = 'http://oauth.vk.com/authorize';

	$params = array(
	    'client_id'     => $client_id,
	    'redirect_uri'  => $redirect_uri,
	    'response_type' => 'code',
            'scope'=>          'email,status');
       $link = $url.'?'.urldecode(http_build_query($params));
       return  $link;
    } 
    
        
}
