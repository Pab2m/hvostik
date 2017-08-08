<?php
class UserController extends BaseController{
    
    public function login(){
     $data=Input::all();
     $rules=[
         'email'=>'required|email|min:6',
         'password'=>'required|min:6'
            ];
                
     $val=Validator::make($data, $rules);
     if($val->fails()){
         return View::make('errors.validation')->with('errors',$val->messages()->toArray());
     }
        $user=User::login($data);
        if(!$user){
             Session::flash('ErrorAvtoriz', 'Ошибка в логине или в пароли!'); 
            return Redirect::to('vhod');//$this->getMessage('Ошибка авторизации');
        }
        return  Redirect::back();
        }
        
    public function getActivate($id ,$activation_code) {
    // Получаем указанного пользователя
    $user = User::find($id);
    if (!$user) {
        return $this->getMessage("Неверная ссылка на активацию аккаунта.");
    }

    // Пытаемся его активировать с указанным кодом
    if ($user->activate($activation_code)) {
        // В случае успеха авторизовываем его
        Auth::login($user);
        // И выводим сообщение об успехе
        return $this->getMessage("Аккаунт активирован", "/");
    }
    // В противном случае сообщаем об ошибке
    return $this->getMessage("Неверная ссылка на активацию аккаунта, либо учетная запись уже активирована.");
}
    
    
    
public function register(){
        $data=Input::all();
		 foreach($data as &$value){
             $value=strip_tags($value);
        }
		$gRecaptchaResponse = $data["g-recaptcha-response"];
	$success = AjaxController::CachaGoogla($gRecaptchaResponse);
     if($success){
         $rules=[
         'email'=>'required|email|min:6|unique:users',
         'password'=>'required|min:6|same:repeat_password',
          'repeat_password'=>'required|min:6'
            ];
                
    $val= Validator::make($data, $rules);
 
     if($val->fails()){
        return View::make('errors.validation')->with('errors',$val->messages()->toArray());
     } 
    $activation_code=Str::random();
    $data['activation_code']=$activation_code; 
     $user=User::register($data);
     if(!$user instanceof Illuminate\Database\Eloquent\Model){
          return $this->getMessage('Ошибка регистрации');
     }
      
  $user->UserActivationMail();     
       return $this->getMessage("Регистрация почти завершена. Вам необходимо подтвердить e-mail, указанный при регистрации, перейдя по ссылке в письме.");     
	} else {
		return $this->getMessage('Ошибка регистрации');
}}
 
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
       $link = '<p><a href="' . $url . '?' . urldecode(http_build_query($params)) . '">Аутентификация через ВКонтакте</a></p>';
       return  $link;
    } 
 
     public static function authVk_token($code){
         $Constant= new Constant;
         $client_id = $Constant->const_vk['client_id']; // ID приложения
         $client_secret = $Constant->const_vk['client_secret']; // Защищённый ключ
         $redirect_uri = $Constant->const_vk['redirect_uri']; // Адрес сайта
         
        if (isset($code)) {
    $params = array(
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'code' => $code,
        'redirect_uri' => $redirect_uri
    );

    $token = json_decode(file_get_contents('https://oauth.vk.com/access_token' . '?' . urldecode(http_build_query($params))), true);
   // dd($token);
    
      if (isset($token['access_token'])) {
	        $params = array(
	            'uids'         => $token['user_id'],
	            'fields'       => 'uid,first_name,last_name,screen_name,sex,bdate,photo_big',
	            'access_token' => $token['access_token']
      );}	    
      
        if (isset($token['access_token'])) {
	   $params = array(
	   'uids'    => $token['user_id'],
	   'fields'  => 'uid,first_name,last_name,screen_name,sex,bdate,photo_big',
	   'access_token' => $token['access_token']);
	 
	     $userInfo = json_decode(file_get_contents('https://api.vk.com/method/users.get' . '?' . urldecode(http_build_query($params))), true); 
                   
             if(isset($userInfo)){
                  $users_email=User::users_email($token['email']);
                  $users_avt_soz=UsersAvtSoz::users_avt_soz_email_access_token($token['email']);             
                  if(($users_email!==NULL)&&($users_avt_soz['email']===NULL)){
                      $str="Ваш почтовый ящек ".$token['email']." уже зарегистрирован на нашем сайти.<br> Подалуста войдите напримую.";
                       Session::flash('str',$str);
                      return Redirect::route('home'); 
                      
                  }elseif(($users_email===NULL)&&($users_avt_soz['email']===NULL)){
                      $data=array('password'=>time(),'email'=>$token['email'],'activation_code'=>'','active'=>0);
                      $user=User::register($data);
                      $data=array('id_users'=>$user->id,'soz_set'=>'vk.com','access_token'=>$token['access_token'],
                          'expires_in'=>$token['expires_in'],'user_id'=>$token['user_id'],'email'=>$token['email']);
                     $user_soz=UsersAvtSoz::users_register_soz($data);
                     $user->users_soz_password($user,$data['access_token'],$user_soz->id);
                     $user_soz->UsersAvtSoz_mail($Constant->url);
                     
                     $str="Вы зашли на сайт как ".$user->email."!";
                     Session::flash('str',$str);
                   return Redirect::route('home');
                   
                  }elseif($users_email===$users_avt_soz['email']){   
                      User::user_password($token['email'],$token['access_token']);
                      
                      $user=User::login(array('email'=>$token['email'],'password'=>$token['access_token']));
                       if($user instanceof User){
                        
                          $array_ubdata = array('access_token'=>$token['access_token'],'expires_in'=>$token['expires_in']);
                          $user->users_soz_password_ubdata($user->id,$array_ubdata);
                         $str="Вы зашли на сайт как ".$user->email."!";
                           Session::flash('str',$str);
                         
                       return  Redirect::route('home');
                      }else{
                           $str="Что-то пошло не так !";
                           Session::flash('str',$str);
                           return  Redirect::route('vhod');
                      }
                  }
              }
                 }
     }
     
        }
    public static function UserAccess($id_user_controler = false){
        if (!Auth::check()) {
           return View::make('errors.message', array('message'=>'Вы не авторизованы!!!','redirect'=>'/vhod')); 
        } if ($id_user_controler  !== false){
        if(!(($id_user_controler === Auth::user()->id)||(Auth::user()->pravo===88))){ 
           return View::make('errors.message', array('message'=>'У Вас недостаточно прав!!!','redirect'=>false));
        } } 
    }
    
}
