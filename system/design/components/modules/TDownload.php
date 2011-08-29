<?

DSApi::reg_eventType('oncomplete','TDownload::callComplete',array('self','html'),'TDownload');
DSApi::reg_eventType('onerror','TDownload::callError',array('self','error'),'TDownload');
DSApi::reg_eventType('ondownload','TDownload::callDownload',array('self','pos','max'),'TDownload');

class TDownload extends __TNoVisual {
    
    public $class_name_ex = __CLASS__;
    
    #url
    #path
    #athread
    #id_Var
    #buffer
    
    public function __construct($onwer=nil,$init=true,$self=nil){
	parent::__construct($onwer, $init, $self);
  
        if ($init){
	    $this->priority = tpIdle;
            $this->buffer   = 4096;
	}
    }
    
    static function callComplete($self, $html){
        DSApi::callEvent($self, array('html'=>$html), 'OnComplete');
    }
    
    static function callError($self, $err){
        DSApi::callEvent($self, array('error'=>$err), 'OnError');
    }
    
    static function callDownload($self, $pos, $max){
        DSApi::callEvent($self, array('pos'=>$pos,'max'=>$max), 'OnDownload');
    }
    
    static function fileInfo($fp){
        //$fp = fopen($path,"r");
        $inf = stream_get_meta_data($fp);
           
        $result = array();
        foreach($inf["wrapper_data"] as $i=>$v){
            $v = explode(":",$v);
            array_map('trim', $v);
            $v[0] = strtolower($v[0]);
            
            if ($v[0]=="location"){
                
                $result['location'] = trim(str_ireplace('location:','',$inf["wrapper_data"][$i]));
            }
            if ($v[0]=="content-length"){
                $result['size'] = $v[1];
            }
        }
        
        if (!$result['location'])
            $result['location'] = $inf['uri'];
                
        return $result;
    }
    
    function loadForObject($self, $filename, $to_del = false){
	
	$obj = $self->setObject;
	if ($obj){
	    $obj = c($obj);
	    if ($obj instanceof TImage){
		$obj->loadPicture($filename);
	    } else {
		if ($obj instanceof TDataVar)
		    $obj->value = file_get_contents($filename);
		else
		    $obj->text = file_get_contents($filename);
	    }
	    
	    if ($to_del)
		unlink($filename);
	}
    }
    
    function loadForProgress($self, $progress, $pos, $max){
	
	if (!$progress) return;
	
	if (is_object($progress)){
	    
	    $progress->max      = $max;
	    $progress->position = $pos;
	} elseif (function_exists($progress)){
	    
	    $progress($pos, $max, $self);
	}
    }
    
    function _start($self = false){
        
        $st_err = err_status(false);
        
        if ($self)
            $obj = c($self);
        else
            $obj =& $this;
        
        $props = TComponent::__getPropExArray($obj->self);
        
        $filename = $obj->url;
        $path     = $obj->path;
        $buffer   = $obj->buffer;
	
	
	if (!trim($path)){
	    $path = TEMP_DIR.'/devels/';
	}
        
        $filename = trim($filename);	
	$fh = fopen($filename, "r");
	
	if (err_last()){
            
            if ($props['onerror']){
                $err = err_msg();
                eval($props['onerror'].'($obj->self, $err);');
            }
            
            err_status($st_err);
            return;
        }
        
	$info = self::fileInfo($fh);
        
        $obj->size = $info['size'];
        $obj->pos  = 0;
        
        if (!$info['location']) $info['location'] = basename($filename);
        
        $obj->fileName = replaceSl( $path . basename($info['location']) );
        
        if (!is_dir(dirname($obj->fileName)))
            mkdir( dirname($obj->fileName), 0777, true );
        
        $fs = fopen( trim($obj->fileName), "w");
        
        $GLOBALS['fs'] =& $fs;
        $pos = 0;
        
	$progress = $obj->setProgress;
	if ($progress){
	    if (function_exists($progress))
	    ;
	    else
		$progress = c($progress);
	}
	
        $obj->isStop = false;
	
        while(($str = fread($fh, (int)$buffer)) != null){
            
            $pos += strlen($str);
            $obj->pos = $pos;
            
            if ($pos>$info['size']){
                $pos = $info['size'];
            }    
            
	    self::loadForProgress($obj, $progress, $pos, $info['size']);
	    
            if ($props['ondownload']){
                eval($props['ondownload'].'($obj->self, $pos, $info["size"]);');
            }
            
            if ($obj->isStop)
                break;
            
            fwrite($fs, $str);
        }
        
       
        err_status($st_err);
                
        if (err_msg() && $pos!=$info['size']){
            
            if ($props['onerror']){
                $err = err_msg();
                eval($props['onerror'].'($obj->self, $err);');
            }
        } else {
            $st_err = err_status(false);
            fclose($fs);            
            err_status($st_err);
            
	    self::loadForObject($obj, $obj->fileName, !trim($obj->path));
            if ($props['oncomplete']){
		
                eval($props['oncomplete'].'($obj->self,"");');
            }
        }
    }
    
    function start(){
        
        if ($this->thread){
            
            $code = ' TDownload::_start('.$this->self.'); ';
            
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
            $this->_start();
        }
    }
    
    function pause(){
        
        $t = getGlobalVar($this->thread_var);
        if ($t)
            $t->suspend();
    }
    
    function stop(){
        
        $t = getGlobalVar($this->thread_var);
        if ($t){
            
            $this->isStop = true;
            unsetGlobalVar($this->thread_var);
        }
    }
}

?>