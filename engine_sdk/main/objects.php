<?
/* --------------------------------------- */
define('nil',-1);

define('OS_WIN',1);
define('OS_UNIX',2);
define('OS_MACOS',3);
define('__SYSTEM__',OS_WIN);

    switch(__SYSTEM__){
	case OS_WIN: define('_BR_',chr(13).chr(10)); break;
	case OS_UNIX: define('_BR_',chr(13)); break;
	case OS_MACOS: defina('_BR_',chr(10)); break;
	default: define('_BR_',chr(13).chr(13));
    }
    
/* --------------------------------------- */

/* Class for Object with property ala java */
class _Object {  
    
    protected $props = array();
    protected $class_name = __CLASS__;
    
    function __get($nm) {
      $s = 'get_'.$nm;
      $s2 = 'getx_'.$nm;
      $isset = true;
      if (method_exists($this,$s2)){
	return $this->$s2();
      } elseif (method_exists($this,$s))
        return $this->$s();
      elseif (property_exists($this,$nm))
	    return $this->$nm;
      elseif (array_key_exists($nm,$this->props) && method_exists($this,'setx_'.$nm)){
	    return $this->__getPropEx($nm);
      } elseif (array_key_exists($nm,$this->props)) {
            return $this->props[$nm];
      } else {
            return -908067676;
      }
     }
    
    function __set($nm, $val) {
        
	$s = 'set_'.$nm;
	$s2 = 'setx_'.$nm;
	    if (property_exists($this,$nm)){
		$this->$nm = $val;
	    } elseif (method_exists($this,$s2)) {
		$this->props[$nm] = $val;
	    }
	
      if (method_exists($this,$s))
        $this->$s($val);
      if (method_exists($this,$s2))
	$this->$s2($val);
     }
}

/* General class TObject from Delphi */
class TObject extends _Object {
    
    public $self;
    
    function get_className(){
	return rtii_class($this->self);
    }
    
    function isClass($class){
	if (is_array($class)){
	    $s_class = strtolower($this->className);
	    foreach ($class as $el)
		if (strtolower($el)==$s_class)
		    return true;
	    return false;
	} else {
	    $class = strtolower($class);
	    return $class==strtolower($this->className);
	}
    }
    
    function __construct($init = true){
        $this->self = component_create(__CLASS__,nil);
	
    }
    
    function free(){
	
	if (link_null($this->self))
	    return;
	
	if (class_exists('animate'))
	    animate::objectFree($this->self);
	
	obj_free($this->self);	
    }
    
    function destroy(){
        $this->free();
    }

}

function rtii_set($obj,$prop,$val){__rtii_set($obj->self,$prop,$val);}
function rtii_get($obj,$prop){return __rtii_get($obj->self,$prop);}
function rtii_exists($obj,$prop){return __rtii_exists($obj->self,$prop);}

function rtii_is_object($obj, $class){
    return __rtii_is_class($obj->self, $class);
}

function get_owner($obj){return cntr_owner($obj->self);}

function obj_create($class,$onwer,&$obj){
	//$onwer->components[] = $obj;
	if (is_object($onwer) && property_exists($onwer, 'self')){
		return component_create($class,$onwer->self);
	}
	else
		return component_create($class,nil);
}

/* TComponent class ala Delphi */
class TComponent extends TObject {
	
	#public hekpKeyword // здесь храняться все нестандартные свойства
	
	function getHelpKeyword(){
	    
	    return control_helpkeyword($this->self, null);
	}
	
	function setHelpKeyword($v){
	    control_helpkeyword($this->self, $v);
	}
	
	// доп инфа для нестандартных свойств
	function __addPropEx($nm, $val){
	    
	    if (!is_string($val) && !is_integer($val) && !is_float($val) && !is_bool($val)){
		if (is_array($val))
		    $val = serialize($val);
		else
		    return;
	    }
	    
	    $class = $this->class_name_ex ? $this->class_name_ex : $this->class_name;
	    $result = unserialize(base64_decode($this->getHelpKeyword()));
	    
	    $nm = strtolower($nm);
	    
	    if ($val===NULL)
		unset($result['PARAMS'][$nm]);
	    else
		$result['PARAMS'][$nm] = $val;
	    
	    $this->setHelpKeyword( base64_encode(serialize(
			array('CLASS' => $class,
			      'PARAMS'=> $result['PARAMS'], 
			)))
				);
	}
	
	function __setClass(){
	    $class = $this->class_name_ex ? $this->class_name_ex : $this->class_name;
	    
	    $result = unserialize(base64_decode($this->getHelpKeyword()));
	    
	    //if (function_exists('msg')) pre($result);
	    $this->helpKeyword = base64_encode(serialize(
			array('CLASS' => $class,
			      'PARAMS'=> $result['PARAMS'], 
			)));
	}
	
	// достаем свойство...
	function __getPropEx($nm){
	    
	    $nm = strtolower($nm);
	    $result = unserialize(base64_decode($this->getHelpKeyword()));
	    
	    if (!isset($result['PARAMS'][$nm])) return NULL;
	    
	    if (strpos($result['PARAMS'][$nm],':{')!==false){
		return unserialize($result['PARAMS'][$nm]);
	    } else {
		return $result['PARAMS'][$nm];
	    }
	}
	
	static function __getPropExArray($self){
	    
	    $result = unserialize(base64_decode(control_helpkeyword($self, null)));
	    
	    foreach ($result['PARAMS'] as $nm=>$value){
		if (strpos($result['PARAMS'][$nm],':{')!==false){
		    $result['PARAMS'][$nm] = unserialize($result['PARAMS'][$nm]);
		}
	    }
	    
	    return $result['PARAMS'];
	}
	
	function __setAllPropEx($init = true){
	    
	    if ($init)
		$this->__setClass();
	    
	    /*if (!property_exists($this,'font')) return;
	    
	    $result = unserialize(base64_decode(  $this->getHelpKeyword()  ));
	    
	    foreach ((array)$result['PARAMS'] as $prop=>$value){
		
		if (method_exists($this,'setx_'.$prop)){
		    
		    $prop = strtolower($prop);
		    $this->props[strtolower($prop)] = $value;
		    $this->$prop        = $value;
		}
	    }*/
	}
	
	function __setAllPropX(){
	    $result = unserialize(base64_decode(  $this->getHelpKeyword()  ));
	    
	    foreach ((array)$result['PARAMS'] as $prop=>$value){
		
		$this->props[strtolower($prop)] = $value;
		$this->$prop        = $value;
	    }
	}
	
	function __initComponentInfo(){
	    
	    $this->visible = $this->avisible;
	    $this->enabled = $this->aenabled;
	}
	
	function __construct($onwer = nil,$init = true,$self = nil){
	    if ($init){
		
		$this->self = obj_create($this->class_name,$onwer,$this);
	    }
	    
            if ($self != nil)
                $this->self = $self;
	    
	    $this->__setAllPropEx($init);
	    
	    /*if ($init)
		$GLOBALS['__to_object'][$this->self] = $this;*/
	}
	
	function set_prop($prop,$val){
	    //if ($val===null) $val = 0;
		rtii_set($this,$prop,$val);
	}
        
	function get_prop($prop){
		$result = rtii_get($this,$prop);
		
		if ($result==='True') $result = true;
		elseif ($result==='False') $result = false;
		
		return $result;
	}
	
	function exists_prop($prop){
		return rtii_exists($this,$prop);
	}
	
	function __set($nm,$val){
		
		$nm = strtolower($nm);
		
		if (!method_exists($this,'set_'.$nm))
		if ($this->class_name!='TWebBrowser' && $this->class_name!='TScreenEx' && $this->class_name!='TPen' && $this->class_name!='TImageList'){
		    
		    if ($nm=='visible'){
			return control_visible($this->self, $val);
		    } elseif ($nm=='left'){
			return control_x($this->self, $val);
		    } elseif ($nm=='top'){
			return control_y($this->self, $val);
		    } elseif ($nm=='width'){
			return control_w($this->self, $val);
		    } elseif ($nm=='height'){
			return control_h($this->self, $val);
		    }/* elseif ($nm=='hint'){
			return control_hint($this->self, $val);
		    }*/
		}
				  
		if (strtolower(substr($nm,0,2)) == 'on'){
		    //if ( !method_exists($this, 'set_'.$nm) ){
		    $result = set_event($this->self,$nm,$val);
		    if ( method_exists($this, 'set_'.$nm) ){
			$method = 'set_'.$nm;
			$this->$method($val);
		    }
		    if ($result) return;
		}
		
		if (!$this->exists_prop($nm)){
			$this->__addPropEx($nm,$val);
			parent::__set($nm,$val);
		} else {
		    $s = 'set_'.$nm;
		    if (method_exists($this,'set_'.$nm))
			$this->$s($val);
		    else
			$this->set_prop($nm,$val);
		}
	}
	
	function __get($nm){
            
	    $nm = strtolower($nm);
	    $res = parent::__get($nm);
	    
		if (!method_exists($this,'get_'.$nm))
		if ($this->class_name!='TScreenEx' && $this->class_name!='TPen' && $this->class_name!='TImageList'){
		    
		    if ($nm == 'visible'){
			return control_visible($this->self, null);
		    } elseif ($nm=='left'){
			return control_x($this->self, null);
		    } elseif ($nm=='top'){
			return control_y($this->self, null);
		    } elseif ($nm=='width'){
			return control_w($this->self, null);
		    } elseif ($nm=='height'){
			return control_h($this->self, null);
		    }/* elseif ($nm=='hint'){
			return control_hint($this->self, null);
		    }*/
		}
			    
	    if (is_int($res) && ($res == -908067676)){
		    
		    $result = $this->__getPropEx($nm);
		    if ($result === NULL)
			return $this->get_prop($nm);
		    else
			return $result;
		}
		else
			return $res; 
	}
	
	function get_x(){
	    return $this->left;
	}
	
	function set_x($v){
	    $this->left = (int)$v;
	}
	
	function get_y(){
	    return $this->top;
	}
	
	function set_y($v){
	    $this->top = (int)$v;
	}
	
	function get_w(){
	    return $this->width;
	}
	
	function set_w($v){
	    
	    $this->width = (int)$v;
	}
	
	function create($form = null){
	    
	    $form = $form == null ? $this->owner : $form;
	    if (is_object($form))
		$form = $form->self;
		
	    return component_copy($this->self, $form);
	}
}

class TFont extends _Object {
	
	public $self;
	
	function prop($prop){
	    
	    return __rtii_get(__rtii_link($this->self, 'Font'), $prop);
	}
	
	function set_name($name){font_prop($this->self,'name',$name);}
	function set_size($size){font_prop($this->self,'size',$size);}
	function set_color($color){font_prop($this->self,'color',$color);}
	function set_charset($charset){font_prop($this->self,'charset',$charset);}
	function set_style($style){
	    
	    if (is_array($style)) $style = implode(',', $style);
	    font_prop($this->self,'style',$style);}
	
	function get_name(){ return $this->prop('name'); }
	function get_color(){ return $this->prop('color'); }
	function get_size(){ return $this->prop('size'); }
	function get_charset(){ return $this->prop('charset'); }
	function get_style(){
	    
	    $result = $this->prop('style');
	    $result = explode(',',$result);
	    foreach ($result as $x=>$e)
		$result[$x] = trim($e);
	    return $result;
	}
	
	function assign($font){
	    font_assign($this->self, $font->self);
	}
}

/* TControl is visual component */
class TControl extends TComponent {
	
	public $class_name = __CLASS__;
	protected $_font;
	#public $avisible;
	
	function __construct($onwer=nil,$init=true,$self=nil){
		parent::__construct($onwer,$init);
			
		if ($self!=nil) $this->self = $self;
		if ($init){
		    $this->avisible = $this->visible;
		    $this->aenabled = $this->enabled;
		}
		
		$this->__setAllPropEx($init);
	}
	
	function get_font(){
	    
	    if (!isset($this->_font)){
		$this->_font = new TFont;
		$this->_font->self = $this->self;
	    }
		
	    return $this->_font;
	}
	
	function set_parent($obj){
	    
	    if (is_object($obj))
		cntr_parent($this->self,$obj->self);
	    elseif (is_numeric($obj))
		cntr_parent($this->self, $obj);
	}
	
	function get_parent(){
	    return _c(cntr_parent($this->self,null));
	}
	
	function parentComponents(){
	    
	    $result = array();
	    $components = $this->controlList;
	    
	    foreach ($components as $el){
		
		if ($el){
		    $result[] = $el;
		    $result   = array_merge($result, $el->parentComponents());
		}
	    }
	    
	    return $result;
	}
	
	// возвращает список всех компонентов объекта по паренту, а не onwer'y
	function childComponents($recursive = true){
	    
	    $result = array();
	    $owner  = c($this->get_owner());
	    $links  = $owner->get_componentLinks();
	   
	    foreach ($links as $link){
		
		if ( cntr_parent($link,null) == $this->self ){
		    $el = c($link);
		    $result[] = $el;
		    if ($recursive)
			$result = array_merge($result, $el->childComponents());
		}
	    }
	    
	    return $result;
	}
	
	function set_visible($v){
	    $this->avisible = $v;
	    $this->set_prop('visible',$v);
	}
	
	function setx_avisible($v){
	    //
	}
        
        function get_owner(){
            return get_owner($this);
        }
        
        function findComponent($name,$type = 'TControl'){
            $id = find_component($this->self,$name);
	    
            return _c($id);
        }
        
        function componentById($id,$type = 'TControl'){
            return _c(component_by_id($this->self,$id));
        }
        
        function componentCount(){
            return component_count($this->self);
        }
	
	function controlById($id){
	    return _c(control_by_id($this->self, $id));
	}
	
	function controlCount(){
	    return control_count($this->self);
	}
	
	function get_componentIndex(){
	    return component_index($this->self);
	}
	
	function get_controlIndex(){
	    return control_index($this->self);
	}
        
        function get_componentList(){
            $res = array();
            $count = $this->componentCount();
	    
            for ($i=0;$i<$count;$i++){
                $res[] = $this->componentById($i);
            }
            
            return $res;
        }
	
        function get_controlList(){
            $res = array();
            $count = $this->controlCount();
            for ($i=0;$i<$count;$i++){
                $res[] = $this->controlById($i);
            }
            
            return $res;
        }
	
	function get_componentLinks(){
	    
	    $res = array();
            $count = $this->componentCount();
            for ($i=0;$i<$count;$i++){
		
		/*if ($GLOBALS['__x']){
		    c('fmMain')->text = $count.' - '.$i;
		//    pre($count.' - '.$i);
		}*/
		
		$res[] = component_by_id($this->self,$i);
            }
            
	    return $res;
	}
        
	function show(){ $this->visible = true; }
	function hide(){ $this->visible = false; }
	
	function get_handle(){
	    return __get_handle($this->self);
	}
	
	function get_h(){
	    
	    return $this->height;
	}
	function set_h($v){
	    $this->height = (int)$v;
	}
	
	function get_fontsize()  { return $this->font->size; }
	function set_fontsize($v){ $this->font->size = $v; }
        
	function get_fontname()  { return $this->font->name; }
	function set_fontname($v){ $this->font->name = $v; }
	
	function get_fontcolor()  { return $this->font->color; }
	function set_fontcolor($v){ $this->font->color = $v; }
	
	function setDate(){
	    
	    if ($this->exists_prop('caption'))
		$this->caption = date('Y.m.d');
	    elseif ($this->exists_prop('text'))
		$this->text    = date('Y.m.d');
	}
	
	function setTime(){
	    
	    if ($this->exists_prop('caption'))
		$this->caption = date('H:i:s');
	    elseif ($this->exists_prop('text'))
		$this->text    = date('H:i:s');
	}
	
	function repaint(){
	    
	    control_repaint($this->self);
	}
	
	function toBack(){
	    control_to_back($this->self);
	}
	
	function toFront(){
	    control_to_front($this->self);
	}
	
	function set_doubleBuffer($v){
	    control_doublebuffer($this->self,$v);
	}
	function get_doubleBuffer(){
	    return control_doublebuffer($this->self,null);
	}
	
	function set_doubleBuffered($v){
	    $this->doubleBuffer = $v;
	}
	
	function get_doubleBuffered(){
	    return $this->doubleBuffer;
	}
	
	function setFocus(){
	    
	    if ( $this->visible && $this->enabled )
	    control_focus($this->self);
	}
	
	function get_focused(){
	    return control_focused($this->self);
	}
	
	function set_text($v){
	    if ($this->exists_prop('text')){
		$this->set_prop('text',$v);
	    }
	    elseif ($this->exists_prop('caption'))
		$this->caption = $v;
	    elseif ($this->exists_prop('itemstext'))
		$this->itemsText = $v;
	}
	
	function get_text(){
	    if ($this->exists_prop('text'))
		return $this->get_prop('text');
	    elseif ($this->exists_prop('caption'))
		return $this->caption;
	    elseif ($this->exists_prop('itemstext'))
		return $this->itemsText;
	}
	
	function set_popupMenu($menu){
	    popup_set($menu->self, $this->self);
	}
	
	function perform($msg, $hparam, $lparam){
	    
	    return control_perform($this->self, $msg, $hparam, $lparam);
	}
	
	function invalidate(){
	    control_invalidate($this->self);
	}
	
	function manualDock($obj, $align = 0){
	    
	    return control_manualDock($this->self, $obj->self, $align);
	}
	
	function manualFloat($left, $top, $right, $bottom){
	    
	    return control_manualFloat($this->self, $left, $top, $right, $bottom);    
	}
	
	function dock($obj, $left, $top, $right, $bottom){
	    
	    control_dock($this->self, $obj->self, $left, $top, $right, $bottom);    
	}
	
	function get_dockOrientation(){
	    return control_dockOrientation($this->self);
	}
	
	function dockSaveToFile($file){
	    
	    control_docksave($this->self, $file);
	}
	
	
	function dockLoadFromFile($file){
	    
	    control_dockload($this->self, $file);
	}
	
	function dockClient($index){
	    
	    return _c(control_dockClient($this->self, $index));
	}
	
	function get_dockClientCount(){
	    return control_dockClientCount($this->self);
	}
	
	function get_dockList(){
	    
	    $result = array();
	    $c = $this->get_dockClientCount();
	    
	    for($i=0;$i<$c;$i++)
		$result[] = $this->dockClient($i);
		
	    return $result;
	}
	
	function get_canvas(){
	    
	    return _c(component_canvas($this->self));
	}
	
	function set_hint($hint){
	    
	    $this->showHint = (bool)$hint;
	    $this->set_prop('hint', (string)$hint);
	}
}

function to_object($self, $type='TControl'){
	$type = trim($type);
        if (!class_exists($type)){
	    return false;
        } else {
	    
	    //if (!isset($GLOBALS['__to_object'][$self]) || link_null($self))
	    /*if (isset($GLOBALS['__to_object'][$self]))
		unset($GLOBALS['__to_object'][$self]);
		
		$GLOBALS['__to_object'][$self] = */

            return new $type(nil,false,$self);
        }
}

function rtii_class($self){
    
    $help = control_helpkeyword($self, null);
    if ($help){
	$help = unserialize(base64_decode($help));
	if (class_exists($help['CLASS']))
	    return $help['CLASS'];
	else {
	    return __rtii_class($self);
	}
    }
    
    
    return __rtii_class($self);
}

function asObject($obj,$type){
    return to_object($obj->self,$type);
}

function reg_object($form,$name){
    return to_object(reg_component($form,$name));
}

function setEvent($form,$name,$event,$func){
    $obj = reg_object($form,$name);
    set_event($obj->self,$event,$func);
}

function findComponent($str,$sep = '->',$asObject='TControl'){
    // $str = 'FormName->Onwer->Component';
    global $SCREEN, $COMPONENT_COOL_CACHE;
    
    $str = str_replace('.', $sep, $str);
    $names = explode($sep,$str);
    $onwer = $GLOBALS['APPLICATION'];
    $x     = true;
    
    for ($i=0;$i<count($names);$i++){
	
	if ( !$onwer ) return null;
    
        $onwer = $onwer->findComponent($names[$i]);
	
	if ($x && !$onwer){
	    
	    if ($GLOBALS['__ownerComponent'])
		$onwer = c($GLOBALS['__ownerComponent']);
	    else
		$onwer = $SCREEN->activeForm;
	    
	    $i--;
	    $x = false;
	    
	}
    }
    
   
    return $onwer;
}

function _c($self = false){
    
    if ($self===false) return;
    
    return to_object($self,rtii_class($self));
}

function c_Alias($org, $alias){
    
    $GLOBALS['__OBJ_ALIAS'][$org][] = $alias;
}

function c($str,$cached = false){
    
    if (is_numeric($str))
	return _c($str);
    
    if (isset($GLOBALS['__OBJ_ALIAS'])){
		foreach ($GLOBALS['__OBJ_ALIAS'] as $org=>$alias){
			$str = str_ireplace($alias, $org, $str);
		}
    }
    
    $res = findComponent($str);
    
    $result = asObject($res,rtii_class($res->self));
    
    return $result;
}

function с($str, $cached = false){
    return c($str, $cached);
}

// cSetProp('form.object.caption', 'text')
function cSetProp($str, $value){
    
    $str = strtolower($str);
    $str = str_replace('font.','font',$str);
    
    $str = str_replace('->','.',$str);
    $obj = substr($str, 0, strrpos($str,'.'));
    $method = substr($str, strrpos($str, ".")+1, strlen($str) - strrpos($str, '.'));
    
    $obj = c($obj);
    
    if (is_object($obj)){
	
	$obj->$method = $value;
	return true;
    }
    else
	return false;
}

// cGetProp('MainForm->Button_1->Caption');
function cGetProp($str){
    
    $str = strtolower($str);
    $str = str_replace('font.','font',$str);
    
    $str = str_replace('->','.',$str);
    $obj = substr($str, 0, strrpos($str,'.'));
    $method = substr($str, strrpos($str, ".")+1, strlen($str) - strrpos($str, '.'));

    
    $obj = c($obj);
    if (is_object($obj))
	return $obj->$method;
    else
	return NULL;
}

// alias of cGetProp
function p($str){
    return cGetProp($str);
}

// cCallMethod('form.object.setFocus')
function cCallMethod($str){
    
    $str = strtolower($str);
    $str = str_replace('font.','font',$str);
    
    $str = str_replace('->','.',$str);
    $obj = substr($str, 0, strrpos($str,'.'));
    $method = substr($str, strrpos($str, ".")+1, strlen($str) - strrpos($str, '.'));
    
    $obj = c($obj);
    if (is_object($obj))
	return $obj->$method();
    else
	return NULL;
}

function cMethodExists($str){
         
    $str = strtolower($str);
    $str = str_replace('font.','font',$str);
    
    $str = str_replace('->','.',$str);
    $obj = substr($str, 0, strrpos($str,'.'));
    $method = substr($str, strrpos($str, ".")+1, strlen($str) - strrpos($str, '.'));
    
    $obj = c($obj);
    if (is_object($obj)){
	return method_exists($obj, $method);
    }
    else
	return false;
}

function val($str, $value = null){
    $obj = toObject($str);
    
    $prop = 'text';
    
    if ($obj instanceof TCheckBox)
	$prop = 'checked';
    elseif ($obj instanceof TListBox)
	$prop = 'itemIndex';
    
    if ($value===null){
	return $obj->$prop;
    } else {
	$obj->$prop = $value;
    }
}

?>