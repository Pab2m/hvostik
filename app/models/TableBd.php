<?php

class TableBd {
        public static function TableAll($table){
        return  DB::table($table)->get();
    }
    public static function Sity($region){
        $db = DB::table('citys')->where('region_id', (int)$region)->get();
        return $db;
    }
    public static function TableId($table, $id, $pole = false){
        $db = DB::table($table)->where('id', $id)->get();
        if($pole == false){
        return $db[0];
        } else {
         return $db[0]->$pole;   
        }
    }
    public static function TableUpdate($table, $id, $arrayPoleUpdate){
       $db = DB::table($table)
             ->where('id', $id)
             ->update($arrayPoleUpdate);
     return $db;
    }
     public static function TableName($table, $name, $data){
             $db = DB::table($table)->where($name, $data)->get();
        return $db;
     }
    public static function TableAdd($table, $arrayPoleUpdate){   
      $id = DB::table($table)->insertGetId($arrayPoleUpdate);
      return $id;
    }
    
    public static function TableDelete($table, $id){   
     $db = DB::table($table)->where('id', $id) -> delete();
      return $db;
    }
    
}