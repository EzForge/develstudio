<?

class TFunction extends __TNoVisual {
    
    public $class_name_ex = __CLASS__;
    public $rand;
    #public $icon = 'F';
    #parameters
    #description
    
    public function __inspectProperties(){
	
	return array('parameters','description','toRegister','workBackground','priority');
    }
    
    public function __initComponentInfo(){
        
        parent::__initComponentInfo();
	
        if ($this->callOnStart)
            $GLOBALS['___startFunctions'][] = 'c('.$this->self.')->call();';
    }
    
    public function __construct($onwer=nil,$init=true,$self=nil){
	parent::__construct($onwer, $init, $self);
	
        if ($init){
	    $this->priority = tpIdle;
            $this->toRegister = true;
	    //$this->color = 0x0;
	}
    }
    
    function call(){
	
	
	if (!$this->onExecute) return null;
	
	$args  = func_get_args();
	
	
	$names = array($this->self, '$names');
	$names = array_merge($names,explode(_BR_,trim($this->parameters)));
	
	    foreach ($names as $i=>$var){
		$var  = str_replace('$','',$var);
		
		if ($i>1)
		$$var = $args[$i-2];
	    }
	    
	    if (!$names[count($names)-1])
		unset($names[count($names)-1]);
	
	    return eval('return '.$this->onExecute . '('.implode(',',$names).');');
    }
    
    function stop(){
	
	$t =& $GLOBALS['TFunction']['thread'][$this->self];
	
	if ($t){
	    $code = $t->code;
	    $priority = $t->priority;
	    $t->suspend();
	    $t = new Thread;
	    $t->code = $code;
	    $t->priority = $priority;
	}
    }
    
    function isWorking(){
	
	$t =& $GLOBALS[__CLASS__]['thread'][$this->self];
	if ($t)
	    return $t->isWorking();
    }
    
    // универсальный метод
    function __register($form_name, $name, $info, $eventList){
	
	$prs = $info['parameters'];
	if (strpos($prs,_BR_)===false)
	    $names = $prs;
	else
	    $names = implode(',',explode(_BR_,$info['parameters']));
	
	//$names_a = "'" . str_replace(',',"','", $names) . "'";
	
	if (!$name) $name = $this->name;
	
        if ($info['workBackground']){
		    $code = _BR_.'function ___thread_'.$name.'('.$names.'){ eval(enc_getValue("__incCode"));';
		    if (is_array($eventList))
		        $code.= $eventList['onexecute'];
		    else
		        $code.= $eventList;
		    
                    $code.= _BR_.'}';
                    
                    $code .= _BR_.'function '.$name.'('.$names.'){';
                    
		    if (!$form_name)
			$code .= '$self = '.$this->self.';';
		    else
			$code .= '$self = c("'.$form_name.'->'.$name.'")->self;';
			
		    $code .= ' __exEvents::setEventInfo($self, "onexecute");';
                    $code .= ' if (!isset($GLOBALS["TFunction"]["thread"][$self])) ';
		    $code .= '$GLOBALS["TFunction"]["thread"][$self] = new Thread;';
		    
		    $code .= '$arr = array();';
		    $x_names = explode(',',$names);
		    foreach ($x_names as $x_name){
			if ($x_name!='')
			$code .= '$arr["'.str_replace('$','',trim($x_name)).'"] = '.trim($x_name).';';
		    }
		    
		    $code .= 'v("params_".$self, $arr); unset($arr); ';
		    $code .= ' $t =& $GLOBALS["TFunction"]["thread"][$self];';
		    $code .= ' $t->priority = ' . (int)$info['priority'] . ';';
		    
		    $code .= ' $t->code =
		    \'__exEvents::setEventInfo(\'.$self.\', "onexecute");
		        if (function_exists("___thread_'.$name.'"))
			    call_user_func_array("___thread_'.$name.'", v("params_\'.$self.\'"));
		    __exEvents::freeEventInfo();\';';
			
		    $code .= ' $t->start();';
                    
                    $code.= '__exEvents::freeEventInfo(); }';
		        
	} else {
            
	    $real_names = explode(',', trim($names));
	    foreach ($real_names as $i=>$item)
		if (strpos($item,'=')!==false)
		    $real_names[$i] = trim(substr($item,0,strpos($item,'=')));
	    
	    $code = _BR_.'function _______'.$name.'('.$names.'){ eval(enc_getValue("__incCode"));';
	    if (!$form_name)
		$code .= '$self = '.$this->self.';';
	    else	
		$code .= '$self = c("'.$form_name.'->'.$name.'")->self;';
	    
	    $code.= ' __exEvents::setEventInfo($self, "onexecute");';
            if (is_array($eventList))
		$code.= $eventList['onexecute'] . _BR_;
            else
		$code.= $eventList . _BR_;
		
	    $code.= '; }';
	    
	    // обязательно надо делать так, иначе если у ф-ии будет ретурн, то пространство формы не высвободится
	    // и получится глюк при обращении к коротким именам компонентов, вот так вот :(
	    $code .= _BR_.' function '.$name.'('.$names.'){
		 $result = _______'.$name.'('.implode(',',$real_names).');
		 __exEvents::freeEventInfo();
		 return $result;
		}' ;
        }
	
	
	return $code;
        
    }
    
    function register($name = false){
	
	if (!$name) $name = $this->name;
		
	if (function_exists($name)){
	    //pre('Function "'.$name.'" already exists!');
	} elseif ($this->onExecute) {
	    
	    	$code = __exEvents::getEvent($this->self, 'onexecute');
		$info['parameters'] = $this->parameters;
		$info['workBackground'] = $this->workBackground;
		$info['priority']   = $this->priority;
		
		$code = $this->__register('',$name,$info,$code);
		Thread::addCode($code);
		eval ($code);
	}
    }
    
}

function f($function){
	
	if (!is_object($function)){
	    $function = str_replace(array('.','::'),'->',$function);
	    $func = c($function, true); // cached
	} else {
	    $func =& $function;
	}
	
	if (!$func)
	    return msg('"'.$function.'" - function not found!');
	
	
	$args = func_get_args();
	unset($args[0]);
	$args = array_values($args);
	
	$names = array();
	foreach ($args as $i=>$var){
	    $var     = 'var'.$i;
	    $$var    = $args[$i];
	    $names[] = '$'.$var;
	}
	
	return eval('return $func->call(' . implode(',',$names) . ');');
}

function __callFunction($function, $self){
    
    $function = str_replace(array('.','::'),'->',$function);
    $func = c($function, true); // cached
    
	if (!$func)
	    return msg('"'.$function.'" - function not found!');
	
	$func->parameters = '$self'._BR_.'$obj';
    
    return eval('return $func->call(' . $func->self .',_c('. $self . '));');
}

?>