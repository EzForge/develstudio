<?

class CInet extends TPanel {
    
    public $html;
    public $in_charset;
    public $out_charset;
    public $error;
    public $error_type;
    
    public $proxy;
    
    public $callback;
    public $thread;
    
    protected $rand;
    
    public $c_id;
    protected $_url;
    protected $_authInfo;
    protected $_userAgent;
    
    protected $_cookieFile;
    protected $_cookie;
    
    protected $_method;
    protected $_header;
    protected $_timeOut;
    protected $_redirect;
    
    protected $data;
    
    public function __construct($url = false){
        
        /*if (!extension_loaded('php_curl')){
            dl('php_curl.dll');
        }*/
        
        if ($url)
            $this->c_id = curl_init($url);
        else
            $this->c_id = curl_init();
            
        curl_setopt($this->c_id, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->c_id, CURLOPT_COOKIESESSION, 1);
        
        $this->clear();
        
        $this->userAgent = 'Mozilla/5.0 (Windows; U; Windows NT 5.1; ru; rv:1.9.2b2) Gecko/20091108 Firefox/3.6b2';
        $this->method    = 'post';
        $this->header    = false;
        $this->encoding  = 'gzip,deflate';
        $this->redirect  = true;
        $this->timeOut   = 30; // 30 секунд
        //$this->in_charset  = 'utf-8';
        //$this->out_charset = 'windows-1251';
        $this->is_thread = false;
        $this->callback  = '';
        $this->rand      = rand();
    }
    
    public function setOption($name, $value){
        curl_setopt($this->c_id, $name, $value);
    }
    
    public function getOption($name){
        return curl_getinfo($this->c_id, $name);
    }
    
    public function set_timeOut($v){
        
        curl_setopt($this->c_id, CURLOPT_CONNECTTIMEOUT, (int)$v);
        $this->_timeOut = (int)$v;
    }
    
    public function get_timeOut(){
        return $this->_timeOut;
    }
    
    public function set_redirect($v){
        
        curl_setopt($this->c_id, CURLOPT_FOLLOWLOCATION, (bool)$v);
        $this->_redirect = (bool)$v;
    }
    
    public function get_redirect(){return $this->_redirect;}
    
    public function set_method($v){
        
        $v = trim(strtolower($v));
        if ($v!='post')
            curl_setopt($this->c_id, CURLOPT_POST, 0);
        else
            curl_setopt($this->c_id, CURLOPT_POST, 1);
        
        $this->_method = $v;
    }
    
    public function get_method(){
        return $this->_method;
    }
    
    public function set_userAgent($v){
        curl_setopt($this->c_id, CURLOPT_USERAGENT, $v);
        $this->_userAgent = $v;
    }
    
    public function get_userAgent(){
        return $this->_userAgent;
    }
    
    public function set_cookieFile($file){
        $file = str_replace("\\", DIRECTORY_SEPARATOR, $file);
        $file = str_replace("/", DIRECTORY_SEPARATOR, $file);
        $this->_cookieFile = $file;
        
        curl_setopt($this->c_id, CURLOPT_COOKIEFILE, $file);
        curl_setopt($this->c_id, CURLOPT_COOKIEJAR,  $file);
    }
    
    public function get_cookieFile(){
        return $this->_cookieFile;
    }
    
    public function set_url($url){
        
        curl_setopt($this->c_id, CURLOPT_URL, $url);
        $this->_url = $url;
    }
    
    public function get_url(){
        return $this->_url;
    }
    
    public function set_encoding($v){
        
        curl_setopt($this->c_id, CURLOPT_ENCODING, $v);
        $this->_encoding = $v;
    }
    
    public function get_encoding(){
        return $this->_encoding;
    }
    
    public function set_header($v){
        
        curl_setopt($this->c_id, CURLOPT_HEADER, (bool)$v);
        $this->_header = $v;
    }
    
    public function get_header(){
        return $this->_header;
    }
    
    public function setCookie($name, $value){
        curl_setopt($this->c_id, CURLOPT_COOKIE, $name.'='.$value);
    }
    
    public function getCookie($name){
        
        $data = curl_getinfo($this->c_id, CURLOPT_COOKIE);
        return $data;
    }
    
    public function setProxy($ip, $port = 80, $type = CURLPROXY_HTTP){
    
        $this->proxy['ip'] = $ip;
        $this->proxy['port'] = $port;
        $this->proxy['type'] = $type;
        curl_setopt($this->c_id, CURLOPT_PROXY, $ip.':'.$port );
        curl_setopt($curl, CURLOPT_PROXYTYPE, $type);
    }
    
    public function set_proxyAddr($v){
        
        if (!$v) return;
        
        list($ip, $port) = explode(':', $v);
        
        $this->setProxy(trim($ip), trim($port));
    }
    
    public function get_propxyAddr(){
        
        return $this->proxy['ip'].':'.$this->proxy['port'];
    }
    
    public function setFileStr($name, $data, $ext = ''){
        
        if (function_exists('win_tempdir'))
            $tmpDir = str_replace( '\\','/', win_tempdir() );
        else
            $tmpDir = '/tmp';
        
        $tmpfname = tempnam($tmpDir, "cinet");
        if ($ext)
            $tmpfname .= '.' . $ext;
    
        file_put_contents($tmpfname, $data);
        
        $this->setFile($name, $tmpfname);
    }
    
    public function setFile($name, $fileName){
        
        $fileName = str_replace("\\", DIRECTORY_SEPARATOR, $fileName);
        $fileName = str_replace("/", DIRECTORY_SEPARATOR, $fileName);
        
        $this->data[$name] = '@' . $fileName;
    }
    
    public function getFile($name){
        
        $result = $this->data[$name];
        return str_replace('@','',$result);
    }
    
    public function setData($name, $value){
        
        $this->data[$name] = $value;
    }
    
    public function getData($name){
        return $this->data[$name];
    }
    
    public function clear(){
        $this->data = array();
    }
    
    function _submit($url = false, $self = false){        
        
        if ($self)
            $obj = c($self);
        else
            $obj =& $this;
        
        if ($url) $obj->url = $url;
        
        if (count($obj->data))
            curl_setopt($obj->c_id, CURLOPT_POSTFIELDS, $obj->data); 
        
        $obj->html  = curl_exec($obj->c_id);
        
        $obj->error = curl_error($obj->c_id);
        $obj->error_type = curl_errno($obj->c_id);
        
        if ($obj->in_charset && $obj->in_charset!=$obj->out_charset)
            $obj->html = iconv($obj->in_charset, $obj->out_charset, $obj->html);
        
        if ($obj->error)
            return NULL;
        else
            return $obj->html;
    }
    
    public function submit($url = false){
        
        return $this->_submit($url);
        
        if ($this->callback){
            $func = $this->callback;
            $func($this->html);
        }
    }
    
    public function close(){
        
        curl_close($this->c_id);
    }
    
    public function __destruct(){
        curl_close($this->c_id);
    }
    
    public function setHttpProps($self){
        
        if (is_array($self))
            $props = $self;
        else
            $props = TComponent::__getPropExArray($self);
        
        /**** свойства ********/
        foreach ($props as $prop=>$value){
            if ($prop!='proxy')
            $this->$prop = $value;
        }
    }
}


DSApi::reg_eventType('oncomplete','THttpClient::callComplete',array('self','html'),'THttpClient');
DSApi::reg_eventType('onerror','THttpClient::callError',array('self','error'),'THttpClient');

class THttpClient extends __TNoVisual {
    
    public $class_name_ex = __CLASS__;
    #data // данные для отправки...
    
    
    static function callComplete($self, $html){
        __exEvents::callEventEx($self, array('html'=>$html), 'OnComplete');
    }
    
    static function callError($self, $err){
        __exEvents::callEventEx($self, array('error'=>$err), 'OnError');
    }

    public function __construct($onwer=nil,$init=true,$self=nil){
        parent::__construct($onwer, $init, $self);
        
        if ($init){
            
            $this->url = 'http://develstudio.ru/';
            $this->method   = 'post';
            $this->encoding = 'gzip,deflate';
            $this->redirect = true;
            $this->timeOut  = 30;
            $this->header   = false;
            $this->thread   = false;
            $this->priority = tpIdle;
        }
    }
    
    public function getFile($name){
        $result = $this->getData($name);
        return str_replace('@','',$result);
    }
    
    public function setFile($name, $fileName){
        
        $data = $this->data;
        
        $fileName = str_replace("\\", DIRECTORY_SEPARATOR, $fileName);
        $fileName = str_replace("/", DIRECTORY_SEPARATOR, $fileName);
        
        $data[$name] = '@' . $fileName;
        
        $this->data = $data;
    }
    
    public function setData($name, $value){
        
        $data = $this->data;
        $data[$name] = $value;
        $this->data = $data;
    }
    
    public function getData($name){
        $data = $this->data;
        
        return $data[$name];
    }
    
    public function clear(){
        $this->data = array();
    }
    
    public function submit(){
        
        
        if ($this->thread){
            
            $code = ' THttpClient::_submit('.$this->self.'); ';
            
            $tmp = getGlobalVar($this->thread_var);
            if ($tmp)
                $t =& $tmp;
            else {
                $t = new Thread;
                $this->thread_var = registerGlobalVar($t);
            }
            
            $t->code = $code;
            $t->priority = $this->priority;
            $t->start();
            
            
        } else {
            
            return $this->_submit();
        }
    }
    
    function _submit($self = false){
        
        $st_err = err_status(false);
        
        if ($self)
            $obj = c($self);
        else
            $obj =& $this;
        
        $props = TComponent::__getPropExArray($obj->self);
        $http = new CInet;
        $http->setHttpProps($props);
        
        
        $html = $http->submit();
        err_status($st_err);
        
        if (/*err_msg() ||*/ $http->error){
            
            if ($props['onerror']){
                $err = err_msg();
                if (!$err) $err = $http->error;
                eval($props['onerror'].'($obj->self, $err);');
            }
            
        } else {
            
            if ($props['oncomplete']){
                    
                    eval($props['oncomplete'].'($obj->self, $html);');
            }
        }
        
        $http->free();
        return $html;
    }
    
    
    function stop(){
        
        $t = getGlobalVar($this->thread_var);
        if ($t){
        
            $t->terminateAndWaitFor();
            unsetGlobalVar($t->thread_var);
        }
    }
    
    public function __initComponentInfo(){
        
        parent::__initComponentInfo(); 
    }
}

?>