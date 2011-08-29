<?

global $_c;
$_c->CHROMIUM_EXEC_RELOAD = 1;
$_c->CHROMIUM_EXEC_GOBACK = 2;
$_c->CHROMIUM_EXEC_CANGOBACK = 3;
$_c->CHROMIUM_EXEC_GOFORWARD = 4;
$_c->CHROMIUM_EXEC_CANGOFORWARD = 5;
$_c->CHROMIUM_EXEC_SHOWDEVTOOLS = 6;
$_c->CHROMIUM_EXEC_HIDEDEVTOOLS = 7;
$_c->CHROMIUM_EXEC_HIDEPOPUP = 8;
$_c->CHROMIUM_EXEC_SETFOCUS = 9;
$_c->CHROMIUM_EXEC_RELOADIGNORECACHE = 10;
$_c->CHROMIUM_EXEC_STOPLOAD = 11;
$_c->CHROMIUM_EXEC_SETFOCUSEVENT = 12;
$_c->CHROMIUM_EXEC_SETEVENTKEY = 13;
$_c->CHROMIUM_EXEC_MOUSECLICKEVENT = 14;
$_c->CHROMIUM_EXEC_LOAD = 15;
$_c->CHROMIUM_EXEC_SCROLLBY = 16;

$_c->CHROMIUM_EXEC_UNDO = 22;
$_c->CHROMIUM_EXEC_REDO = 23;
$_c->CHROMIUM_EXEC_CUT  = 24;
$_c->CHROMIUM_EXEC_COPY = 25;
$_c->CHROMIUM_EXEC_PASTE= 26;
$_c->CHROMIUM_EXEC_DEL  = 27;
$_c->CHROMIUM_EXEC_SELECTALL = 28;
$_c->CHROMIUM_EXEC_PRINT = 29;
$_c->CHROMIUM_EXEC_VIEWSOURCE = 30;
$_c->CHROMIUM_EXEC_LOADURL = 31;
$_c->CHROMIUM_EXEC_LOADSTRING = 32;
$_c->CHROMIUM_EXEC_LOADFILE = 33;
$_c->CHROMIUM_EXEC_EXECUTEJS = 34;


class TChromium extends TControl {
    
    public $class_name = __CLASS__;
    
	public function free(){
		chromium_free($this->self);
	}
	
	public function reload(){
		chromium_exec($this->self, CHROMIUM_EXEC_RELOAD, 0);
	}
	
	public function goBack(){
		chromium_exec($this->self, CHROMIUM_EXEC_GOBACK, 0);
	}
	
	public function canGoBack(){
		return chromium_exec($this->self, CHROMIUM_EXEC_CANGOBACK, 0);
	}
	
	public function goForward(){
		chromium_exec($this->self, CHROMIUM_EXEC_GOFORWARD, 0);
	}
	
	public function canGoForward(){
		return chromium_exec($this->self, CHROMIUM_EXEC_CANGOFORWARD, 0);
	}
	
	public function showDevTools(){
		chromium_exec($this->self, CHROMIUM_EXEC_SHOWDEVTOOLS, 0);
	}
	
	public function hideDevTools(){
		chromium_exec($this->self, CHROMIUM_EXEC_HIDEDEVTOOLS, 0);
	}
	
	public function hidePopup(){
		chromium_exec($this->self, CHROMIUM_EXEC_HIDEPOPUP, 0);
	}
	
	public function setFocus($enable = true){
		chromium_exec($this->self, CHROMIUM_EXEC_SETFOCUS, array((bool)$enable));
	}
	
	public function reloadIgnoreCache(){
		chromium_exec($this->self, CHROMIUM_EXEC_RELOADIGNORECACHE, 0);
	}
	
	public function stopLoad(){
		chromium_exec($this->self, CHROMIUM_EXEC_STOPLOAD, 0);
	}
	
	public function sendFocusEvent($event){
		chromium_exec($this->self, CHROMIUM_EXEC_SETFOCUSEVENT, array((int)$event));
	}
	
	public function sendKeyEvent($type, $key, $modifers, $sysChar, $imeChar){
		chromium_exec($this->self, CHROMIUM_EXEC_SETEVENTKEY, array( (int)$type, (int)$key, (int)$modifers, (int)$sysChar, (int)$imeChar ));
	}
	
	public function sendMouseClickEvent($x, $y, $type, $mouseUp, $clickCount){
		chromium_exec($this->self, CHROMIUM_EXEC_MOUSECLICKEVENT, array( (int)$x, (int)$y, (int)$type, (int)$mouseUp, (int)$clickCount ));
	}
	
	public function load($url){
		chromium_exec($this->self, CHROMIUM_EXEC_LOAD, array( (string)$url ));
	}
	
	public function scrollBy($x, $y){
		chromium_exec($this->self, CHROMIUM_EXEC_SCROLLBY, array( (int)$x, (int)$y ));
	}
	
	public function undo(){
		chromium_exec($this->self, CHROMIUM_EXEC_UNDO, 0);
	}
	
	public function redo(){
		chromium_exec($this->self, CHROMIUM_EXEC_REDO, 0);
	}
	
	public function cut(){
		chromium_exec($this->self, CHROMIUM_EXEC_CUT, 0);
	}
	
	public function copy(){
		chromium_exec($this->self, CHROMIUM_EXEC_COPY, 0);
	}
	
	public function paste(){
		chromium_exec($this->self, CHROMIUM_EXEC_PASTE, 0);
	}
	
	public function del(){
		chromium_exec($this->self, CHROMIUM_EXEC_DEL, 0);
	}
	
	public function selectAll(){
		chromium_exec($this->self, CHROMIUM_EXEC_SELECTALL, 0);
	}
	
	public function showPrint(){
		chromium_exec($this->self, CHROMIUM_EXEC_PRINT, 0);
	}
	
	public function viewSource(){
		chromium_exec($this->self, CHROMIUM_EXEC_VIEWSOURCE, 0);
	}
	
	public function loadUrl($url){
		chromium_exec($this->self, CHROMIUM_EXEC_LOADURL, array((string)$url));
	}
	
	public function loadString($str, $url = 'about:blank'){
		chromium_exec($this->self, CHROMIUM_EXEC_LOADSTRING, array((string)$str, (string)$url));
	}
	
	public function loadFile($file, $url = 'about:blank'){
		chromium_exec($this->self, CHROMIUM_EXEC_LOADFILE, array((string)$file, (string)$url));
	}
	
	public function executeJs($js, $jsUrl = 'about:blank', $startLine = 0){
		chromium_exec($this->self, CHROMIUM_EXEC_EXECUTEJS, array((string)$js, (string)$jsUrl, (int)$startLine));
	}
	
	/* properties */
	public function get_Zoom(){
		return chromium_prop($this->self, 1, null);
	}
	
	public function set_Zoom($level){
		chromium_prop($this->self, 1, (double)$level);
	}
	
	
	public function set_Url($url){
		chromium_prop($this->self, 1, (string)$url);
	}
	
	public function get_Source(){
		return chromium_prop($this->self, 1, null);
	}
	
	public function get_Text(){
		return chromium_prop($this->self, 1, null);
	}
}



class TChromiumEx extends TScrollBox {
    
    public $class_name_ex = __CLASS__;
    #url;
    #html;
    #silent
    
    public function initLabel(){
        
        $label = new TLabel($this);
        $label->font->style = 'fsBold';
		$label->font->color = clBlue;
        $label->caption = t('Chromium Browser');
        $label->x = 0;
        $label->y = 0;
        $label->autoSize = false;
        $label->w = $this->w;
        $label->h = $this->h;
        $label->anchors = 'akLeft, akTop, akRight, akBottom';
        $label->alignment= taCenter;
        $label->layout   =  tlCenter;
        $label->parent = $this;
    }
    
    public function __construct($onwer=nil,$init=true,$self=nil){
        parent::__construct($onwer, $init, $self);
        
		/*if ( !$GLOBALS['APP_DESIGN_MODE'] ){
			message_error('Use TChromium Class!');
			return;
		}*/
		
        if ($init){
            $this->borderStyle = bsNone;
            $this->bevelKind   = bkFlat;
            $this->parentColor = false;
            $this->color       = clWhite;
            $this->autoScroll  = false;
            $this->initLabel();
        }
    }
    
    public function __loadDesign(){
        $this->initLabel();
    }
    
    public function __initComponentInfo(){
        
        $this->visible = false;
		TChromiumEx::__initXWB($this->self);
    }
    
    static function __initXWB($self){
        
        $self = c($self);
        $md = new TChromium(_c($self->owner));
        $md->parent = $self->parent;
		
		
        $md->w = $self->w;
        $md->h = $self->h;
        
        $md->x = $self->x;
        $md->y = $self->y;
        $md->align = $self->align;
        $md->anchors = $self->anchors;
       
        
        $tmp = $self->name;
        $self->name = '';
        //$self->free();
        $md->name = $tmp;
        eventEngine::updateIndex($md);
    }
}