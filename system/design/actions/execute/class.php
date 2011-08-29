<?


class action_execute extends action_Simple {
    
    
    function getLineParams($line, $action){
        
        $tmp = explode('=',$line);
        $result[0] = trim($tmp[0]);
        
        $k = strrpos(trim($tmp[1]),'->');
        
        $result[1] = substr(trim($tmp[1]), 0, $k);
        
        return $result;
    }
    
    function getResult($command, $result, $action){
        
        return $result[0] . ' = ' . trim($result[1]) . '->execute();';
    }
}