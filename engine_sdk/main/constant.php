<?

class myVars {
    
    static function set($var, $name){
        
        $GLOBALS[$name] = $var;
    }
    
    static function set2(&$var, $name){
        $GLOBALS[$name] =& $var;
    }
    
    static function get($name){
        
        if (isset($GLOBALS[$name]))
            return $GLOBALS[$name];
        else
            return false;
    }
}

class TConstantList{
	
	public $defines;
	
	function __set($nm,$val){
	    if (!defined($nm)){
	    $this->defines[$nm] = $val;
		define($nm,$val, false);
	    }
	}
	
	function __get($nm){
	 
	    return $this->defines[$nm];   
	}
	
	function setConstList($names,$beg = 1){
		for($i=0;$i<count($names);$i++){
		    if (! defined($names[$i]) ){
			define($names[$i],$i+$beg, false);
			$this->defines[$names[$i]] = $i+$beg;
		    }
		}
	}
}


$GLOBALS['_c'] = new TConstantList;
?>