<?

class TsSkinProviderEx extends __TNoVisual {
    
    public $class_name_ex = __CLASS__;

    public function __construct($onwer=nil,$init=true,$self=nil){
        parent::__construct($onwer, $init, $self);
          
        if ($init){
            $this->useGlobalColor = false;
	    $this->showAppIcon = true;
	    $this->captionAlignment = taLeftJustify;
	    $this->resizeMode = rmStandart;
        }
    }
    
    public function __initComponentInfo(){
        
        parent::__initComponentInfo();
        $md = new TsSkinProvider($this->parent);
        
        $md->useGlobalColor = $this->useGlobalColor;
	$md->showAppIcon = $this->showAppIcon;
	$md->captionAlignment = $this->captionAlignment;
	$md->resizeMode = $this->resizeMode;
        
        $tmp = $this->name;
        $this->name = '';
        $md->name = $tmp;
        eventEngine::updateIndex($md);
    }
}
?>