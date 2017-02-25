<?php

class UsersAvtSoz extends Eloquent {
    protected $table = 'users_avt_soz';
    protected $primaryKey='id';
    protected $fillable = array('id_users','soz_set','access_token','expires_in','user_id','email'); 
    

public static function users_avt_soz_email_access_token($email){
     $UsersAvtSoz=UsersAvtSoz::where('email','=', $email)->first();
  if($UsersAvtSoz!==NULL){
  $email_access_token['access_token']=$UsersAvtSoz->access_token;
  $email_access_token['email']=$UsersAvtSoz->email;
  } else{$email_access_token['access_token']=NULL;
          $email_access_token['email']=NULL;}
return $email_access_token;}

public static function users_register_soz($data){
    $UsersAvtSoz=UsersAvtSoz::create($data);
    return $UsersAvtSoz; 
}

public static function users_soz_password_ubdata($id_user,$array_ubdata){
    $users_avt_soz=UsersAvtSoz::where('id_users','=', $id_user)->first();
    $users_avt_soz->access_token=$array_ubdata['access_token'];
    $users_avt_soz->expires_in=$array_ubdata['expires_in'];
    $users_avt_soz->save();
}

public function UsersAvtSoz_mail($url){
            $that = $this;
         Mail::send('emails.UsersAvtSoz_mail',
        array('url' => $url,'url_coz_set'=>$this->soz_set),
        function ($message) use($that) {
            $message->to($that->email, 'http://laravel.ufasait.ru/');
        }
    );
        }
 public static function UsersAvtSoz_Delete($id){
      $UsersAvtSoz=UsersAvtSoz::where('id','=', $id);
     if($UsersAvtSoz!==NULL){
         $UsersAvtSoz->delete();
     }
 }

}