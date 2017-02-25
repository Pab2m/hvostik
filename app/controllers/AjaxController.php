<?php

class AjaxController extends AdminController {
    
    public function getSity($id){
        $id_sity=$id*1;
        $select='<select data-placeholder="Город" style="width:100%;" class="chosen-select" tabindex="7" id="sity_select" name="sity_select"><option value=""></option>  '.$this->optionHtmlSity($id).' </select>';
        return $select; 
    }
    public function SityArray($id){
        $db = TableBd::Sity($id);
        $i = 0;
        foreach ($db as $valye){
            $array[$i]["id"] = $valye->id;
            $array[$i]["name"] = $valye->name;
        $i++;
        }
        return json_encode($array);
    }
    
      public function getSityJson($id){
        $id_sity=$id*1;
        $select='<select data-placeholder="Город" style="width:100%;" class="chosen-select" tabindex="7" id="sity_select" name="sity_select"><option value=""></option>  '.$this->optionHtmlSity($id).' </select>';
        return $select; 
    }
     public function getSitySearch($id){
        $id_sity=$id*1;
        $select='<select data-placeholder="Город" style="width:100%;" class="chosen-select" tabindex="7" id="sity_select_search" name="sity_select"><option value=""></option>  '.$this->optionHtmlSity($id).' </select>';
        return $select; 
    }
    
     public function TableBdJsonTab($tb){
         $tb_control = array("poroda_koshek","poroda_sobak","tip","tovari_select","uslugi_select");
         $goot = false;
         foreach ($tb_control as $value){
             if($tb === $value){
                 $goot = true;
                 break;
             }
         }
          if($goot){
             $rez =  DB::table($tb)->select('id', 'name')->get();
             return json_encode($rez);
             } else {
                 return json_encode(array());
             }
     
          }
    
    public function valueType($url_ajax){ 
        if(($url_ajax!=='poroda_koshek')&&($url_ajax!=='poroda_sobak')&&($url_ajax!=='uslugi_select')&&($url_ajax!=='tovari_select')&&($url_ajax!=='drugii_jivotnih') &&($url_ajax!=='drugii_jivotnih')){
            return ;}
      
              $data_placeholder=array(
          'poroda_koshek'=>'Порода кошек',
          'poroda_sobak'=>'Порода собак',
          'uslugi_select'=>'Тип объявления',
           'tovari_select'=>'Тип объявления' );
              
              if($url_ajax=='poroda_koshek'){
                  $id='poroda_koshek';
              }elseif($url_ajax=='poroda_sobak'){
                  $id='poroda_sobak';
              }else{
        $id=substr($url_ajax, 0, strpos($url_ajax, '_' ));
        $id.='_select_add';}
        $id_=substr($url_ajax, 0, strpos($url_ajax, '_' ));
        $id_.='_select_add';
        $select=
        '<div id="cot_select" class="form-group">'.
        '<div class="col-md-6">'.
         '<select data-placeholder="'.$data_placeholder[$url_ajax].'" style="width:100%;" class="chosen-select" tabindex="7" id="'.$id_.'" name="'.$id.'" class="'.$url_ajax.'"><option value=""></option>  '.$this->optionHtmlCategory(false,$url_ajax).' </select>'.
         '</div></div>';
        if(($url_ajax!=='uslugi_select')||(($url_ajax!=='tovari_select'))){
        if($url_ajax=='poroda_koshek'){//Пол 1-муж, 2-жен; Возраст 1-взрослое животное, 2-молодое животное   
         $select.=
    '<div id="pol" class="form-group">'.
    '<div class="col-md-6">'.       
            '<div class="border">'.
             '<h4>Пол животного</h4>'.    
                 '<div class="padding_pol_8">'.
                 '<span>Кот</span> <input type="radio" value="1" name="pol">'.
                 '<div><span>Кошка</span> <input type="radio" value="2" name="pol">'.
                 '</div>'.
            '</div>'.     
     '</div></div>'.
    '</div>'.
                 
    '<div id="vozrast" class="form-group">'.
    '<div class="col-md-6">'.       
            '<div class="border">'.
             '<h4>Возраст животного</h4>'.    
                 '<div class="padding_vozrast_8">'.
                 '<div>Взрослое животное <input type="radio" value="1" name="vozrast"></div>'.
                 '<div>Котенок <input type="radio" value="2" name="vozrast"></div>'.
                 '</div>'.
            '</div>'.     
     '</div></div>';   
           
        }elseif($url_ajax=='poroda_sobak'){
            $select.=
  '<div id="pol" class="form-group">'.
    '<div class="col-md-6">'.       
            '<div class="border">'.
             '<h4>Пол животного</h4>'.    
                 '<div class="padding_pol_8">'.
                 '<span>Кабель</span> <input type="radio" value="1" name="pol">'.
                 '<div><span>Сука</span> <input type="radio" value="2" name="pol">'.
                 '</div>'.
            '</div>'.     
     '</div></div>'.
    '</div>'.
                 
    '<div id="vozrast" class="form-group">'.
    '<div class="col-md-6">'.       
            '<div class="border">'.
             '<h4>Возраст животного</h4>'.    
                 '<div class="padding_vozrast_8">'.
                 '<div>Взрослое животное <input type="radio" value="1" name="vozrast"></div>'.
                 '<div>Щенок <input type="radio" value="2" name="vozrast"></div>'.
                 '</div>'.
            '</div>'.     
     '</div></div>';
                     
        }elseif(($url_ajax=='uslugi_select')||($url_ajax=='tovari_select')){
            //$select='<span class="label_span">Тип объявления</span>'.$select;
        }
        
        }
       return   $select; 
    }
    
    public function getTip(){
     $select='<select data-placeholder="Тип объявления" style="width:100%;" class="chosen-select" tabindex="7" id="tip_select_add" name="tip_select_add"><option value=""></option>  '.$this->optionHtmlCategory(true,'tip').'</select>';
     return $select;}
    
    public function getTipSearch($name_tabel){
        if($name_tabel=='tip'){
            $name='tip';
        }elseif($name_tabel=='uslugi_select'){
           $name='uslugi'; 
        }elseif ($name_tabel=='tovari_select') {
             $name='tovari'; 
        }else{return ;}
     $select='<select data-placeholder="Тип объявления" style="width:100%;" class="chosen-select" tabindex="7" id="'.$name.'_select_serch" name="'.$name.'_select_add"><option value=""></option><option value=""></option>  '.$this->optionHtmlCategory(false,$name_tabel).'</select>';
   return $select;
    
        }
     public function idRegionSity_Region($id){
        $results = DB::select('SELECT * FROM citys WHERE id=?', array($id));  
        return $results[0]->id;
    } 
    public function idRegion($id, $pole = false){
        $tb = TableBd::TableId('regions', (int)$id, strip_tags($pole));
        if(gettype($tb) == 'object'){
            return json_encode($tb);  
        }
        return $tb;
    }

        public function UserMessage(){
        $data=Input::all();
        foreach($data as &$value){
             $value=strip_tags($value);
        }
          $rules=['email'=>'required|email|min:6'];
   $val = Validator::make($data, $rules);
         if($val->fails()){
           return false;           }
   $emailPost = Post::IdPost(71)->email;//Post::IdPost((int)$data['idPost']);
      //      dd($emailPost);
   $ArrauValue =  array('title' => $data['title'], 'idPost'=>$data['idPost'], 'text'=>$data['text'], 'emailPost' =>$emailPost,'UserEmail'=>$data["email"]);
      
        return User::UserMessage($ArrauValue);
    }
    
    public function AdminPostSost() {
  if((Auth::check())&& (Auth::user()->pravo===88)){
        $data=Input::all();
        foreach($data as &$value){
             $value=strip_tags($value);
        }
      $post = Post::IdPost((int)$data["idPost"]);  
      return $post->EdetSostPost($data["sost"]);   
      }
        }
    
public function AdminPostCount(){
     $val[0]=Post::PostCount(0);
     $val[1]=Post::PostCount(1);
     $val[2]=Post::PostCount(2);
   return json_encode($val);
}        
 
public function AdminPostEditDate(){
 if((Auth::check())&& (Auth::user()->pravo===88)){   
     $data=Input::all();
    
  foreach($data as &$value){
             $value=strip_tags($value);
        }
   $post=Post::IdPost((int)$data["post_id"]);     
  if($data["input_id"]==="datepicker"){
     return $post->EditChtaem_at($data["value"]);
  }  elseif($data["input_id"]==="delet_post_time"){ 
     return $post->EditDeletetaem_at($data["value"]);
  } else { return 0;}   
} else {return 0;}  

}

public static function CachaGoogla($str){
	$url = "https://www.google.com/recaptcha/api/siteverify";
$params = array(
    "secret" => "6LcQUxgTAAAAAN8el8vEyIPUHkCNdnQsaUAtHTu7",
    "response" => $str
);
$result = file_get_contents($url, false, stream_context_create(array(
    'http' => array(
        'method'  => 'POST',
        'header'  => 'Content-type: application/x-www-form-urlencoded',
        'content' => http_build_query($params)
    )
)));
return $result;
}

public static function staticpages(){
    
    
    
}


}