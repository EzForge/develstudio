<?

global $_c;
$_c->setConstList(array('htFocused', 'htNone', 'htSingle'),0);

DSApi::reg_eventType('onhotspotclick','THTMLViewer::callHotSpotClick',array('self','url'),'THTMLViewer');
DSApi::reg_eventType('onhotspotcovered','THTMLViewer::callHotSpotCovered',array('self','url'),'THTMLViewer');
DSApi::reg_eventType('onformsubmit','THTMLViewer::callFormSubmit',array('self','action', 'target', 'enctype', 'method', 'results'),'THTMLViewer');

class THTMLViewer extends TControl {
    
    public $class_name = __CLASS__;
    #event onLink (self, rel, ref, href)
    #event onHotSpotClick (self, url, continue)
    #event onHotSpotCovered (self, url)
    #event onFormSubmit (self, action, target, enctype, method, results)
    #property titleAttr
    #property title
    
    function callHotSpotClick($self, $url){
	
	DSApi::callEvent($self, array('url'=>$url), 'OnHotSpotClick');
	__setVarEx(false);
    }
    
    function callHotSpotCovered($self, $url){
	DSApi::callEvent($self, array('url'=>$url), 'OnHotSpotCovered');
    }
    
    function callFormSubmit($self, $action, $target, $enctype, $method, $results){
	
	$tmp = explode(chr(16),$results);
        
        $results = array();
        foreach ($tmp as $i=>$line){
            list($name, $value) = explode(chr(17), $line);
            if (trim($name))
                $results[trim($name)] = $value;
        }

	DSApi::callEvent($self, array('action'=>$action, 'target'=>$target,
				      'enctype'=>$enctype, 'method'=>$method, 'results'=>$results), 'OnFormSubmit');
    }
    
    function __copy(){
	
	$result['x'] = $this->x;
	$result['y'] = $this->y;
	$result['w'] = $this->w;
	$result['h'] = $this->h;
	$result['Align'] = $this->Align;
	$result['defBackground'] = $this->defBackground;
	$result['borderStyle'] = $this->borderStyle;
	$result['noSelect'] = $this->noSelect;
	$result['serverRoot'] = $this->serverRoot;
	$result['hint'] = $this->hint;
	$result['cursor'] = $this->cursor;
	$result['anchors'] = $this->anchors;
	$result['aenabled'] = $this->aenabled;
	$result['avisible'] = $this->avisible;
	
	return serialize($result);
    }
    
    function __paste($result){
	
	$result = unserialize($result);
	foreach ($result as $prop=>$value)
	    $this->$prop = $value;
    }
    
    function __construct($onwer=nil,$init=true,$self=nil){
	parent::__construct($onwer,$init,$self);
        
	if ($init){
	    //$this->useSkinColor = false;
	    $this->serverRoot = './';
	    $this->defBackground = clWhite;
	    $this->borderStyle = htNone;
	}
    }
	function get_selText(){	return edit_seltext($this->self, null); }
	function set_selText($v){ edit_seltext($this->self, (string)$v); }
	
	function get_selStart(){ return edit_selstart($this->self, null); }
	function set_selStart($v){ edit_selstart($this->self, (int)$v); }
	
	function get_selLength(){ return edit_sellength($this->self, null); }
	function set_selLength($v){ edit_sellength($this->self, (int)$v); }
	
	function selectAll(){ edit_selectall($this->self); }
	
    public function navigate($url){
        
        htmlview_navigate($this->self, $url);
    }
    
    public function set_html($html){
        
        htmlview_text($this->self, $html);
    }
    
    public function get_title(){
	return htmlview_title($this->self);
    }
    
    public function get_titleAttr(){
	return htmlview_titleAttr($this->self);
    }
    
    public function get_URL(){
	return htmlview_URL($this->self);
    }
    
    public function loadFromFile($file){
        
        $html = file_get_contents(getFileName($file));
        $this->html = $html;
    }
    
    public function get_vScrollPos(){
	
	return htmlview_vscroll_pos($this->self, null);
    }
    
    public function set_vScrollPos($v){
	htmlview_vscroll_pos($this->self, (int)$v);
    }
    
    function toPrint(){
	htmlview_print($this->self);
    }
}
