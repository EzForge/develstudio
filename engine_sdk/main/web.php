<?

global $_c;

  $_c->OLECMDID_OPEN = 0x000001;
  $_c->OLECMDID_NEW = 0x000002;
  $_c->OLECMDID_SAVE = 0x000003;
  $_c->OLECMDID_SAVEAS = 0x000004;
  $_c->OLECMDID_SAVECOPYAS = 0x000005;
  $_c->OLECMDID_PRINT = 0x000006;
  $_c->OLECMDID_PRINTPREVIEW = 0x000007;
  $_c->OLECMDID_PAGESETUP = 0x000008;
  $_c->OLECMDID_SPELL = 0x000009;
  $_c->OLECMDID_PROPERTIES = 0x00000A;
  $_c->OLECMDID_CUT = 0x00000B;
  $_c->OLECMDID_COPY = 0x00000C;
  $_c->OLECMDID_PASTE = 0x00000D;
  $_c->OLECMDID_PASTESPECIAL = 0x00000E;
  $_c->OLECMDID_UNDO = 0x00000F;
  $_c->OLECMDID_REDO = 0x000010;
  $_c->OLECMDID_SELECTALL = 0x000011;
  $_c->OLECMDID_CLEARSELECTION = 0x000012;
  $_c->OLECMDID_ZOOM = 0x000013;
  $_c->OLECMDID_GETZOOMRANGE = 0x000014;
  $_c->OLECMDID_UPDATECOMMANDS = 0x000015;
  $_c->OLECMDID_REFRESH = 0x000016;
  $_c->OLECMDID_STOP = 0x000017;
  $_c->OLECMDID_HIDETOOLBARS = 0x000018;
  $_c->OLECMDID_SETPROGRESSMAX = 0x000019;
  $_c->OLECMDID_SETPROGRESSPOS = 0x00001A;
  $_c->OLECMDID_SETPROGRESSTEXT = 0x00001B;
  $_c->OLECMDID_SETTITLE = 0x00001C;
  $_c->OLECMDID_SETDOWNLOADSTATE = 0x00001D;
  $_c->OLECMDID_STOPDOWNLOAD = 0x00001E;
  $_c->OLECMDID_ONTOOLBARACTIVATED = 0x00001F;
  $_c->OLECMDID_FIND = 0x000020;
  $_c->OLECMDID_DELETE = 0x000021;
  $_c->OLECMDID_HTTPEQUIV = 0x000022;
  $_c->OLECMDID_HTTPEQUIV_DONE = 0x000023;
  $_c->OLECMDID_ENABLE_INTERACTION = 0x000024;
  $_c->OLECMDID_ONUNLOAD = 0x000025;
  $_c->OLECMDID_PROPERTYBAG2 = 0x000026;
  $_c->OLECMDID_PREREFRESH = 0x000027;
  $_c->OLECMDID_SHOWSCRIPTERROR = 0x000028;
  $_c->OLECMDID_SHOWMESSAGE = 0x000029;
  $_c->OLECMDID_SHOWFIND = 0x00002A;
  $_c->OLECMDID_SHOWPAGESETUP = 0x00002B;
  $_c->OLECMDID_SHOWPRINT = 0x00002C;
  $_c->OLECMDID_CLOSE = 0x00002D;
  $_c->OLECMDID_ALLOWUILESSSAVEAS = 0x00002E;
  $_c->OLECMDID_DONTDOWNLOADCSS = 0x00002F;


  $_c->OLECMDEXECOPT_DODEFAULT = 0x000000;
  $_c->OLECMDEXECOPT_PROMPTUSER = 0x000001;
  $_c->OLECMDEXECOPT_DONTPROMPTUSER = 0x000002;
  $_c->OLECMDEXECOPT_SHOWHELP = 0x000003;


class TWebBrowser extends TControl {
    
    public $class_name = __CLASS__;
        
        
    public function __construct($onwer=null, $init=true, $self=nil){
        
        
        if ($init){
            if (is_object($onwer))
            $this->self = web_create($onwer->self);
            else
            $this->self = web_create(null);
            
            //TApplication::addTermFunc('c('.$this->self.')->free();');
        }
        
        if ($self!=nil)
            $this->self = $self;
    }
        
    public function execWB($cmdID, $cmdExe = OLECMDEXECOPT_PROMPTUSER){
        
        web_execwb($this->self, $cmdID, $cmdExe);
    }
    
    public function toPrint(){
        $this->execWB(OLECMDID_PRINT);
    }
    
    public function toSaveAs(){
        $this->execWB(OLECMDID_SAVEAS);
    }
    
    public function stop(){
        $this->execWB(OLECMDID_STOP);
    }
    
    public function stopDownload(){
        $this->execWB(OLECMDID_STOPDOWNLOAD);
    }
    
    public function refresh(){
        $this->execWB(OLECMDID_REFRESH);
    }
    
    public function printDialog(){
        $this->execWB(OLECMDID_PRINTPREVIEW);
    }
    
    public function open(){
        $this->execWB(OLECMDID_OPEN);
    }
    
    public function showPrint(){
        $this->execWB(OLECMDID_SHOWPRINT);
    }
    
    public function post($url, $postData){
        
        if (is_array($postData)){
            $i = 0;
            foreach ($postData as $name=>$value){
                $i++;
                if ($i!=1) $result .= '&';
                
                $result .= $name . '=' . $value;
            }
        } else {
            $result = $postData;
        }
        
        web_post($this->self, $url, $result);
    }
    
    public function set_html($html){
        
        /*$code = Localization::detectLocale($html);
        if ($code == 'utf-8')
            $html = iconv($code, 'windows-1251', $html);
        
        $html = $html;*/
        web_sethtml($this->self, $html);
    }
    
    public function saveToFile($filename){
        
        $filename = replaceSr($filename);
        web_savefile($this->self, $filename);
    }
    
    public function navigate($url, $no_sound = true){
        web_navigate($this->self, $url, $no_sound);
    }
    
    public function get_url(){
        return web_location($this->self);
    }
    
    public function set_url($url){
        
        $this->navigate($url, true);
    }
    
    public function set_width($v){
        web_width($this->self, $v);
    }
    
    public function set_height($v){
        web_height($this->self, $v);
    }
    
    public function set_h($v){
        $this->height = $v;
    }
    
    public function set_w($v){
        $this->width = $v;
    }
    
    public function get_busy(){
        return web_busy($this->self);
    }
    
    public function goBack(){
        return web_back($this->self);
    }
    
    public function goForward(){
        return web_forward($this->self);
    }
    
    public function get_protocol(){
        return web_protocol($this->self);
    }
    
    function setProxy($ip_port){
        
        web_proxy(trim(str_replace(' ','',$ip_port)));
    }
    
    public function free(){
        
        web_free($this->self);
    }
}