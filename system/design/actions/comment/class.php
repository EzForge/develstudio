<?


class action_comment extends action_Simple {
    
    
    function getLineParams($line, $action){
        
        $k = strpos($line,'//');
        
        $pr1 = substr($line, 0, $k+2);
        $pr2 = substr($line, $k+2, strlen($line)-strlen($pr1));
        
        return array(trim($pr2));
    }
    
    function getResult($command, $result, $action){
        
        return '// ' . trim($result[0]);
    }
}