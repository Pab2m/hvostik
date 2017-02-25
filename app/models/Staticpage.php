<?php
//Статическии страницы
class Staticpage extends Eloquent {
    protected $table = 'staticpage';
    protected $primaryKey='id';
    
public static function AddStaticpage($data, $url_yes=0, $edit=false,$id=0){
   if((!$edit)&&($id!==0)){
   $staticpage = new Staticpage;}
   else {
     $staticpage = Staticpage::find((int)$id); 
   }
   $staticpage -> title = $data['title'];
   if(!$edit){
   $staticpage -> url = BaseController::transliteratsya($data['title']);}
   else {$staticpage -> url = $data['url'];}
   $staticpage -> post = $data['post'];
   $staticpage -> url_yes = $url_yes;
   if(($url_yes == 1)&&(Staticpage::where('url', '=', $staticpage->url)->get()->count()!=0)){
   return 0;  
   } else{
   $staticpage -> save();
   return 1;}
}
public static function StaticpageAll(){
   return  $Staticpages = Staticpage::where('id', '>' ,0)->paginate(10);   
}

public  static function StaticpageId($id, $post=false){
   $staticpage = Staticpage::find((int)$id);
   if(!$post){
   return $staticpage;} 
   else{
    return $staticpage->post;   
   }
}
public static function StaticpageUrl($url){
  $staticpage = Staticpage::where('url', '=', $url);
  if($staticpage->url_yes === 1){
  return $staticpage;  
  } else {
      return 0;   
  }
}

    
}