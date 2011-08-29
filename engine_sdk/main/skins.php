<?

global $_c;

$_c->setConstList(array('rmStandart', 'rmBorder'),0);

class TsSkinManager extends TControl {
    
    public $class_name = __CLASS__;
    private $_skinAll;
    
    static $classes;
    
    function __construct($onwer=nil,$init=true,$self=nil){
	parent::__construct($onwer,$init,$self);
        
        if (!self::$classes){
            self::$classes['buttons'] = 'TButton';
            self::$classes['bitbtns'] = 'TBitBtn';
            self::$classes['speedbuttons'] = 'TSpeedButton';
            self::$classes['pagecontrol'] = 'TPageControl';
            self::$classes['tabcontrol'] = 'TTabControl';
            self::$classes['edits'] = array();
            self::$classes['checkboxes'] = array();
            self::$classes['groupboxes'] = array();
            self::$classes['listviews'] = 'TListView';
            self::$classes['panels'] = 'TPanel';
            self::$classes['grids']  = 'TStringGrid';
            self::$classes['treeviews'] = 'TTreeView';
            self::$classes['comboboxes'] = 'TComboBox';
            self::$classes['statusbar'] = 'TStatusBar';
            
            self::$classes['edits'] = array('TEdit','TMemo','TMaskEdit','THotKey','TListBox',
                                 'TCheckListBox','TRichEdit','TDateTimePicker');
            self::$classes['checkboxes'] = array('TCheckBox','TRadioButton');
            self::$classes['groupboxes'] = array('TGroupBox'/*,'TRadioGroup'*/);
        }
        
	$this->SkinningRules = 'srStdDialogs, srThirdParty';
        
	$this->skinAll = true;
    }
    
    public function updateSkin(){
        
        skins_updateSkin($this->self);
    }
    
    public function get_skinFile(){
        
        return replaceSl($this->skinDirectory . '/' . $this->skinName . '.asz');
    }
    
    public function set_skinFile($v){
        
        $v = getFileName($v);
        
        $skinName = basenameNoExt($v);
        $skinDir  = dirname($v);
        
        $this->skinDirectory = str_replace('\\\\','\\',replaceSr($skinDir));
        $this->skinName = $skinName;
    }
    
    public function get_skinAll(){
        
        return $this->askinAll;
    }
    
    public function set_skinAll($v){
        $this->askinAll = $v;
        
        $val = $v ? 'def' : '';
        
        $types = array_keys(self::$classes);
        foreach ($types as $type)
            $this->setThirdParty($type, $val);
    }
    
    public function setThirdParty($type, $value){
        
        if ($value=='def')
            $value = self::$classes[$type];
        
        if ( is_array($value) ) $value = implode(_BR_, $value);
        skins_thirdparty($this->self, $type, $value);
    }
    
    public function getThirdParty($type){
        
        $result = skins_thirdparty($this->self, $type, null);
        return explode(_BR_, $result);
    }
}

class TsSkinProvider extends TControl {
    
    public $class_name = __CLASS__;
    
    function __construct($onwer=nil,$init=true,$self=nil){
	parent::__construct($onwer,$init,$self);
        
	if ($init){
	    $this->useGlobalColor = false;
	    $this->showAppIcon = true;
	    $this->CaptionAlignment = taLeftJustify;
	    $this->resizeMode = rmStandart;
	}
    }
}

class TsLabel extends TLabel {
    
    public $class_name = __CLASS__;
    
    
    function __construct($onwer=nil,$init=true,$self=nil){
	parent::__construct($onwer,$init,$self);
        
	if ($init){
	    $this->useSkinColor = false;
	}
    }
}


class TsLabelFX extends TLabel {
    
    public $class_name = __CLASS__;
    
    function __construct($onwer=nil,$init=true,$self=nil){
	parent::__construct($onwer,$init,$self);
        
	if ($init){
	    $this->useSkinColor = false;
	}
    }
}

class TsBitBtn extends TControl {
    
    public $class_name = __CLASS__;
    
    function __construct($onwer=nil,$init=true,$self=nil){
	parent::__construct($onwer,$init,$self);
        
	if ($init){
	    //$this->useSkinColor = false;
	}
    }
}

class TsSpeedButton extends TSpeedButton {
    
    public $class_name = __CLASS__;
    
    function __construct($onwer=nil,$init=true,$self=nil){
	parent::__construct($onwer,$init,$self);
        
	if ($init){
	    //$this->useSkinColor = false;
	}
    }
}


class TsProgressBar extends TProgressBar {
    
    public $class_name = __CLASS__;
}


class TsTrackBar extends TTrackBar {
    
    public $class_name = __CLASS__;
}


class TsBevel extends TBevel {
    
    public $class_name = __CLASS__;
}