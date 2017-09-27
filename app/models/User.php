<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';
        public static $unguarded=true;

        /**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');
        
        public static function login($data){
            
          if(Auth::attempt(['email'=>$data['email'], 'password'=>$data['password']])){
              
              return Auth::user();
          }else{
              return false;
          }  
            
        }
                public static function register($data){
            
             try{
                $user=User::create([
                   'email'=>$data['email'],
                   'password'=> Hash::make($data['password']),
                   // 'password'=> $data['password'],
                    'activation_code'=>$data['activation_code']
                ]);
               
                
             }
             catch(Exception $e){
             return $e;
             }
             return $user;
       
          }  
            
          
        public function UserActivationMail(){
         $activation_url = action(
        'UserController@getActivate',
        array(
            'id' =>$this->id,
            'activation_code' =>$this->activation_code,
             )
    );
            $that = $this;
         Mail::send('emails.activation',
        array('activation_url' => $activation_url),
        function ($message) use($that) {
            $message->to($that->email)->subject('Спасибо за регистрацию!');
        }
    );
        }
          
    public function activate($activation_code) {
    // Если пользователь уже активирован, не будем делать никаких
    // проверок и вернем false
    if ($this->active) {
        return false;
    }
 
    // Если коды не совпадают, то также ввернем false
    if ($activation_code!=$this->activation_code) {
        return false;
    }
 
    // Обнулим код, изменим флаг isActive и сохраним
    $this->activation_code = '';
    $this->active = true;
    $this->save();
 
    // И запишем информацию в лог, просто, чтобы была :)
   // Log::info("User [{$this->email}] successfully activated");
 
    return true;
}

public function AuthVk(){

$client_id = '5165245'; // ID приложения
$client_secret = 'uNS72lOYaP9IPrdZSlhV'; // Защищённый ключ
$redirect_uri = 'http://hvostik'; // Адрес сайта

    
    $url = 'http://oauth.vk.com/authorize';

	$params = array(
	    'client_id'     => $client_id,
	    'redirect_uri'  => $redirect_uri,
	    'response_type' => 'code');
}

public static function users_email($email){
   // return DB::table('users')->where('email', $token['email'])->pluck('email');
   return User::where('email','=',$email)->pluck('email');
}

public function users_soz_password($user,$str,$user_soz){
   $user->password=Hash::make($str);
    $user->active=1;
    $user->users_avt_soz=$user_soz;
    $user->save();
   $user->login(array('email'=>$user->email,'password'=>$str));
    
}
public static function user_password($email,$tokin){
    $user=User::where('email','=',$email)->first();
    $user->password=Hash::make($tokin);
    $user->save();
}

public function users_soz_password_ubdata($array_ubdata){
    $this->password=Hash::make($array_ubdata['access_token']);
    UsersAvtSoz::users_soz_password_ubdata($this->id,$array_ubdata);
    
}

public static function user_delete($id){
    $user=User::where('id','=', $id);
    if($user->users_avt_soz){
    UsersAvtSoz::UsersAvtSoz_Delete($user->users_avt_soz);}
    $user->delete();
}

public static function UserCount(){
    return User::all()->count();
}
public static function UserMessage($ArrauValue){   
        Mail::send('emails.user.UserMessage',
        array('title' => $ArrauValue['title'], 'id'=>$ArrauValue['idPost'],'text'=>$ArrauValue['text'],'UserEmail'=>$ArrauValue['emailPost'],'emailPost'=>$ArrauValue['UserEmail']),
        function ($message) use ($ArrauValue) {
            $message->to($ArrauValue['emailPost'])->subject('Новое сообщение с сайта RukiDobra.ru');
        }
    );    
return  1;}

public static function UsersAll(){
 return   User::where('id', '>',0)->orderBy("created_at","DESC")->paginate(10);
 
}



        }
        

