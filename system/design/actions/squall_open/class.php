<?


class action_squall_open extends action_Simple {
    
    
    function getLineParams($line, $action){
        
        $tmp = explode('->open',$line);
        $result[0] = trim($tmp[0]);
        
        $prs = parent::getLineParams(trim($tmp[1]));
        
        return array_merge($result, $prs);
    }
    
    function getResult($command, $result, $action){
        
        return $result[0] . '->open(' . trim($result[1]) . ');';
    }
}