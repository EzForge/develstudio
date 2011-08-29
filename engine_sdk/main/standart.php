<?
/*
  
  SoulEngine Standart Library
  
  2009 ver 0.1
  
  Dim-S Software (c) 2009
  
				TLabel, TEdit, TMemo, TCheckBox, TRadioButton, TListBox,
                TComboBox, TScrollBar, TGroupBox, TRadioGroup, TPanel
  
*/


global $_c;

$_c->setConstList(array('csDropDown', 'csSimple', 'csDropDownList', 'csOwnerDrawFixed',
    'csOwnerDrawVariable'),0);

$_c->setConstList(array('taLeftJustify', 'taRightJustify', 'taCenter'),0);
$_c->setConstList(array('tlTop', 'tlCenter', 'tlBottom'),0);
$_c->setConstList(array('ecNormal', 'ecUpperCase', 'ecLowerCase'),0);
$_c->setConstList(array('ssNone', 'ssHorizontal', 'ssVertical', 'ssBoth'),0);
$_c->setConstList(array('bvNone', 'bvLowered', 'bvRaised', 'bvSpace'),0);

$_c->setConstList(array('doNoOrient', 'doHorizontal', 'doVertical'),0);
//$_c->setConstList(array('mrNone','mrOk','mrCancel','mrAbort','mrRetry','mrIgnore','mrYes','mrNo','mrAll','mrNoToAll','mrYesToAll'),0);

class TLabel extends TControl {
	public $class_name = __CLASS__;
}


class TEdit extends TControl {
	public $class_name = __CLASS__;
	
	function set_passwordChar($v){
		
		$this->set_prop('passwordChar', ord($v));
	}
	
	function get_passwordChar(){
		return chr($this->get_prop('passwordChar'));
	}
	
	function get_selText(){	return edit_seltext($this->self, null); }
	function set_selText($v){ edit_seltext($this->self, (string)$v); }
	
	function get_selStart(){ return edit_selstart($this->self, null); }
	function set_selStart($v){ edit_selstart($this->self, (int)$v); }
	
	function get_selLength(){ return edit_sellength($this->self, null); }
	function set_selLength($v){ edit_sellength($this->self, (int)$v); }
	
	function selectAll(){ edit_selectall($this->self); }
	
	public function undo(){ edit_undo($this->self); }
    
	public function copyToClipboard(){ edit_copytoclipboard($this->self); }
	public function cutToClipboard(){ edit_cuttoclipboard($this->self); }
	public function pasteFromClipboard(){ edit_pastefromclipboard($this->self); }
	public function clearSelected(){ edit_clearselection($this->self); }
	public function clearSelection(){ $this->clearSelected(); }
	
}

class TMemo extends TControl {	
	public $class_name = __CLASS__;
	protected $_items;
	
	function get_items(){
		if (!isset($this->_items)){
			$this->_items = new TStrings(false);
			$this->_items->self = __rtii_link($this->self,'Lines');
		}
		return $this->_items;
	}
	
	function get_lines(){
		return $this->items;
	}
	
	function set_lines(object $strings){
		$this->items->assign($strings);
	}
	
	function set_text($v){
		$this->items->text = $v;
	}
	
	function get_text(){
		return $this->items->text;
	}
	
	function loadFromFile($fileName){
		$fileName = getFileName($fileName);
		$this->items->loadFromFile($fileName);
	}
	
	function saveToFile($fileName){
		$fileName = getFileName($fileName);
		$this->items->saveToFile($fileName);
	}
	
	function get_selText(){	return edit_seltext($this->self, null); }
	function set_selText($v){ edit_seltext($this->self, (string)$v); }
	
	function get_selStart(){ return edit_selstart($this->self, null); }
	function set_selStart($v){ edit_selstart($this->self, (int)$v); }
	
	function get_selLength(){ return edit_sellength($this->self, null); }
	function set_selLength($v){ edit_sellength($this->self, (int)$v); }
	
	function selectAll(){ edit_selectall($this->self); }
	public function undo(){ edit_undo($this->self); }
	public function redo(){ edit_redo($this->self); }
    
	public function copyToClipboard(){ edit_copytoclipboard($this->self); }
	public function cutToClipboard(){ edit_cuttoclipboard($this->self); }
	public function pasteFromClipboard(){ edit_pastefromclipboard($this->self); }
	public function clearSelected(){ edit_clearselection($this->self); }
	public function clearSelection(){ $this->clearSelected(); }
	
	
}

class TRichEdit extends TMemo {
	
	public $class_name = __CLASS__;
	
	public function loadFromFile($file){
		$file = getFileName($file);
		
		rich_loadfile($this->self, $file);
	}
	
	public function saveToFile($file){
		
		$file = replaceSr($file);
		rich_savetofile($this->self, $file);
	}
	
	public function get_RTFText(){
		return rich_text($this->self, null);
	}
	
	public function set_RTFText($v){
		rich_text($this->self, $v);
	}
	
	public function param($name, $value = null){
		
		return rich_command($this->self, (string)$name, $value);
	}
	
	
	public function set_fontName($v){ $this->param('name',$v); }
	public function get_fontName(){ return $this->param('name'); }
	
	public function set_fontSize($v){ $this->param('size',$v); }
	public function get_fontSize(){ return $this->param('size'); }
	
	public function set_fontColor($v){ $this->param('color',$v); }
	public function get_fontColor(){ return $this->param('color'); }
	
	public function set_fontCharset($v){ $this->param('charset',$v); }
	public function get_fontCharset(){ return $this->param('charset'); }
	
	public function set_bold($v){ $this->param('bold',(bool)$v); }
	public function get_bold(){ return $this->param('bold'); }
	
	public function set_italic($v){ $this->param('italic',(bool)$v); }
	public function get_italic(){ return $this->param('italic'); }
	
	public function set_strikeout($v){ $this->param('strikeout',(bool)$v); }
	public function get_strikeout(){ return $this->param('strikeout'); }
	
	public function set_underline($v){ $this->param('underline',(bool)$v); }
	public function get_underline(){ return $this->param('underline'); }
	
}

class TCheckBox extends TControl {
	public $class_name = __CLASS__;
	
	public function set_checked($v){
		$this->set_prop('checked', (bool)$v);
	}
}

class TRadioButton extends TControl {
	public $class_name = __CLASS__;
}

class TListBox extends TControl {
	public $class_name = __CLASS__;
	protected $_items;
	
	function get_items(){
		if (!isset($this->_items)){
			$this->_items = new TStrings(false);
			$this->_items->self = __rtii_link($this->self,'Items');
			$this->_items->parent_object = $this->self;
		}
		return $this->_items;
	}
	
	function get_itemIndex(){
		return $this->items->itemIndex;
	}
	
	function set_itemIndex($v){
		$this->items->itemIndex = $v;
	}
	
	function set_inText($v){
		$this->items->setLine($this->itemIndex, $v);
	}
	
	function get_inText(){
		return $this->items->getLine($this->itemIndex);
	}
	
	function set_text($v){
		$this->items->text = $v;
	}
	
	function clear(){
		
		$this->text = '';
	}
	
	function get_text(){
		return $this->items->text;
	}
	
	function isSelected($index, $value = null){
		
		if ($index < 0)
			return false;
		else
			return listbox_selected($this->self,$index, $value);
	}
	
	// return array
	function getSelected(){
		
		$c      = $this->items->count;
		$result = array();
		
		for ($i=0;$i<$c;$i++){
			
			if ($this->isSelected($i))
				$result[] = $this->items->getLine($i);
		}
		return $result;
	}
	
	function unSelectedAll(){
		
		$c      = $this->items->count;
		$result = array();
		for ($i=0;$i<$c;$i++){			
			$this->isSelected($i, false);
		}
	}
	
	function setSelected($arr){
		
		$this->unSelectedAll();
		foreach ($arr as $el){
			
			$index = $this->items->indexOf($el);
			
			$this->isSelected($index, true);
		}
	}
}


class TComboBox extends TControl {
	public $class_name = __CLASS__;
	protected $_items;
	
	function get_items(){
		if (!isset($this->_items)){
			$this->_items = new TStrings(false);
			$this->_items->self = __rtii_link($this->self,'Items');
			$this->_items->parent_object = $this->self;
		}
		return $this->_items;
	}
	
	function get_itemIndex(){
		return $this->items->itemIndex;
	}
	
	function set_itemIndex($v){
		
		$this->items->itemIndex = $v;
	}
	
	function set_text($v){
		$this->items->text = $v;
	}
	
	function get_text(){
		return $this->items->text;
	}
	
	function set_inText($v){
		$this->set_prop('text', $v);
	}
	
	function get_inText(){
		return $this->get_prop('text');
	}
}

$_c->setConstList(array('pbHorizontal', 'pbVertical'),0);

class TProgressBar extends TControl {
	public $class_name = __CLASS__;
}

class TScrollBar extends TControl {
	public $class_name = __CLASS__;
}

class TGroupBox extends TControl {
	public $class_name = __CLASS__;
	
	function __construct($onwer=nil,$init=true,$self=nil){
		parent::__construct($onwer,$init,$self);
		
		$this->parentColor = false;
	}
}

class TRadioGroup extends TControl {
	public $class_name = __CLASS__;
	protected $_items;
	
	function __construct($onwer=nil,$init=true,$self=nil){
		parent::__construct($onwer,$init,$self);
		if ($init)
			$this->parentColor = false;
	}
	
	function get_items(){
		if (!isset($this->_items)){
			$this->_items = new TStrings(false);
			$this->_items->self = __rtii_link($this->self,'Items');
			$this->_items->parent_object = $this->self;
		}
		return $this->_items;
	}
	
	function set_text($v){
		$this->items->text = $v;
	}
	
	function get_text(){
		return $this->items->text;
	}
}

class TPanel extends TControl {
	public $class_name = __CLASS__;
	protected $_constraints;
	
	public function __construct($onwer=nil, $init=true, $self=nil){
		parent::__construct($onwer,$init,$self);
			
		if ($init)
		$this->parentColor = false;	
	}
	
	
	function get_constraints(){
		if (!isset($this->_constraints)){
			$this->_constraints = new TSizeConstraints(false);
			$this->_constraints->self = __rtii_link($this->self,'constraints');
		}
		return $this->_constraints;
	}
}
?>