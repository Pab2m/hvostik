<?php


class ImgController extends BaseController {
    
   public function test(){
  //   return View::make('test');
  // $img = Image::make('images_post/12_5D9h1TaaiKnEgF.jpg')->resize(320, 240)->save('images_post/12.jpg');
        // create Image from file
       $img=Image::make('images_post/phone_0.jpg');   
       $img->text('+7(927)341-52-19',5,20, function($font) {
       $font->file('images_post/Scrawl_Regular.ttf');    
       $font->size(22);
       //$font->align('center');
 
       });
       
       $img->save('images_post/phone_1.jpg');
       
       return ;}
    
   public function img(){
       $rules = array('file' => 'mimes:jpeg,png');
      //$validator = Validator::make(Input::all(), $rules);
       $img=Input::file();
       //$all=Input::all();
       print_r($img);
      // print_r($all);
       return 88;
   }
    
}
