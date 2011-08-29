<?


global $_c;

  $_c->MOD_ALT = 1;
  $_c->MOD_CONTROL = 2;
  $_c->MOD_SHIFT = 4;
  $_c->MOD_WIN = 8;

$GLOBALS['__key_funcs'] = array();
$GLOBALS['__key_funcs2'] = array();
$GLOBALS['__hotkey_funcs'] = array();



class HotKey {
    
    static function event($modifer, $key){
        
        global $__hotkey_funcs;
        
        foreach ((array)$__hotkey_funcs as $el){
            if (!($el['MODIFER']==$modifer && $el['KEY']==$key)) continue;
            
            $func = eval($el['FUNC'].'();');
        }
    }
    
    static function add($modifer, $key, $func_name){
        
        global $__hotkey_funcs;
        
        reg_hot_key(rand(),$modifer, $key);
        
        $__hotkey_funcs[] = array(
            'FUNC' => $func_name,
            'MODIFER' => $modifer,
            'KEY' => $key,
        );
    }
}


function __onKeyPress(){
    for($i=0;$i<255;$i++){
        if (get_key_state($i)<0){
            global $key_funcs;
            if (count($key_funcs)==0) return;
            foreach ((array)$key_funcs as $func)
                    $func($i);
        }
    }
}

function addKeyEvent($func_name){
    if (function_exists($func_name)){
        global $key_funcs;
        $key_funcs[] = $func_name;
    }
}

function regKeyPress($func_name,$key){
    global $key_funcs2;
    $key_funcs2[$key][] = $func_name;
}

function __doKeyPress($i){
    global $key_funcs2;
    if (count($key_funcs2)==0) return;
    
    if (!array_key_exists($i,$key_funcs2)) return;
        foreach ((array)$key_funcs2[$i] as $func)
            $func();
}

//setTimer(50,'__onKeyPress');
addKeyEvent('__doKeyPress');
?>