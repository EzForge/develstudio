<?



class myComplete {
    
    
    static function init(){
        
        global $myComplete, $synComplete, $synHint, $phpMemo, $completeList,
                $showHint, $showComplete;
                
        $synComplete = c('fmPHPEditor->synComplete');
        $synHint     = c('fmPHPEditor->synHint');
        $phpMemo     = c('fmPHPEditor->memo');
        $phpMemo->onKeyDown = 'myComplete::memoKeyUp';
        $phpMemo->onKeyPress= 'myComplete::memoKeyPress';
        
        $synComplete->onClose='myComplete::synClose';
        $synHint->onClose    ='myComplete::synClose';
        
        c('fmPHPEditor->hide_err_list')->onClick = 'myComplete::hideErrors';
        
        $myComplete = new myComplete;
        
        $dir = DOC_ROOT . '/design/complete/';
        $completes = findDirs($dir);
        foreach ($completes as $code){
            
            $i_dir = $dir . $code . '/';
            
            if (!file_exists($i_dir . 'info.php')) continue;
            
            $info  = include $i_dir . 'info.php';
            $info['CODE'] = $code;
            
            if (file_exists($i_dir . 'class.php')){
                include $i_dir . 'class.php';
                
                $class = 'complete_' . $code;
                if (method_exists($class, 'init'))
                    call_user_method('init', $class);
            }
            
            $completeList[] = $info;
        }
        
        // сортируем весь массив по полю СОРТ
        BlockData::sortList($completeList, 'SORT');
        
       // $completeList =& $completes;
        //setThreadTimer(2000, 'myComplete::checkSyntax();');
        setTimer(200, 'myComplete::checkInline()');
    }
    
    static function saveCode(){
        
        global $completeList, $phpMemo;
        $code = $phpMemo->text;
        
        foreach ($completeList as $complete){
            
            $class = 'complete_'.$complete['CODE'];
            if (method_exists($class, 'saveCode'))
                call_user_method('saveCode', $class, $code);
        }
    }
    
    static function memoKeyUp($self, $key){
        
        global $phpMemo, $synComplete, $synHint;
        $phpMemo->onChange = 'myComplete::memoChange';
        unset($GLOBALS['__find']);
        unset($GLOBALS['__findIndex']);
    }
    
    static function memoKeyPress($self, $key){
        
        global $phpMemo, $synComplete, $synHint;
    }
    
    static function synClose(){
        
        global $showComplete, $showHint;
        
        $showComplete = false;
        $showHint     = false;
    }
    
    static function _memoChange(){
        
        global $phpMemo, $synComplete, $synHint, $showComplete, $showHint;
        
        c('fmPHPEditor->btn_cancel')->enabled = true;
        
        if ($synComplete->visible) return;
        $lineText = $phpMemo->lineText;
        $result = self::findComplete();    
            
        if ($result){
            
            if ($result['TYPE']=='HINT'){
                if (!$showHint){
                
                    $synHint->item   = (array)$result['ARR']['item'];
                    $synHint->insert = (array)$result['ARR']['insert'];
                    //c('fmPHPEditor')->formStyle = fsStayOnTop;
                    $synHint->active();
                    //c('fmPHPEditor')->formStyle = fsNormal;
                    $synComplete->active(false);
                    $showHint = true;
                    $showComplete = false;
                }
            } elseif (true/*!$showComplete*/) {
                
                $synComplete->item   = (array)$result['ARR']['item'];
                $synComplete->insert = (array)$result['ARR']['insert'];
                $synComplete->active();
                $synHint->active(false);
                c('fmPHPEditor')->show();
                
                $showComplete = true;
                $showHint     = false;
            }
            
        } else {
            
            $tmp   = new complete_Funcs;
            $result['ARR'] = $tmp->getList($text);
            unset($tmp);
            
            $synComplete->item = $result['ARR']['item'];
            $synComplete->insert= $result['ARR']['insert'];
            
            if (!trim(self::getLastText())){
                $synComplete->active(false);
                $synHint->active(false);
            }
            
            $showComplete = false;
            $showHint     = false;
        }
        
        setTimeout(1,'global $phpMemo; $phpMemo->onChange = "_empty"');
    }
    
    static function memoChange($self){
        
        global $showHint, $showComplete;
        
        $showComplete = $synComplete->form->visible && $showComplete;
        if (!$showComplete){
            $showComplete = true;
            setTimeout(1, 'myComplete::_memoChange(); global $showComplete; $showComplete = false;');
        }
    }
    
    static function getLastText(){
        
        global $phpMemo;
        $lineText = $phpMemo->lineText;
        
        $lineText = ($lineText);
        $x        = $phpMemo->caretX;
        
        if ($x == 0) return false;
        if ($x-2 >= strlen($lineText)) return false;
        
        $text     = ltrim(substr($lineText, 0, $x-1));
        
        $text     = explode(' ', $text);
        $result   = $text[count($text)-1];
        
        $result   = explode(';', $result);
        $result   = $result[count($result)-1];
        
        $result   = explode('{', $result);
        $result   = $result[count($result)-1];
        
        //$result   = explode('(', $result);
       // $result   = $result[count($result)-1];
        
        $result   = explode('[', $result);
        $result   = $result[count($result)-1];
        
        return $result;
    }
    
    function findComplete(){
        
        global $completeList;
        $text =  self::getLastText() ;
        
        foreach ($completeList as $one){
            
            if (preg_match($one['PREG'], $text)){
                $result = $one;
                break;
            }
        }
        
        if (!$result) return false;
        
        $class = 'complete_' . $result['CODE'];
        $tmp   = new $class;
        $result['ARR'] = $tmp->getList($text);
        unset($tmp);
        
        return $result;
    }
    
    static function fromBB($text){
        
        $text = str_ireplace('[B]','\style{+B}', $text);
        $text = str_ireplace('[/B]','\style{-B}', $text);
        $text = str_ireplace('[I]','\style{+I}', $text);
        $text = str_ireplace('[/I]','\style{-I}', $text);
        
        $text = str_ireplace(array(
                                   '[U]',
                                   '[/U]',
                                   '[$R]',
                                   '[$B]',
                                   '[$G]',
                                   '[$GR]',
                                   '[$S]',
                                   '[$BL]',
                                   ),
                             array(
                                   '\style{+U}',
                                   '\style{-U}',
                                   '\color{$CC}',
                                   '\color{clBlack}',
                                   '\color{clGreen}',
                                   '\color{clGray}',
                                   '\color{clSilver}',
                                   '\color{clBlue}',
                                   ),
                             
                             $text
                             );
        
        return $text;
    }
    
    static function checkInline(){
        
        if (!c('fmPHPEditor',1)->visible) return;
        
        $synComplete = c('fmPHPEditor->synComplete',1);
        
        //global $showComplete, $synComplete;
        
        if ($synComplete->get_empty()){
                $synComplete->active(false);
        }
    }
    
    static function checkSyntax() {
        
        if (!c('fmPHPEditor',1)->visible) return; 
                                  
        
        $phpMemo = c('fmPHPEditor->memo');
        $code    = $phpMemo->text;
        
        $checker = new PHPSyntax;
        $checker->check($code);
        $lines   = array();
        
        foreach ($checker->errors as $err){
            
            if ($err['prs'])
                $add = ' - "'. $err['prs'] . '"';
            else
                $add = '';
            
            $str = '['.$checker->errType( $err['type'] );
            if ($err['line'])
                $str .= ': '.t('line').' - '.$err['line'];
                
            $str .= '] ' . t($err['msg']) . $add;
            $lines[] = $str;
        }
        
        $index = c('fmPHPEditor->err_list',1)->itemIndex;
        c('fmPHPEditor->err_list',1)->text = $lines;
        c('fmPHPEditor->err_list',1)->itemIndex = $index;
    }
    
    static function hideErrors($self){
        
        c('errPanel')->height = 1;
    }

}
