<?php

class BaseController extends Controller {

    /**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */

         
     
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}
        
 public static function getMessage($message, $redirect = false) {
    return View::make('errors.message', array(
        'message'   => $message,
        'redirect'  => $redirect,
));
    }
    
    public static function optionHtmlRegion(){
        $results = DB::select('SELECT * FROM regions');  
        $option_reg='';
        foreach($results as $val_array){
        $option_reg.='<option value="'.$val_array->id.'">'.$val_array->name.'</option>';    
        }
        return $option_reg;
    } 
    
      public static function optionHtmlCountrys(){
        $results = DB::select('SELECT * FROM countrys');  
        $option_reg='';
        foreach($results as $val_array){
        $option_reg.='<option value="'.$val_array-> id.'">'.$val_array->name.'</option>';    
        }
        return $option_reg;
    } 
    
    public function optionHtmlSity($id, $type=false){
        if((!$type) && ($id)){
        $results = DB::select('SELECT * FROM citys WHERE region_id = ?', array($id));
       
        $option_sity='';
        foreach($results as $val_array){
        $option_sity.='<option value="'.$val_array->id.'">'.$val_array->name.'</option>';    
        }
    return $option_sity;} else {
        return false;
    }
    } 
    
    public static function optionHtmlCategory($type=false, $bd='category'){
        $results = DB::select('SELECT * FROM '.$bd);  
        $option_reg='';
        foreach($results as $val_array){
            if(($type===true)&&($val_array->type===1)){continue;}
        $option_reg.='<option value="'.$val_array-> id.'">'.$val_array->name.'</option>';    
        }
        return $option_reg;
    }
    
    public static function transliteratsya($str){
        $trans = array("а" => "a", "б" => "b", "в" => "v", "г"=>"g", "д"=>"d", "е"=>"e", "ё"=>"e", "ж"=>"zh", "з"=>"z", "и"=>"i", "й"=>"y", "к"=>"k", "л"=>"l", "м"=>"m", "н"=>"n", "о"=>"o", "п"=>"p", "р"=>"r", "с"=>"s", "т"=>"t", "у"=>"u", "ф"=>"f", "х"=>"kh", "ц"=>"ts", "ч"=>"ch", "ш"=>"sh", "щ"=>"shch", "ъ"=>"", "ы"=>"y", "ь"=>"", "э"=>"e", "ю"=>"yu", "я"=>"ya"," "=>"-");
     return strtr(mb_strtolower($str), $trans);   
    }

    
    
    
}
