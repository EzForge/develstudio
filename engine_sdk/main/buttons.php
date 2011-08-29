<?
/*
  
  SoulEngine Buttons Library
  
  2009 ver 0.1
  
  Dim-S Software (c) 2009
  
*/

global $_c;

$_c->setConstList(array('blGlyphLeft', 'blGlyphRight', 'blGlyphTop', 'blGlyphBottom'),0);

class TButton extends TControl {
	public $class_name = __CLASS__;
}

class TBitBtn extends TControl {
	public $class_name = __CLASS__;
	protected $_picture;
	
	public function get_picture(){
		
		if (!isset($this->_picture)){
			$this->_picture = new TBitmap(false);
			$this->_picture->self = __rtii_link($this->self,'Glyph');
			$this->_picture->parent_object = $this->self;
		}
		
		return $this->_picture;
	}
	
	public function doClick(){
		
		eval(get_event($this->self, 'onClick').'('.$this->self.');');
	}
	
	public function loadPicture($file){
		$this->picture->loadAnyFile($file);
	}
	
	public function loadFromBitmap($bt){
		$this->picture->assign($bt);
	}
}

class TSpeedButton extends TBitBtn {
	public $class_name = __CLASS__;
}

?>