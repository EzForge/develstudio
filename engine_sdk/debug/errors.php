<?

/*
 
    PHP Soul Engine Error Hooker
    
    2009.04 ver 0.2
    
    Main function:
        __error_hook(type, filename, line, msg)
        
    // перехватчик ошибок...
    
*/

$GLOBALS['__show_errors'] = true;

// определяемая пользователем функция обработки ошибок
function userErrorHandler($errno = false, $errmsg = '', $filename='', $linenum=0, $vars=false)
{
    
    if ($errno == E_NOTICE) return;
    if ($errno == 2048) return;
    
    if (!$errno){
        
        $prs = v('__'.__FUNCTION__);
        
        $errno = $prs[0];
        $errmsg = $prs[1];
        $filename = $prs[2];
        $linenum = $prs[3];
        
        $GLOBALS['__eventInfo'] = v('__eventInfo');
        
    }
    
    if (defined('ERROR_NO_WARNING')){
        if ($errno == E_WARNING || $errno == E_CORE_WARNING || $errno == E_USER_WARNING) return;
    }
    
    if (defined('ERROR_NO_ERROR')){
        if ($errno == E_ERROR || $errno == E_CORE_ERROR || $errno == E_USER_ERROR) return;    
    }
    
        
    if (defined('IS_THREAD') && $GLOBALS['__show_errors']){
        
        //while (v('is_showerror')) {}
        //return;
        v('__'.__FUNCTION__, array($errno, $errmsg, $filename, $linenum));
        v('__eventInfo', $GLOBALS['__eventInfo']);
        c('form1')->text = serialize($GLOBALS['__eventInfo']);
        Thread::func('userErrorHandler');
        return;
    }
    
    
    $GLOBALS['__error_last'] = array(
                                     'msg'=>$errmsg,
                                     'file'=>$filename,
                                     'line'=>$linenum,
                                     'type'=>$errno,
                                     );
    
    if (!$GLOBALS['__show_errors'] || v('is_showerror')) return;
    
    v('is_showerror', true);
    // 
    global $__eventInfo;
    
    $errortype = array (
                E_ERROR           => "Error",
                E_WARNING         => "Warning",
                E_PARSE           => "Parsing Error",
                E_NOTICE          => "Notice",
                E_CORE_ERROR      => "Core Error",
                E_CORE_WARNING    => "Core Warning",
                E_COMPILE_ERROR   => "Compile Error",
                E_COMPILE_WARNING => "Compile Warning",
                E_USER_ERROR      => "User Error",
                E_USER_WARNING    => "User Warning",
                E_USER_NOTICE     => "User Notice",
                E_STRICT          => "Runtime Notice"
                );
    
    $type = $errortype[$errno];
    
    if (defined('DEBUG_OWNER_WINDOW')){
        
        $result['type'] = 'error';
        $result['script'] = $filename;
        $result['event']  = $__eventInfo['name'];
        $result['name'] = $__eventInfo['obj_name'];
        $result['msg']  = $errmsg;
        $result['errno']= $errno;
        $result['errtype'] = $type;
        $result['line'] = $linenum;
        $result['vars'] = array_keys($vars);
        
        application_minimize();
        
        Receiver::send(DEBUG_OWNER_WINDOW, $result);
        
        application_restore();
        $GLOBALS['APPLICATION']->toFront();
        v('is_showerror', false);
        return;
    }
    
    $arr[]= '['.$type.']';
    $arr[]= t('Message').': "' . $errmsg . '"';
    
    if (file_exists($filename)){
        $arr[]= ' ';
        
        if (defined('EXE_NAME'))
            $filename = str_replace(replaceSr(dirname(replaceSl(EXE_NAME))),'',$filename);
        
        $arr[] = $filename;
        $arr[] = t('On Line').': ' . $linenum;
    }
    
    if ($__eventInfo){
        
        $arr[] = ' ';
        $arr[] = '['.t('EVENT').']';
        if ($__eventInfo['name'])
            $arr[] = t('Type').': '.$__eventInfo['name'];
            
        if ($__eventInfo['obj_name'])
            $arr[] = t('Object').': "' .$__eventInfo['obj_name'].'"';
    }
    
    $arr[] = ' ';
    $arr[] = '.:: '.t('To abort application?').' ::.';
    
    $str = implode(_BR_, $arr);
    
    message_beep(MB_ICONERROR);
    $old_error_handler = set_error_handler("userErrorHandler");

    switch (messageDlg($str, mtError, MB_OKCANCEL)){
        
        case mrCancel: v('is_showerror', false); return true;
        case mrOk: application_terminate(); v('is_showerror', false); return false; break;
    }
    
    return;
}


$old_error_handler = set_error_handler("userErrorHandler");

function error_message($msg){
    messageBox($msg, appTitle() . ': Error', MB_ICONERROR);
    die();
}

function error_msg($msg){
    messageBox($msg, appTitle() . ': Error', MB_ICONERROR);
}

function __error_hook($type, $filename, $line, $msg){
    error_message("'$msg' in '$filename' on line $line");
}

function checkFile($filename){
    $filename = str_replace('//','/',replaceSl($filename));
    
    if (!file_exists(DOC_ROOT . $filename) && !file_exists($filename)){
        error_message("'$filename' is not exists!");
        die();
    }
}

function err_no(){
    $GLOBALS['__show_errors'] = false;
    $GLOBALS['__error_last']  = false;
}

function err_status($value = null){
    
    $GLOBALS['__error_last']  = false;
    if ($value===null)
        return $GLOBALS['__show_errors'];
    else{
        $res = $GLOBALS['__show_errors'];
        $GLOBALS['__show_errors'] = $value;
        return $res;
    }
}

function err_yes(){
    $GLOBALS['__show_errors'] = true;
    $GLOBALS['__error_last']  = false;
}

function err_msg(){
    return $GLOBALS['__error_last']['msg'];
}

function err_last(){
    return $GLOBALS['__error_last'];
}