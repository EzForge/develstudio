<?


class action_setObjProp extends action_Simple {
    
    
    function getLineParams($line, $action){
        
        $k = strpos($line,'=');
        
        $pr1 = substr($line, 0, $k-1);
        $pr2 = substr($line, $k+1, strlen($line)-strlen($pr1)-2);
        
        
        return array(trim($pr1), trim($pr2));
    }
    
    function getResult($command, $result, $action){
        
        return trim($result[0]) . ' = ' . trim($result[1]) . ';';
    }
}