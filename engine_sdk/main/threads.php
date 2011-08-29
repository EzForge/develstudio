<?

 /*
    PHP Soul Engine 2010
    Библиотека для работы с потоками...
 */
 
global $_c;
$_c->setConstList(array('tpIdle', 'tpLowest', 'tpLower', 'tpNormal', 'tpHigher', 'tpHighest',
    'tpTimeCritical'),0);

class Thread extends _Object {
    
    static $inc_files; // массив файлов для подключения
    static $inc_codes;
    static $inc_consts;
    
    public $id; // id потока
    public $_code;
    
    static $is_inc = false;
    
    public function __construct($code = ''){
        $this->id = thread_init('');
        
        $this->includeScripts();
        $this->includeCodes();
        $this->code = $code;
    }
    
    static function updateGlVars(){
        
        
        $vars = v('__glVars');
        foreach ($vars as $name=>$value){
            if (is_bool($value) || is_string($value) || is_int($value)){
                
                $GLOBALS[$name] = $value;   
            }
        }
    }
    
    static function addTransfer($code){
        return $code;
    }
	
	
    
    public function start(){
        
        if (!thread_loaded($this->id,null)){
            
            $code .= $this->includeConsts();
			$code .= $this->includeCodesSub();
            $code .= $this->includeScripts();
            $code .= $this->includeCodes();
            
            $code .= 'define("IS_THREAD",true);';
            $code .= $this->code;
			
            $this->code   = str_ireplace('%id%', $this->id, $code);
            
            
            thread_loaded($this->id, true);
        } else {
            
            $this->code = self::addTransfer($this->code);
        }
        
        thread_start((int)$this->id);
    }
    
    public function run(){
        thread_run($this->id);
    }
    
    public function stop(){
        //thread_terminate($this->id);
        thread_stop($this->id);
    }
    
    public function suspend(){
        thread_suspend($this->id);
    }
    
    public function resume(){
        thread_resume($this->id);
    }
    
    public function terminate(){
        thread_terminate($this->id);
    }
    
    public function terminateAndWaitFor(){
        thread_terminateAndWaitFor($this->id);
    }
    
    public function free(){
        thread_free($this->id);
    }
    
    public function inc($file){
        
        if (fileExt($file)=='phpe2')
            return ' thread_include_enc2(%id%, \''.replaceSl($file).'\'); ';
        if (fileExt($file)=='phz' || fileExt($file)=='phb')
            return ' bcompiler_load(\''.replaceSl($file).'\'); ';
        if (fileExt($file)=='phpe')
            return ' include_ex(\''.replaceSl($file).'\'); ';
        else
            return ' include \''.replaceSl($file).'\'; ';
    }
    
    public function inc_once($file){
        return ' include_once \''.replaceSl($file).'\';';
    }
    
    
    public function includeConsts(){
           
        $code = '';
        
        foreach ((array)self::$inc_consts as $key=>$value){
            if (is_numeric($value))
                ;
            elseif (is_bool($value))
                $value = $value ? 'true' : 'false';
            elseif (is_string($value))
                $value = "'".addslashes($value)."'";
            elseif (is_null($value))
                $value = 'null';
            else
                continue;
            
            $code .= vsprintf('define(%s,%s,0);', array((string)$key, $value));   
        }
        
        return $code;
    }
    
    public function includeScripts(){
        
        $code = '';
        foreach ((array)self::$inc_files as $file){
            $code .= $this->inc($file);   
        }
        
        return $code;
    }
    
    public function includeCodes(){
        
        $return = '';
        
        foreach ((array)self::$inc_codes as $code){
            
			if ( !is_array($code) )
				$return .= $code;
        }
        
        return $return;
    }
	
	public function includeCodesSub(){
        
        $return = '';
        
        foreach ((array)self::$inc_codes as $code){
            
			if ( is_array($code) )
				$return .= $code['SRC'];
        }
        
        return $return;
    }
    
    public function set_code($v){
        
        $this->_code = $v;
        thread_code( $this->id,  $v);
    }
    
    public function get_code(){
        return $this->_code;
    }
    
    public function isWorking(){
        
        return thread_working( $this->id );
    }
    
    public function set_priority($v){
        thread_priority($this->id, $v);
    }
    
    public function get_priority(){
        return thread_priority($this->id, null);
    }
    
    static function engineFile($file){
        
        thread_enginefile( replaceSr($file) );
    }
    
    static function getVar($name){

        $result = unserialize( urldecode(thread_var($name, null)) );
		return $result;
    }
    
    static function setVar($name, $value){
        
        thread_var( $name, urlencode(serialize($value)) );
    }
    
    static function addFile($file){
        
        self::$inc_files[] = $file;
    }
    
	static function addEncCode($name, $code, $sub = false){
	
		thread_var($name, $code);
		if ( $sub )
			self::addCode(array('SRC'=>'thread_eval("'.$name.'");'));
		else
			self::addCode('thread_eval("'.$name.'");');
	}
	
    static function addCode($code){
        
        self::$inc_codes[] = $code;
    }
    
    static function initGlobals(){
        
        $globals = self::getVar('__globals');
        foreach ($globals as $name => $value){
            
            global $$name;
            $$name = $value;
        }
        unset($globals);
    }
    
    static function setGlobal($name, $value){
        
        $globals = self::getVar('__globals');
        $globals[$name] = $value;
        self::setVar('__globals', $globals);
        unset($globals);
    }
    
    // сообщение из потока
    static function message($msg){
        
        setTimeout(30, 'message(\''.addslashes($msg).'\')');    
    }
    
    // показать сообщение об ошибке из потока
    static function error_message($msg){
        
        setTimeout(30, 'error_message(\''.addslashes($msg).'\')');    
    }
    
    static function func($func, $params = array()){
        
        //array_map('addslashes', $params);
        v('___params', $params);
        //c("form1")->text = 'call_user_func_array("'.$func.'", v("___params"))';
        if (count($params)>0)
            $str = 'call_user_func_array("'.$func.'", v("___params"))';
        else
            $str = $func.'();';
            
        $tim = c(THREAD_TIMER_TICK)->timer;
        $tim->onTimer = 'c(THREAD_TIMER_TICK)->timer->enabled = false; '.$str.'; _empty';
        $tim->enabled = true;
    }

	function safeJSON_chars($data) {

		$aux = str_split($data);

		foreach($aux as $a) {

			$a1 = urlencode($a);

			$aa = explode("%", $a1);

			foreach($aa as $v) {

				if($v!="") {

					if(hexdec($v)>127) {

					$data = str_replace($a,"&#".hexdec($v).";",$data);

					}

				}

			}

		}
		return $data;

	} 
}


function v($name, $value = null){
    
    if ($value === null){
        return Thread::getVar($name);
    } else
        Thread::setVar($name, $value);
}

function enc_v($name, $value = null){
    
    if ($value === null)
        return enc_getValue( $name );
    else
        enc_setValue( $name, urlencode(serialize($value)) );
}

function define_ex($name, $value){
    
    if (!isset(Thread::$inc_consts[$name])){
        Thread::$inc_consts[$name] = $value;
        define($name, $value, false);
    }
}