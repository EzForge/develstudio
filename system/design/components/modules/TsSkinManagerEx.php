<?

class TsSkinManagerEx extends __TNoVisual {
    
    public $class_name_ex = __CLASS__;

    public function __construct($onwer=nil,$init=true,$self=nil){
        parent::__construct($onwer, $init, $self);
          
        if ($init){
            $this->skinDirectory = 'skins/';
            $this->skinAll       = true;
            $this->active        = false;
        }
    }
    
    public function __initComponentInfo(){
        
        parent::__initComponentInfo();
        $md = new TsSkinManager($this->parent);
        $md->skinFile = $this->skinFile;
        $md->allowGlowing = false;
        //$md->skinAll  = $this->skinAll;
        
        $md->active = $this->active;
        
        $tmp = $this->name;
        $this->name = '';
        $md->name = $tmp;
        eventEngine::updateIndex($md);
        
        if ($md->active){
            setTimeout(30,'_c('.$md->self.')->updateSkin()');
            $md->updateSkin();
        }
    }
}
?>