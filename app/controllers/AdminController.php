<?php
class AdminController  extends BaseController{
        
    public function UserControlAdmin(){
           if((Auth::check())&& (Auth::user()->pravo===88)){ 
               return;   
       }else{
      return View::make('errors.message', array('message'=>'Страница не найдина','redirect'=>false));    
      }
        
    }

        public function adminPanel(){
        if((Auth::check())&& (Auth::user()->pravo===88)){
          $post_all=Post::AllPost();
      return View::make('admin.admin',array('post_all'=>$post_all));  
    } return View::make('errors.message', array('message'=>'Страница не найдина','redirect'=>false));
        }
        
    public function EditPostMake($id, $maket='admin.edit_admin'){
//    $post=Post::IdPost($id);
//    if(!$post instanceof Post){
//    $post=new Post;   }
//    if((($post->id_user===Auth::user()->id)||(Auth::user()->pravo===88)) && (isset($post->id))){
//   $select_site='<option value=""></option>  '.$this->optionHtmlSity($post->region_select_add);
  return View::make('errors.message', array('message'=>'Страница не найдина','redirect'=>false));
//View::make($maket,array('post'=>$post,'optionHtmlRegions'=>$this->optionHtmlRegion(), 'optionHtmlCategory'=>$this->optionHtmlCategory(true), 'optionHtmlSite'=>$select_site));
  //  }
return  $post->getMessage('Упс ошибка!!!','/private_office');}


   public function adminEditId($id){
         
      if((Auth::check())&& (Auth::user()->pravo===88)){
          $post=Post::IdPost($id); 
    if(!$post instanceof Post){
    $post=new Post;   }
    if((($post->id_user===Auth::user()->id)||(Auth::user()->pravo===88)) && (isset($post->id))){
   $select_site='<option value=""></option>  '.$this->optionHtmlSity($post->region_select_add);
          
        return View::make('admin.edit_admin',array('post'=>$post,'optionHtmlRegions'=>$this->optionHtmlRegion(), 'optionHtmlCategory'=>$this->optionHtmlCategory(true), 'optionHtmlSite'=>$select_site));
    
       } else{
    return   View::make('errors.message', array('message'=>'Страница не найдина','redirect'=>false));}
       
       }}
 
public function announcement_admin_goot($id){
     if((Auth::check())&& (Auth::user()->pravo===88)){
     $post=Post::IdPost($id);
     $post_all=Post::AllPost("all");
    $TextPost='Обьявление "'.$post->title.'" успешно отредактированно ';
    if($post->sostoynia==1){$TextPost.='и <b>обуликованно</b> на сайте!';} else {$TextPost.='и <b>не обуликованно</b> на сайте!';}
    return View::make('admin.admin',array('post_all'=>$post_all,'TextPost'=>$TextPost));
}else{return View::make('errors.message', array('message'=>'Страница не найдина','redirect'=>false));}

                                            }
                                            
   public function adminPostID($id, $blade = "admin.annoucement.PostId"){
       if((Auth::check())&& (Auth::user()->pravo===88)){
   $post=Post::IdPost($id);
    if($post instanceof Post){
    if($post->img_url){
        $post->img_url=unserialize($post->img_url);
    }         
    if($post->chtaem_at===NULL){
        $teme_ch = date('Y-m-d', strtotime(date('Y-m-d').'+7 day'));
    }else{
        $teme_ch = $post->chtaem_at;
    }
    if($post->sostoynia==2){
        if($post->deletetaem_at==NULL){
         $delete_time_ch = date('Y-m-d', strtotime(date('Y-m-d').'+7 day'));   
        }else{
        $delete_time_ch = $post->deletetaem_at; 
        }
    }else{ $delete_time_ch = false;}
    
    if($post->sostoynia!=1){
        $disabled="disabled=true";
    } else{
        $disabled='';
    }
    return View::make($blade, array('post'=>$post, 'teme_ch'=>$teme_ch, "disabled"=>$disabled, "delete_time_ch"=>$delete_time_ch));}
    else{
        return $this->getMessage('Страница ненайдина!!!');
    }    
       }else{return View::make('errors.message', array('message'=>'Страница не найдина','redirect'=>false));}       
   }
   
   public function adminPostIdWinOpen($id){
    return  $this->adminPostID($id, "admin.annoucement.PostIdWindOpen");  
    }
   
public function adminPosts($id){
    if((Auth::check())&& (Auth::user()->pravo===88)){ 
        if($id==1){
           $title="<div class='postPublik'>Обубликованные объявления!</div>"; 
        } elseif($id==0){
           $title="<div class='postModer'>Объявления на модерации!</div>"; 
        }elseif($id==2){
          $title="<div class='DeletPublik'>Объявления завершенные!</div>"; 
        }
        
    return View::make('admin.annoucement.Posts',array('post_all'=>Post::AllPost($id),"title"=>$title));
    
    }  else {
    return View::make('errors.message', array('message'=>'Страница не найдина','redirect'=>false));
    }
}
 
public function adminUsers(){
   if((Auth::check())&& (Auth::user()->pravo===88)){ 
     $users_all=User::UsersAll();
       
    return  View::make('admin.users.adminUsers', array('users_all'=>$users_all));   
       
   } else {
    return View::make('errors.message', array('message'=>'Страница не найдина','redirect'=>false));
    } 
    
}
public static function OtchetPostSostajnijCount(){
  if((Auth::check())&& (Auth::user()->pravo===88)){  
    $snjt_post = Post::listChtaem_at();
    $i = 0;
    if($snjt_post->count()!=0){
    foreach ($snjt_post as $post){
        $snjt_array[$i]["id"] = $post->id;
        $snjt_array[$i]["title"] = $post->title;
        $snjt_array[$i]["email"] = $post->email;
        $snjt_array[$i]["created_at"] = $post->created_at; 
        $i++; 
    }} else { $snjt_array = 0; }
    $snjt_post = Post::listDeletetaem_at();
     $value[0] = $snjt_array;
      unset($snjt_array);       
    if($snjt_post->count()!=0){
    $i = 0;

    foreach ($snjt_post as $post){
        $snjt_array[$i]["id"] = $post->id;
        $snjt_array[$i]["title"] = $post->title;
        $snjt_array[$i]["email"] = $post->email;
        $snjt_array[$i]["created_at"] = $post->created_at;
    $i++; 
    }} else { $snjt_array = 0; }
    
     $value[1] = $snjt_array;
      
    return  $value; 
 }else{return ;}
 
    }


public function adminControlPost(){
    $data = AdminController::OtchetPostSostajnijCount();
    $value[0] = json_encode($data[0]);
    $value[1] = json_encode($data[1]);
    return json_encode($value);   
}

public function adminControlAbdeitPostSost() {
  if((Auth::check())&& (Auth::user()->pravo===88)){   
    $othcet = Post::adminAbdeitPostSost();

    return json_encode($othcet);
    }else{return ;}
}
public static function adminStaticPages(){
      if((Auth::check())&& (Auth::user()->pravo===88)){ 
    $staticpages_all = Staticpage::StaticpageAll();    
    return  View::make('admin.staticpages.staticpages', array('staticpages_all'=> $staticpages_all));   
      }else {
    return View::make('errors.message', array('message'=>'Страница не найдина','redirect'=>false));
    } 
      
}

public function adminStaticpageAddViews(){
      if((Auth::check())&& (Auth::user()->pravo===88)){ 
        return  View::make('admin.staticpages.staticpageadd');     
      } else{
      return View::make('errors.message', array('message'=>'Страница не найдина','redirect'=>false));    
      }
}
public function adminStaticpageAdd(){
    if((Auth::check())&& (Auth::user()->pravo===88)){ 
       $data=Input::all();
       $validate = true;
       if((!isset($data["title"]))||($data["title"]=="")){
           $validate = false;   
       }
       if((!isset($data["post"]))||($data["post"]=="")){
           $validate = false; 
       }
       if((isset($data["true_url"]))&&($data["true_url"] == "1")){
        $data["true_url"] = 1;   
       } else{ 
       $data["true_url"] = 0;   }
    if(!$validate){
     return  View::make('errors.message', array('message'=>'Не все поля заполнены!','redirect'=>false));
    }   
      $status = Staticpage::AddStaticpage($data);
    
    if($status===1){
        return Redirect::route('staticpages');
    } else {
      return  View::make('errors.message', array('message'=>'Опс! Ошибка что-то пошло нетак!','redirect'=>false));
    }
    }else{
      return View::make('errors.message', array('message'=>'Страница не найдина','redirect'=>false));    
      }
}
public function adminStaticpage($id){
     if((Auth::check())&& (Auth::user()->pravo===88)){
   $staticpage = Staticpage::StaticpageId($id);
   if(!$staticpage instanceof Illuminate\Database\Eloquent\Model){
       return View::make('errors.message', array('message'=>'Страница не найдина','redirect'=>false));   
   }
    return View::make('admin.staticpages.staticpage', array('staticpage'=>$staticpage));
 }else{
      return View::make('errors.message', array('message'=>'Страница не найдина','redirect'=>false));    
      }
   }
public function adminStaticpageEdit($id){
    if((Auth::check())&& (Auth::user()->pravo===88)){
    $staticpage = Staticpage::StaticpageId($id);
   if(!$staticpage instanceof Illuminate\Database\Eloquent\Model){
       return View::make('errors.message', array('message'=>'Страница не найдина','redirect'=>false));   
   }
    return View::make('admin.staticpages.staticpageEdit', array('staticpage'=>$staticpage));
   }else{
      return View::make('errors.message', array('message'=>'Страница не найдина','redirect'=>false));    
      }
   }

public function adminStaticpageEditForm(){
       if((Auth::check())&& (Auth::user()->pravo===88)){ 
       $data=Input::all();
       $validate = true;
       if((!isset($data["title"]))||($data["title"]=="")){
           $validate = false;   
       }
       if((!isset($data["post"]))||($data["post"]=="")){
           $validate = false; 
       }
       if((isset($data["true_url"]))&&($data["true_url"] == "1")){
        $data["true_url"] = 1;   
       } else{ 
       $data["true_url"] = 0;   }
    if(!$validate){
     return  View::make('errors.message', array('message'=>'Не все поля заполнены!','redirect'=>false));
    } 
    $id = $data['staticpageId'];    unset($data['staticpageId']);
    $status = Staticpage::AddStaticpage($data,0,true,$id);
    if($status===1){
        return Redirect::route('staticpageId', array('id' => $id));
    } else {
      return  View::make('errors.message', array('message'=>'Опс! Ошибка что-то пошло нетак!','redirect'=>false));
    }   
    
       }else{
      return View::make('errors.message', array('message'=>'Страница не найдина','redirect'=>false));    
      }
}
public function adminSelect() {
    if((Auth::check())&& (Auth::user()->pravo===88)){ 
           $countrys = BaseController::optionHtmlCountrys();
           $regions = BaseController::optionHtmlRegion();
           $citys = BaseController::optionHtmlSity(0,true);
            $category = BaseController::optionHtmlCategory();//category
            $cot_select  = BaseController::optionHtmlCategory(false, 'poroda_koshek');
            $sob_select = BaseController::optionHtmlCategory(false, 'poroda_sobak');
            $tip = BaseController::optionHtmlCategory(false,'tip');
            $tovari_select = BaseController::optionHtmlCategory(false,'tovari_select');
            $uslugi_select = BaseController::optionHtmlCategory(false,'uslugi_select');
          return View::make('admin.select.select', array('countrys'=>$countrys, 'regions'=>$regions,'regions'=>$regions,'citys'=>$citys,'category'=>$category,
              'tip'=>$tip,'tovari_select'=>$tovari_select,'uslugi_select'=>$uslugi_select,'cot_select'=> $cot_select, "sob_select"=>$sob_select));    
      }else{
      return View::make('errors.message', array('message'=>'Страница не найдина','redirect'=>false));    
      }
}


public function adminSelectSity(){
    $this->UserControlAdmin(); 
    $data=Input::all();
    $sity = TableBd::Sity((int)$data["region"]);
    return json_encode($sity);
}

public function adminSelectDetailAll($url){
    if((Auth::check())&& (Auth::user()->pravo===88)){ 
        $json = false; $json_url=''; $db =''; 
     switch ($url) {
case 'countrys':
    $title = 'Страны';
    $countrys = TableBd::TableAll("countrys");
    $db = 'countrys'; 
    break;

case 'regions':
    $title = 'Регионы России';
    $countrys = TableBd::TableAll('regions');
    $json = true;
    $json_url = "json/regions.json";
    $db = 'regions';
     break;
    
case 'citys':
    $title = 'Города ';
    $countrys = TableBd::TableAll("regions");
    $db = 'citys'; 
     break;
    
case 'category':
    $title = 'Категория ';
    $json = true;
    $json_url = "json/category.json";
    $db = 'category';
    $countrys = TableBd::TableAll("category");
     break;

case 'poroda-koshek':
    $title = 'Порода кошек';
    $db = 'poroda_koshek';
    $countrys = TableBd::TableAll("poroda_koshek");
     break;
    
case 'poroda-sobak':
    $title = 'Порода собак';
    $countrys = TableBd::TableAll("poroda_sobak");
    $db = 'poroda_sobak';
    break;
    
 case 'tip':
    $title = 'Тип объевления';
    $countrys = TableBd::TableAll("tip");
     $db = 'tip';
     break;
    
case 'tovari':
    $db = 'uslugi_select';
    $title = 'Товары для животных';
    $countrys = TableBd::TableAll("tovari_select");
     break;
        
case 'uslugi':
    $db = 'tovari_select';
    $title = 'Услуги для животных';
    $countrys = TableBd::TableAll("uslugi_select");
     break;
}
 return View::make('admin.select.detail.noSite', array('countrys'=>$countrys, 'title'=>$title, 'id'=>'id','i'=>0,"json"=>$json,"json_url"=>$json_url,"db"=>$db)) ;

}else{
      return View::make('errors.message', array('message'=>'Страница не найдина','redirect'=>false));    
      }
     }


public function JsonUpdate($value_p = 'regions'){
    $this -> UserControlAdmin();
     switch ($value_p) {
         case 'regions':
            $tableBd = TableBd::TableAll("regions");
            break;
         case 'category':
            $tableBd = TableBd::TableAll("category"); 
             break;
    }
            $i=0;
            foreach ($tableBd as $value){
              $data[$i]["id"] = $value -> id;
              $data[$i]["name"] = $value ->name;
              $i++;
            }
            if(FailController::FaillRecord("json/".$value_p.".json",json_encode($data)) === 1){
                return  "Дата создания ".$value_p."json файла:<br><span id='red-taim'>".date('Y-m-d H:i:s',filemtime("json/".$value_p.".json"))."</span>"; 
            } else{
               return "При создание файла произошла ошибка";
            } 
}

public static function SelectFiltor($value){
         $bre = 0;
         $selects = array("countrys","regions","citys","poroda_koshek", "poroda_sobak","tip","tovari_select","uslugi_select","category");    
         foreach($selects as $select){
            if($select == $value){
                $bre = 1;
                break;
            }
         }
        return $bre;   
    }

    //0 - ошибка кретическая
    //2 - ошибка с коментарием
public function selectDetailEdit(){ 
         if((Auth::check())&& (Auth::user()->pravo===88)){ 
             $data=Input::all(); 
             if(AdminController::SelectFiltor($data["select"])==1){
                 $select = strip_tags($data["select"]);
                 $id = (int)strip_tags($data["id"]);
                 $name = strip_tags($data["name"]);
                 $ArrayData = array("name"=>$name);
                 if($data["name_en"]){
                     $ArrayData["name_en"] = strip_tags($data["name_en"]);
                 }
                 $OldValue = TableBd::TableId($select,$id);
                 if($name == $OldValue->name){
                  return json_encode(array(
                     "reply" => 2,
                     "html" => "<p><b>Изменения не зафиксированны!!!</b></p><p>Значения которое вы пытаетесь записать уже записанно!</p>"
                  ));
                 } else {
                  if(TableBd::TableUpdate($select, $id, $ArrayData) === 1){
                     return json_encode(array(
                     "reply" => 1,
                     "html" => "<p><b>Запись была успешна изменина!</b></p>",
                     "id" => $id,
                     "data" => $name     
                  )); 
                  } else {
                     return json_encode(array(
                     "reply" => 0
                      )); }  
                 
                 }
             } else{
                 return json_encode(array(
                     "reply" => 0
                 ));
             }
             
          } else {
             return json_encode(array(
                     "reply" => 0
                 ));
          }
}
public function selectDetailAddNotDubol(){ 
  if((Auth::check())&& (Auth::user()->pravo===88)){  
      $data=Input::all(); 
   if(AdminController::SelectFiltor($data["table"])==1){ 
     return count(TableBd::TableName($data['table'], strip_tags($data['searchTr']), strip_tags($data['value'])));
   } return -1;
} else 
    {
     return -1;}
   }
public function selectDetailAdd(){
        if((Auth::check())&& (Auth::user()->pravo===88)){ 
           $data = Input::all();  
           if(AdminController::SelectFiltor($data["table"])==1){ 
               $data['ArrayValue'] = json_decode($data['ArrayValue']);
               $data['ArrayKey'] = json_decode($data['ArrayKey']);
               $ArrayValueCount = count($data['ArrayValue']);
               for($i = 0; $i < $ArrayValueCount; $i++){
                   $ArrayValue[$data['ArrayKey'][$i]] = strip_tags($data['ArrayValue'][$i]);
               }
                $id = TableBd::TableAdd($data["table"],$ArrayValue);
                $td = TableBd::TableId($data['table'], $id);
                return json_encode($td);
           } else return 0;
        } else return 0;
}
public function selectDelete(){
        if((Auth::check())&& (Auth::user()->pravo===88)){ 
           $data = Input::all();  
           if(AdminController::SelectFiltor($data["table"])==1){ 
              return TableBd::TableDelete($data["table"], (int)$data["id"]);
           } else return 0;
        } else {
            return 0;
        }
}
public function adminSelectSityEdit(){
    $this->UserControlAdmin();
    $data = Input::all();
    $table = $data["select"];
    $id = (int)$data["id"];
    $name = strip_tags($data["name"]);
    $arrayPoleUpdate = array('name' => $name,
                             'name_en' => strip_tags($data["name_en"]),
                             'region_id' => (int)strip_tags($data["region_id"])
                            );
    if(($table == "citys") && ($id !='') && ($name != '')){
        //$tb = TableBd::TableUpdate($table, $id, $arrayPoleUpdate);
        $tb  = 1;
        if($tb){
            return json_encode(array(
                     "reply" => 1,
                     "html" => "<p><b>Изменения записаны в БД!!!</b>"
                  ));
        } else {
            return json_encode(array(
                     "reply" => 0,
                     "html" => "<p><b>Изменения не зафиксированны!!!</b></p><p>Ошибка при записи в БД!</p>"
                  )); 
        }
    } 
    else return json_encode(array(
                     "reply" => 0,
                     "html" => "<p><b>Изменения не зафиксированны!!!</b></p><p>Кретическая ошибка!</p>"
                  )); 
  
    }
    public function ConfigSistem(){
    if((Auth::check())&& (Auth::user()->pravo===88)){ 
       $confiBd = TableBd::TableAll("config");
    return View::make('admin.config.index', array('confiBd'=> $confiBd));   
      } else {
     return View::make('errors.message', array('message'=>'Страница не найдина','redirect'=>false));
    } }
    }
