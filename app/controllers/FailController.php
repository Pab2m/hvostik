<?php

class FailController extends BaseController {
    public static function FaillRecord($url, $str){
        if(File::exists($url)){
            File::put($url, $str);
            return 1;
        }else {return 0;}
    
    }
    
    
}