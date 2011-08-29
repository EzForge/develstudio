<?
/*
  
  SoulEngine Run-Time Design Library
  
  2009.08 ver 0.2
  
  Dim-S Software (c) 2009
  
  Описание:
    Библиотека для компонентов редактирующих свойств.
  
  
  events:
  
    onSelectClick($panel, $btn)
*/


global $_c;


class TEditBtn extends TPanel {
    
    const BUTTON_HEIGTH = 26;
    
    public $btn;
    public $edit;
    
    public $class_name_ex = __CLASS__;
    
    function set_onSelectClick($str){
        
        $this->btn->onClick = $str;
    }
    
    function set_onKeyPress($str){
        
        $this->edit->onKeyPress = $str;
    }
    
    function set_onKeyUp($str){
        
        $this->edit->onKeyUp = $str;
    }
    
    function set_onKeyDown($str){
        
        $this->edit->onKeyDown = $str;
    }
    
    function set_onChange($str){
        
        $this->edit->onChange = $str;
    }
    
    function __initComponentInfo(){
        
        $this->createComponents();
        $this->initComponents();
        $this->text = $this->atext;
        $this->readOnly = $this->areadOnly;
        $this->caption = $this->acaption;
    }
    
    function __construct($onwer=nil,$init=true,$self=nil){
        parent::__construct($onwer,$init,$self);
        $this->bevelOuter = 'bvNone';
        
        
        if ($init){
            $this->text = '';
            $this->createComponents();
        } else {
            $this->edit = _c($this->edit_link);
            $this->btn  = _c($this->btn_link);
        }
        
        $this->initComponents();
        $this->__setAllPropEx($init);
    }
    
    function createComponents(){
            $this->btn  = new TBitBtn($this);
            $this->btn->parent  = $this;
            
            $this->edit = new TEdit($this);
            $this->edit->parent = $this;
            //$this->edit->height = self::BUTTON_HEIGTH;
            
            $this->edit->name = 'edit';
            $this->btn->name  = 'btn';
            
            $this->edit->text   = '';
            $this->btn->caption = '...';
            
            $this->edit_link = $this->edit->self;
            $this->btn_link  = $this->btn->self;
            
            $this->height = $this->edit->h + 2;
    }
    
    function initComponents(){
        
        $this->caption = ' ';
        $this->edit->left = 0;
        $this->edit->top = 0;
        //$this->edit->height = self::BUTTON_HEIGTH;
        
        $this->edit->width = $this->width - self::BUTTON_HEIGTH - 4;
    
        $this->edit->anchors = 'akLeft, akRight, akTop';
        
        $this->btn->top = 0;
        $this->btn->width = self::BUTTON_HEIGTH;
        $this->btn->height = $this->edit->height;
        $this->btn->left = $this->width - self::BUTTON_HEIGTH;
        $this->caption = ' ';

        $this->btn->anchors = 'akRight, akTop';
        //$this->__getAddSource();
    }
    
    function set_text($v){
        $this->edit->text = $v;
        $this->atext = $v;
    }
    
    function get_text(){
        return $this->edit->text;
    }
    
    function set_caption($v){
        $this->btn->text = $v;
        $this->acaption = $v;
    }
    
    function get_caption(){
        return $this->btn->text;
    }
    
    function set_readOnly($v){
        $this->edit->readOnly = (bool)$v;
        $this->areadOnly = (bool)$v;
    }
    
    function get_readOnly(){
        return $this->edit->readOnly;
    }
    
    function __set($name, $value){
        parent::__set($name, $value);
        
        if ($name=='name'){
            $this->text = $value;
        }
            
        $this->initComponents();
    }
}


class TEditDialog extends TEditBtn {
    
    public $dlg;
    public $dlg_type;
    public $class_name_ex = __CLASS__;
    
    function __initComponentInfo(){
        
        parent::__initComponentInfo();
        
        $class = $this->dlg_type;
        $this->dlg = new $class($this);
        $this->dlg->name = 'dlg';
        $this->filter = $this->afilter;
    }
    
    function __construct($onwer=nil,$init=true,$self=nil){
        parent::__construct($onwer,$init,$self);
        
        $class = $this->dlg_type;
        
        if ($class)
        if ($init){
            $this->dlg = new $class($this);
            //$this->dlg->name = 'dlg';
            $this->dlg_link = $this->dlg->self;
        } else {
            $this->dlg = _c($this->dlg_link);//$this->findComponent('dlg');
        }
        
        $this->onSelectClick = $this->class_name_ex . '::selectDialog';
        $this->__setAllPropEx($init);
    }
    
    function selectDialog($self){
        
        $obj = _c(_c($self)->owner);
        
        if ($obj->dlg->execute()){
            $obj->text = $obj->dlg->fileName;
            
            if ($obj->onSelect)                   
                eval($obj->onSelect . "(".$obj->self.",'" . $obj->dlg->fileName . "');");
        }
        
    }
    
    function set_onSelect($v){
        $this->onSelect = $v;
    }
    
    function set_filter($v){
        
        $this->dlg->filter = $v;
        $this->afilter = $v;
    }
    
    function get_filter($v){
        return $this->dlg->filter;
    }
}

class TEditOpenDialog extends TEditDialog {
    
    public $class_name_ex = __CLASS__;
    
    function __construct($onwer=nil,$init=true,$self=nil){
        $this->dlg_type = 'TOpenDialog';
        parent::__construct($onwer,$init,$self);
    }
}

class TEditSaveDialog extends TEditDialog {
    
    public $class_name_ex = __CLASS__;
    
    function __construct($onwer=nil,$init=true,$self=nil){
        $this->dlg_type = 'TSaveDialog';
       
        parent::__construct($onwer,$init,$self);
         
    }
}


class TEditFontDialog extends TEditDialog {
    
    public $class_name_ex = __CLASS__;
    
    function __construct($onwer=nil,$init=true,$self=nil){
        $this->dlg_type = 'TFontDialog';
       
        parent::__construct($onwer,$init,$self);
        
        $this->readOnly = true;
        $this->text = '('. t('Font options') .')';
    }
    
    function selectDialog($self){
        
        $obj = _c(_c($self)->owner);
        
        if ($obj->dlg->execute()){
            $obj->value = $obj->dlg->font;
            if ($obj->onSelect){
                $font = $obj->dlg->font;
                eval($obj->onSelect . '(' . $obj->self . ',$font);');
            }
            
        } 
    }
    
    function set_value($font){
        $last_size = $this->edit->font->size;
        $this->edit->font->assign($font);
        $this->dlg->font->assign($font);
        $this->edit->font->size = $last_size;
    }
    
    function get_value(){
        return $this->dlg->font;
    }
}

class TEditColorDialog extends TEditDialog {
    
    public $class_name_ex = __CLASS__;
    
    function __initComponentInfo(){
        
        parent::__initComponentInfo();
        $this->color = $this->acolor;
    }
    
    function __construct($onwer=nil,$init=true,$self=nil){
        $this->dlg_type = 'TColorDialog';
       
        parent::__construct($onwer,$init,$self);
        
        $this->readOnly = true;
        $this->value    = $this->dlg->color;
        $this->__setAllPropEx();
    }
    
    function selectDialog($self){
        
        $obj = _c(_c($self)->owner);
        
        if ($obj->dlg->execute()){
            $obj->value = $obj->dlg->color;
            if ($obj->onSelect){
                
                $color = $obj->dlg->color;
                eval($obj->onSelect . '(' . $obj->self . ',$color);');
            }
            
        } 
    }
    
    function set_value($color){
        if ($color == clNone){
            $this->edit->text  = 'None';
            $this->edit->color = clWhite;
        }
        else{
            $this->edit->text  = '0x'.dechex($color);
            $this->edit->color = $color;
        }
        
        
        $this->dlg->color  = $color;
        $this->acolor = $color;
    }
    
    function get_value(){
        return $this->dlg->color;
    }
}

class TEditDMSColorDialog extends TEditDialog {
    
    public $class_name_ex = __CLASS__;
    
    function __construct($onwer=nil,$init=true,$self=nil){
       
        parent::__construct($onwer,$init,$self);
            
        if ($init)
            $this->readOnly = true;
        
        $this->__setAllPropEx($init);
    }
    
    function selectDialog($self){
        
        $obj = _c(_c($self)->owner);
        $dlg = new TDMSColorDialog;
        $dlg->color = $obj->value;
        
        $x = cursor_real_x($dlg->form,10);
        $y = cursor_real_y($dlg->form,10);
        
        if ($dlg->execute($x, $y)){
            $obj->value = $dlg->color;
            if ($obj->onSelect){
                
                $color = $dlg->color;
                eval($obj->onSelect . '(' . $obj->self . ',$color);');
            }
        }
        
        $dlg->free();
    }
    
    function set_value($color){
        
        $this->edit->fontColor = findContrastColor($color);
        $this->edit->color = $color;
        $this->edit->text  = '0x'.dechex($color);
        $this->acolor = $color;
    }
    
    function get_value(){
        return $this->acolor;
    }
}
