<?
global $_c, $APPLICATION;

	/* MessageBox flags */
	$_c->MB_OK = 0x000000;
	$_c->MB_OKCANCEL = 0x000001;
	$_c->MB_ABORTRETRYIGNORE = 0x000002;
	$_c->MB_YESNOCANCEL = 0x000003;
	$_c->MB_YESNO = 0x000004;
	$_c->MB_RETRYCANCEL = 0x000005;
	
	$_c->MB_ICONHAND = 0x000010;
	$_c->MB_ICONQUESTION = 0x000020;
	$_c->MB_ICONEXCLAMATION = 0x000030;
	$_c->MB_ICONASTERISK = 0x000040;
	$_c->MB_USERICON = 0x000080;
	$_c->MB_ICONWARNING     = MB_ICONEXCLAMATION;
	$_c->MB_ICONERROR       = MB_ICONHAND;
	$_c->MB_ICONINFORMATION = MB_ICONASTERISK;
	$_c->MB_ICONSTOP        = MB_ICONHAND;
	
	$_c->MB_APPLMODAL = 0x000000;
	$_c->MB_SYSTEMMODAL = 0x001000;
	$_c->MB_TASKMODAL = 0x002000;
	$_c->MB_HELP = 0x004000;

//TMsgDlgType = (mtWarning, mtError, mtInformation, mtConfirmation, mtCustom);
$_c->setConstList(array('mtWarning', 'mtError', 'mtInformation', 'mtConfirmation', 'mtCustom'), 0);
$_c->setConstList(array('fdScreen', 'fdPrinter', 'fdBoth'), 0);

function messageBox($text,$caption,$flag = MB_OK){
	global $APPLICATION;
	return $APPLICATION->messageBox($text,$caption,$flag);
}

function messageDlg($text, $type = mtInformation, $flag = MB_OK){
	return message_dlg($text, $type, $flag);
}

function message($text, $mode = mtCustom){
    
    return messageDlg($text, $mode);
}

function showMessage($text){
	messageBox($text,appTitle());
}

function alert($text){showMessage($text);}
function msg($text){showMessage($text);}

function confirm($text){
	$res = messageBox($text,appTitle(),MB_YESNO);
	return $res == idYes;
}

class TCommonDialog extends TControl{
	
	public $class_name = __CLASS__;
	#public onSelect
	
	function execute(){
		$res = dialog_execute($this->self);
		
		/*if ($res && $this->onSelectDialog){
			eval($this->onSelectDialog . '('.$this->self.',\''. addslashes($this->filename) .'\');');
		}*/
		return $res;
	}
	
	function closeDialog(){
		dialog_close($this->self);
	}
	
	function close(){
		$this->closeDialog();
	}
	
	function showModal(){return $this->execute();}
	function show(){return $this->execute();}
	
	function get_files(){
		
		$tmp = (array)explode(_BR_, dialog_items($this->self));
		foreach ($tmp as $el)
		if ($el)
		$result[] = replaceSl($el);
		
		return $result;
	}
	
	function setOption($name, $value = true, $ex = false){
		
		$options = array();
		if ($ex)
			$tmp = explode(',',$this->optionsEx);
		else {
			$tmp = explode(',',$this->options);
		}
		
		foreach ($tmp as $el)
		if ($el)
			$options[] = trim($el);
		
		
			
		$k = array_search($name, (array)$options);
			
		if (!$value){
			if ($k!==false)
				unset($options[$k]);
		} else {
			if ($k===false)
				$options[] = $name;
		}
		
		if ($ex){
			$this->optionsEx = implode(',', (array)$options);
		}
		else
			$this->options = implode(',', (array)$options);
	}
	
	function getOption($name, $ex = false){
		
		if ($ex)
		if (stripos($this->optionsEx, $name)!==false)
			return true;
		if (!$ex)
		if (stripos($this->options, $name)!==false)
			return true;
		
		return false;
	}
	
}

class TOpenDialog extends TCommonDialog{	
	public $class_name = __CLASS__;
	
	
	function set_smallMode($v){
		$this->setOption('ofExNoPlacesBar', $v, true);
	}
	
	function get_smallMode(){
		return $this->getOption('ofExNoPlacesBar', true);
	}
	
	
	function set_multiSelect($v){
		$this->setOption('ofAllowMultiSelect', $v);
	}
	
	function get_multiSelect(){
		return $this->getOption('ofAllowMultiSelect');
	}
	
}
class TSaveDialog extends TOpenDialog{
	public $class_name = __CLASS__;
}
class TFontDialog extends TCommonDialog{
	public $class_name = __CLASS__;
}
class TColorDialog extends TCommonDialog{
	public $class_name = __CLASS__;
	
	function set_smallMode($v){
		$this->setOption('cdFullOpen', !$v);
	}
	
	function get_smallMode(){
		return !$this->getOption('cdFullOpen');
	}
}

class TDMSColorDialog extends TComponent {
	
	public function __construct($onwer=null, $init=true, $self=nil){
		//parent::__construct($onwer,$init,$self);
		
		if ($init)
		$this->self = dms_colordialog_create($onwer);
		
		if ($self!=nil)
		$this->self = $self;
	}
	
	public function execute($x = -1, $y = -1){
		
		return dms_colordialog_execute($this->self, (int)$x, (int)$y);
	}
	
	public function get_form(){
		
		return dms_colordialog_form($this->self);
	}
	
	public function show($x=-1,$y=-1){	
		return $this->execute($x, $y);
	}
}

class TPrintDialog extends TCommonDialog{
	public $class_name = __CLASS__;
}
class TPageSetupDialog extends TCommonDialog{
	public $class_name = __CLASS__;
}
class TFindDialog extends TCommonDialog{
	public $class_name = __CLASS__;
	
	public function get_isMatchCase(){
		return $this->getOption('frMatchCase');
	}
	
	public function set_isMatchCase($v){
		$this->setOption('frMatchCase',$v);
	}
	
}

class TReplaceDialog extends TCommonDialog{
	public $class_name = __CLASS__;
	
	public function get_isMatchCase(){
		return $this->getOption('frMatchCase');
	}
	
	public function set_isMatchCase($v){
		$this->setOption('frMatchCase',$v);
	}
}

?>