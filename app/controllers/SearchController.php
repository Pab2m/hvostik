<?php

class SearchController extends BaseController {
    
public function search(){
        
return View::make('announcement.search', array('optionHtmlRegions'=>$this->optionHtmlRegion(), 'optionHtmlCategory'=>$this->optionHtmlCategory(true))); }

 public function ValidateDate($value){

     if((isset($value['post']))&&($value['post'])){
     $data["post"] = strip_tags($value['post']);
      }
       if((isset($value['region_select']))&&($value['region_select'])){
      $data['region_select']=(int)strip_tags($value['region_select']);
      }
     if((isset($value['sity_select'])&&($value['sity_select']))){
      $data['sity_select']=(int)strip_tags($value['sity_select']);
      }  
      if((isset($value['category_select'])&&($value['category_select']))){
        $data['category_select']=(int)strip_tags($value['category_select']);  
        if(($data['category_select']==1)||($data['category_select']==3)){
               if(($data['category_select']==1) && (isset($value['poroda_koshek']))){
                    $data['poroda_koshek']=(int)strip_tags($value['poroda_koshek']);
               }
               if(($data['category_select']==3) && (isset($value['poroda_sobak']))){
                    $data['poroda_sobak']=(int)strip_tags($value['poroda_sobak']); 
               }
           if(isset($value['tip_select'])&&($value['tip_select'])){
           $data['tip_select']=(int)strip_tags($value['tip_select']);    }
            
        }elseif($data['category_select']==14){ 
            if(isset($value['tovari_select'])){
            $data['tovari_select']=(int)strip_tags($value['tovari_select']); 
            }
        } elseif($data['category_select']==11) {
             $data['uslugi_select']=(int)strip_tags($value['uslugi_select']); 
        }
      }
      
  return $data;   
 }

 public function searchData1($all=false){
       $data = SearchController::ValidateDate(Input::all());
      if((isset($data))||(isset($post))){
          $query = Post::query();
          $foreach=false;
          if(isset($data)){
          foreach($data as $kye=>$value){
            $query = $query->where($kye,'=',$value);
            $foreach=true;  
          }}
          if(isset($post)){
          $query=$query->whereRaw("MATCH(title,post) AGAINST(? IN BOOLEAN MODE)",array($post));
          $data['post']=$post;
          }else{
            //$query=$query->paginate(10);  
          }
          if($foreach){
            //  dd($query);
          //  $query=$query->paginate(10);
          }
          $query=$query->where('sostoynia','=',1)->paginate(10);
          $queryList=$query->appends($data)->links();
          $query=$query->getCollection();
          // dd($data);
          return  View::make('announcement.search',array('query'=>$query,'queryList'=>$queryList,'getData'=>$data));
          }else{
          $query = Post::query()->where('sostoynia','=',1)->paginate(10);
          $queryList=$query->links();
          $query=$query->getCollection();
          
          return View::make('announcement.search',array('query'=>$query,'queryList'=>$queryList,'getData'=>false));
      }
      
}

public function searchData($ajax){

        $data = SearchController::ValidateDate(Input::all());
 
        if(isset($data['post'])){
        $post = $data['post'];
        unset($data['post']);
        } else {
          $post = '';   
        }
        if((isset($data))||(isset($post))){  
          $query = Post::query();
          $foreach = false;
          if(isset($data)){
          foreach($data as $kye=>$value){
              $r[$kye] = $value;
            $query = $query->where($kye,'=',$value);
            $foreach=true;  
          }}
         // dd($query->get());
          if((isset($post)) && ($post !== '')){
          $query=$query->whereRaw("MATCH(title,post) AGAINST(? IN BOOLEAN MODE)",array($post));
          $data['post']=$post;
          }
          
          $query=$query->where('sostoynia','=',1)->paginate(10);
          $queryList=$query->appends($data)->links();
          $query=$query->getCollection();
         if($ajax === "ajax"){ 
            $view =  View::make('announcement.searchAjax',array('query'=>$query,'queryList'=>$queryList));
            return $view->render();
         } elseif($ajax === "get"){
           
           return View::make('announcement.search',array('query'=>$query,'queryList'=>$queryList,'getData'=>$data, 'post'=>$post));
         } 
          }else{
          $query = Post::query()->where('sostoynia','=',1)->paginate(10);
          $queryList=$query->links();
          $query=$query->getCollection();
         if($ajax === "ajax"){ 
            $view =  View::make('announcement.searchAjax',array('query'=>$query,'queryList'=>$queryList,'getData'=>false));
            return $view->render();
         } elseif($ajax === "get"){
           return View::make('announcement.search',array('query'=>$query,'queryList'=>$queryList,'getData'=>$data, 'post'=>$post));
         } 
          }

}


        
}