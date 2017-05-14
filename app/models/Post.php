<?php

class Post extends Eloquent {
    protected $table = 'post';
    protected $primaryKey='id';
    protected $guarded = array('id','id_user','vip_type','sostoynia','prosmotry'); // которое содержит список запрещённых к заполнению полей:
//  protected $fillable  = array('region_select', 'sity_select', 'category_select', 'poroda_koshek', 'poroda_sobak', 'pol', 'vozrast', 'tip_select', 'uslugi_select', 'tovari_select', 'cena', 'title', 'post', 'name', 'email', 'phone', 'priv_img', 'img_url', 'privat_email'); 
    public  $fillableUser = array('region_select', 'sity_select', 'category_select', 'poroda_koshek', 'poroda_sobak', 'pol', 'vozrast', 'tip_select', 'uslugi_select', 'tovari_select'); 


    public static function str_size($str,$length){
        $str=iconv("UTF-8","windows-1251", $str); 
        $str=substr($str, 0, $length);
        $str=iconv("windows-1251", "UTF-8", $str);
        if(strlen($str)>$length-20){
        $str .= "..."; }
        return $str;
}
    
public function getMessage($message, $redirect = false) {
    return View::make('errors.message', array(
        'message'   => $message,
        'redirect'  => $redirect,
));
    
}

public function DeletImg($arr_array){
    foreach($arr_array as $arr_array1){
       foreach($arr_array1 as $arr_array2){
           if(file_exists($arr_array2)){
           unlink($arr_array2);
           }
       }       
    }
return ;}

public static function AllPost($sostoynia=1){
    $query = Post::where('sostoynia', '=',(int)$sostoynia)->orderBy("created_at","DESC")->paginate(10); 
    return $query;
    }    
    
public static function IdPost($id){
    $id=(int)$id;
    $post=Post::where('id', '=', $id)->get()->first(); 
    //print_r($post);
return $post;}

public static function PostsUser($id){
    return Post::where('id_user', '=', Auth::user()->id)->where('sostoynia','=',$id)->orderBy("created_at","DESC")->paginate(10);
}
public static function GeoPost($geo){
    
}

public static function deletePost($id){
    if(gettype($id)==='array'){
        $i=0;
        foreach($id as $ids){
            $post=Post::IdPost((int)$ids);
            if(($post->id_user===Auth::user()->id)||(Auth::user()->pravo===88)){
                if($post->img_url!==''){
                   $post->DeletImg(unserialize($post->img_url));     
                }
                if(file_exists($post->phone)){
                 unlink($post->phone);   
                }
                if(($post->priv_img!=='images_post/hvostuk240x200.png')&&(file_exists($post->priv_img))){
                    unlink($post->priv_img);   
                }
            $post->delete();
            $i++;}
            }
        
     return $post->getMessage('Было удалино '.$i.' объявлений.','/private_office');
   }
      
    return   $post->getMessage('Произошла ошибка!!!','/private_office');}
    
public  function RegionsName(){
    $id=(int)$this->region_select;
   $results = DB::select('SELECT name FROM regions WHERE id = ?', array($id));   
   return $results[0]->name; }
   
public function CitysName(){
    $id=(int)$this->sity_select;
   $results = DB::select('SELECT name FROM citys WHERE id = ?', array($id));   
 return $results[0]->name; }
    
   
 public function CategoryName(){
    $id=(int)$this->category_select;
    $results = DB::select('SELECT name FROM category WHERE id = ?', array($id));
return $results[0]->name; }

public function Poroda_koshekName(){
    $id=(int)$this->poroda_koshek;
   $results = DB::select('SELECT name FROM poroda_koshek WHERE id = ?', array($id));
return $results[0]->name;}

public function Poroda_sobakName(){
$id=(int)$this->poroda_sobak;
 $results = DB::select('SELECT name FROM poroda_sobak WHERE id = ?', array($id)); 
return $results[0]->name;}
//$j= k/s;
public function PolName($j){
   if($j=='k'){
       $pol[1]='Кот  <span class="men-ico"></span>  ';
       $pol[2]='Кошка <span class="free-ico"></span>';
   }elseif($j=='s'){
       $pol[1]='Кобель <span class="men-ico"></span>';
       $pol[2]='Сука <span class="free-ico"></span>';
   } 
    $id=(int)$this->pol;
 return $pol[$id]; 
}
public function VozrastName(){
       $vozrast[2]='Взрослое животное';
       $vozrast[1]='Молодое животное';
   
   $id=(int)$this->vozrast;
 return $vozrast[$id];    
}

public function UslugiName(){
$id=(int)$this->uslugi_select;
$results = DB::select('SELECT name FROM uslugi_select WHERE id = ?', array($id));    
return $results[0]->name; }

public function TovariName(){
$id=(int)$this->tovari_select;
$results = DB::select('SELECT name FROM tovari_select WHERE id = ?', array($id));    
return $results[0]->name;}

public function TipName(){
  $id=(int)$this->tip_select;
 $results = DB::select('SELECT name FROM tip WHERE id = ?', array($id));    
 return $results[0]->name;}

 
public static function PhoneImg($phone, $id_user=''){
    $pattern='/^([+]+)*[0-9\x20\x28\x29-]{5,20}$/';
         if(!preg_match($pattern, $phone)){
             return $this->getMessage('Номер телефона неправильно указан!!!');
         }
        $data_mesec=date('/Y-m/');
        if(!file_exists('images_post'.$data_mesec)){ 
            mkdir('images_post'.$data_mesec, 0700);}
     //   $img=Image::make('images_post/phone_0.jpg');
        $img = Image::canvas(255, 26, '#ffffff');
        $img->text(strip_tags($phone),5,20, function($font) {
        $font->file('images_post/latha.ttf');    
        $font->size(22);
        });
        $filename_phone=$id_user.'_phone_'.str_random(6).'.jpg';
         $img->save('images_post'.$data_mesec.$filename_phone);
        $e='images_post'.$data_mesec.$filename_phone;
return $e;} 



public static function PostImgSeveTmp($data){
    if($data['my-pic']){
    // dd($data['my-pic']);
        $data_mesec=date('/Y-m/');
       $dir = 'images_tmp'.$data_mesec; //date('/Y-m/')   
         $rules = array('my-pic' => 'mimes:jpeg,png');
              $Vralidato_img['my-pic']=&$data['my-pic'];           
             $validator =Validator::make($Vralidato_img, $rules); 
            if ($validator->fails()) {
                return 0;
              }
           $sizeMax=1048576*15;
           if($data['my-pic']->getClientSize()>$sizeMax){
           return 0;
            }
            if((Auth::user()->id)&&(Auth::check())){
                $data['id_user']=Auth::user()->id;
            }
         $filename_original=$data['id_user'].'_'.str_random(14).'.jpg';
         $imgUrl_original=$dir.$filename_original;
        $data['my-pic']->move(public_path().'/'.$dir, $filename_original);
        $img_url=$dir.$filename_original;
    return $img_url;
}else {return 0;}
}
public static function PriveiFoto($foto, $id_user){
     $Img_oreg=Image::make($foto);
        $width=$Img_oreg->width();
       $height=$Img_oreg->height();
    if($width>$height){
         $otnW=$height/$width;
          $width115=200;
         $height115=$otnW*200;
       }elseif($width<$height){
            $otnW=$height/$width; 
           $width115=200/$otnW;
          $height115=200;      
       }else{
         $width115=200;
          $height115=200; 
       }
       $name_img='images_post'.date('/Y-m/').$id_user.'_'.str_random(9).'_pri.jpg';
    $Img_oreg->resize($width115, $height115)->save($name_img);
    return $name_img;
}

public static function PostImgSeve($data,$id_user){
    $data_mesec=date('/Y-m/');
    $i=0;
    $dir = '/images_post'.$data_mesec; //date('/Y-m/') 
    if(!is_dir('images_post'.date('/Y-m'))){
       mkdir('images_post'.date('/Y-m'), 0777);
    }
    foreach ($data as $value){
        if(file_exists($value)){
        $Img_oreg=Image::make($value);
       $width=$Img_oreg->width();
       $height=$Img_oreg->height();
       if($width>$height){
         $otnW=$height/$width;
         $widthImg640=640;
          $widthImg240=240;
         $widthImg480=$otnW*640;
          $widthImg200=$otnW*240;
       }elseif($width<$height){
            $otnW=$height/$width; 
           $widthImg640=480/$otnW;
          $widthImg240=200/$otnW;
          $widthImg480=480;
          $widthImg200=200;      
       }else{
          $widthImg480=480;
          $widthImg200=200;
          $widthImg640=480;
          $widthImg240=200;  
       }
       $filename_original[$i]=$id_user.'_'.str_random(14).'.jpg';
       $url_img[$i][0]='images_post'.$data_mesec.$filename_original[$i];
       $Img_oreg->save($url_img[$i][0]);
       $filename_640x480[$i]=$id_user.'_'.str_random(14).'.jpg';
       $url_img[$i][640]='images_post'.$data_mesec.$filename_640x480[$i];
        $Img_oreg->resize($widthImg640, $widthImg480)->save($url_img[$i][640]);
       $filename_240x200[$i]=$id_user.'_'.str_random(14).'.jpg'; 
       $url_img[$i][240]='images_post'.$data_mesec.$filename_240x200[$i];
       $Img_oreg->resize($widthImg240, $widthImg200)->save($url_img[$i][240]);
        $i++;
        unlink($value);
        }
    }
  return $url_img;  
}
public static function ImgStandarn(){
    $url_img[0][0]='images_post/hvostuk240x200.png';
    $url_img[0][240]='images_post/hvostuk240x200.png';
    $url_img[0][640]='images_post/hvostuk240x200.png';
    return $url_img;}

public static function DeleteImg($id,$mass){
    foreach ($id as $value_id){
        foreach ($mass as $key_mass=>$value_mass){
            foreach ($value_mass as $value_value_mass){
              if($value_value_mass==$value_id){
                  foreach ($mass[$key_mass] as $value_key_mass){
                   if(file_exists($value_key_mass)){ 
                        unlink($value_key_mass); 
                    }         
              }
                 unset($mass[$key_mass]);                  
              }  
            }
        }  
        
      }
      return $mass;


} 

public function scopeMax_min($query,$stolbec='id'){
    
return $query->orderBy($stolbec,'DESC');    
}

public function DateVchera($created_at, $br=true){
    if($br){
        $br='<br>';
    }else{
        $br=' ';
    }
    if($created_at->format('Y-m-d')==date('Y-m-d')){
        return 'Сегодня'.$br.$created_at->format('H:i');    
    }else{
        return $created_at->format('Y-m-d').$br.$created_at->format('H:i');     
    }
}

public function PohojiePost($post){
    $query=Post::where('sity_select','=',$post->sity_select); 
    if(sizeof($query->get())>=5){
      $query=$query->where('category_select','=',$post->category_select);  
      if((sizeof($query))>=5){
          if(($post->category_select==1&&($post->poroda_koshek))){
             $query=$query->where('poroda_koshek','=',$post->poroda_koshek);  
          }elseif(($post->category_select==3)&&($post->poroda_sobak)) {
             $query=$query->where('poroda_sobak','=',$post->poroda_sobak);        
                }
          }elseif(($post->category_select==11)&&($post->uslugi_select)) {
             $query=$query->where('uslugi_select','=',$post->uslugi_select);     
          }elseif(($post->category_select==14)&&($post->tovari_select)) {
             $query=$query->where('uslugi_select','=',$post->tovari_select);   
          }
    }
    $query=$query->where('id','<>',$post->id);
  
return $query->limit(5)->get();}


public function PrintFoto(){
    $html='';
    if(count($this->img_url)>1){
       foreach ($this->img_url as $img_url){
        $html.='<div id="min_foto" class="col-md-12 col-sm-4 col-xs-4">'
        .'<a  href="/'.$img_url[640].'" class="image img-responsive"  data-foo-bar="/'.$img_url[0].'" rel="nofollow"><img class="img-responsive" src="/'.$img_url[240].'" width="145"  class="thumbnail" /></a>';           
    $html.='</div>';} } else {$html.='';}                           
return $html;}

public function Kroshki($strelka=" <span class='glyphicon glyphicon-play ob'></span> "){ $html='';
            $html=$this->CategoryName().$strelka;         
        if(isset($this->poroda_koshek)){
         $html.=$this->Poroda_koshekName().$strelka;
         if(isset($this->pol)){
              $html.=$this->PolName('k').$strelka;
        }
           if(isset($this->vozrast)){  
             $html.=$this->VozrastName().$strelka;
           }
           if(isset($this->tip_select)){
           $html.=$this->TipName();
          }
        } else{ 
          if(isset($this->poroda_sobak))
             $html.=$this->Poroda_sobakName().$strelka;
          if(isset($this->pol)){
            $html.= $this->PolName('s').$strelka;
          }
          if(isset($this->vozrast)){
            $html.=$this->VozrastName().$strelka;
          }
           if(isset($this->tip_select)){
            $html.=$this->TipName();
           }
        else{
        if(isset($this->uslugi_select)){
       $html.=$this->UslugiName();
        } else{ 
            if(isset($this->tovari_select)) {
             $html.=$this->TovariName();
            }
        }
        }

        }
        return $html;
}
public function CoutImgUrl(){
    $img_url=unserialize($this->img_url);
    $html='';
    if($img_url !== false){
    foreach ($img_url as $key => $value) {
        $html.="<li><img width='150' src='/".$value[240]."'><button class='img_delet delete_img btn botton_btn' type='button'>Удалить</button></li>";
    }} 
    return $html;
}
public static function PostCount($sost=0){
    $query=Post::where('sostoynia','=',(int)$sost)->count(); 
    return $query;
    
}
public function MailPostAdd(){
   Mail::send('emails.post.postAdd',
        array('title' => $this->title, 'id'=>$this->id),
        function ($message)  {
            $message->to($this->email)->subject('Спасибо за объявление!');
        }
    );    
    Mail::send('emails.post.adminPostAdd',
        array('title' => $this->title, 'id'=>$this->id),
        function ($message)  {
            $message->to("andrey_besp@mail.ru")->to("leha_makarov@mail.ru")->subject('Новое объявление!');
        }
    );   
 
  
 return ;}

public function EdetSostPost($sost=0){
    if($sost==0){ // на модерации
     $this->chtaem_at = NULL; 
     $this->deletetaem_at = NULL; 
     $date=false;
    } elseif($sost==1) {// обубликованно
        $this->chtaem_at = date('Y-m-d', strtotime(date('Y-m-d').'+7 day'));
        $date=$this->chtaem_at;
        $this->deletetaem_at = NULL;          
    }elseif($sost==2){ //снятое 
     $this->chtaem_at = NULL; 
     $this->deletetaem_at = date('Y-m-d', strtotime(date('Y-m-d').'+7 day')); 
     $date = $this->deletetaem_at;
    }
    $this->sostoynia=(int)$sost;
    $this->save();
    return json_encode(array("sost"=>$this->sostoynia,"date"=>$date)); 
    
    }
  // Обубликованое до   
 public function EditChtaem_at($date){
      $date=str_replace('.','-',$date);
     $this->chtaem_at =  $date." 00:00:00";
     $this->save();
 return 1;}

       
    // Удалится после
 public function EditDeletetaem_at($date){
     $date=str_replace('.','-',$date);
     $this->deletetaem_at = $date." 00:00:00";
     $this->chtaem_at = NULL;
     $this->save();
     return 1;}      
public static  function listChtaem_at(){
    return Post::where('sostoynia','=',1)->where('chtaem_at','<',date("y.m.d"))->get();
}

public static function listDeletetaem_at(){
    return Post::where('sostoynia','=',2)->where('deletetaem_at','<',date("y.m.d"))->get();
}

    public function PostNaDelet(){
       if((Auth::check())&& (Auth::user()->pravo===88)){ 
           return dd($this -> created_at);
       }  
    }

        public static function adminAbdeitPostSost(){
 if((Auth::check())&& (Auth::user()->pravo===88)){ 
        $data = Post::OtchetPostSostajnijCount();
  if($data[0]!==0){  
    foreach ($data[0] as $value){
     $post = Post::find($value['id']);
     $post->sostoynia = 2;
     $post->save();
  }
  $othet['snjta'] = count($data[0]);
    } else{$othet['snjta'] = 0;}
  if($data[1]!==0){  $i=0;
     foreach ($data[1] as $value){
      $id_deletPost[$i] = $value['id'];     
     }  
      Post::destroy($id_deletPost);
      $othet['delet'] = count($data[1]);
  } else {$othet['delet'] = 0;}
    
  $othet['email'] = Auth::user()-> email;
         
  return $othet;       
      } else{return false;}  
    }    
          
  public function guardedNULL(){
       foreach ($this -> fillableUser as $value){
          $this -> $value = NULL;
      }
     return   $this -> save();
  }
    
    
    
    
      }


          




