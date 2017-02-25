<?php

class Constant{
    public $url='http://hvostik';
    public $const_vk=array('client_secret'=>'uNS72lOYaP9IPrdZSlhV','client_id'=>'5165245','redirect_uri'=>'');//'redirect_uri'=>$this->url
            
  function Constant(){
      $this->const_vk['redirect_uri']=$this->url;
  }    
}