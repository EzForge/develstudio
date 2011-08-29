<?

if ( !class_exists('__TNoVisual') ){


class __TNoVisual extends TControl {
    
    public $class_name = __CLASS__;
    
    function __initComponentInfo($init = true){
	$this->hide();
	//$this->visible = false;
	//pre('!!!!!!');
    }
    
    
    public function __construct($onwer=nil,$init=true,$self=nil){
        
	parent::__construct($onwer, $init, $self);
		
	    if ($init){
		$this->realWidth  = 26;
		$this->realHeight = 26;
		
		$this->showHint = true;
		$this->hint = $this->name;
		
	        if ($GLOBALS['APP_DESIGN_MODE']){
	            $this->__loadDesign();
	        }
	    } else {
		//$this->icon = $this->findComponent('image');
	    }
	   
	
        //$this->__setAllPropEx($init);
    }
    
    public function __updateDesign(){
	
	$this->toFront();
	$this->initLabel();
    }
    
    static function __doMouseEnter($self){
	
	_c($self)->initLabel();
    }
    
    static function __doMouseLeave($self){
	
	$obj = _c($self);
	$obj->panel->free();
	$obj->panel = '';
	$obj->label = '';
    }
    
    public function __loadDesign(){	
	
	$this->setImage(myImages::get24($this->class_name_ex));
	$this->onDblClick = '__TNoVisual::panelDblClick';
    }
    
    public function __pasteDesign(){	
	
	$this->setImage(myImages::get24($this->class_name_ex));
	$this->onDblClick = '__TNoVisual::panelDblClick';
    }
        
    function set_visible($v){
	//pre($v);
	//__rtii_set($this->self, 'visible', (bool)$v);
	$this->set_prop('visible', (bool)$v);
    }
	
    function get_visible(){
	return $this->get_prop('visible');
    }
    
    public function threadExec($function, $param = false){
	
	    $code = $function.'('.$this->self.', c('.$this->self.')->tmp_param); ';
            $this->tmp_param = $param;
            $tmp = getGlobalVar($this->thread_var);
            if ($tmp)
                $t =& $tmp;
            else {
                $t = new Thread;
                $this->thread_var = registerGlobalVar($t);
            }
            
            $t->code = $code;
            $t->priority = $this->priority;
            $t->start();
    }
    
    function stop(){
        
        $t = getGlobalVar($this->thread_var);
        if ($t){
        
            $t->terminateAndWaitFor();
            unsetGlobalVar($t->thread_var);
        }
    }
    
    function pause(){
        
        $t = getGlobalVar($this->thread_var);
        if ($t)
            $t->suspend();
    }
    
    static function panelDblClick($self){
	
	$name = inputText(t('To change name of object'),t('New Name'),_c($self)->caption);
	
	if ($name){
	    
	    if (!eregi('^[a-z]{1}[a-z0-9\_]*$',$name)) return;
	    
	    myDesign::changeName(_c(_c($self)->obj), $name);
	    global $myProperties;
	    $myProperties->updateProps();
	}
    }
    
    
    static function panelClick($self){
	
	global $_sc;
	$_sc->clearTargets();
	    
	myDesign::selectComponent($_sc->self, _c($self)->obj, 0, 0);
	_c(_c($self)->obj)->toFront();
	_c(_c(_c($self)->obj)->panel)->toFront();
	$_sc->addTarget(_c(_c($self)->obj));
    }
    
    function initLabel($self = false){
	    
	return;
    }
    
    public function setImage($file){	
	
	//return;
	
	if (!file_exists($file))
	    $file = myImages::get24('component');
	
	$this->__iconName = replaceSr($file);
    }
}

}
?>