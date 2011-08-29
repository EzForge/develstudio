<?


class action_winLocalPath extends action_Simple {
    
    
    function getLineParams($line, $action){
        
        $tmp = explode('=',$line);
        $result[0] = trim($tmp[0]);
        
        $prs = parent::getLineParams(trim($tmp[1]));
        
        return array_merge($result, $prs);
    }
    
    function getResult($command, $result, $action){
        
        return $result[0] . ' = winLocalPath( ' . trim($result[1]) . ' );';
    }
}