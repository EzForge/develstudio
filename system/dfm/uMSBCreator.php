<?


class myMSBCreator {
    
    static $code;
    
    static function show(){
        
        self::$code = c('fmPHPEditor.memo',1)->text;
        
        myMSBCreator::generate(self::$code, false);
        if (c('fmMSBCreator')->showModal() != mrOk)
            c('fmMSBCreator.memo',1)->text = self::$code;
    }
    
    static function selectIndex($index){
        
        $list = c('fmMSBCreator->list',1);
        $list->items->select($index);
        
        SendMessage($list->handle, 0x1000 + 19, $index, -1); // fix scroll
    }
    
    static function setAction($action, $line, $i){
        
        $list= c('fmMSBCreator->list',1);
        $_items = $list->items;
        
        if ( $_items->get($i) ){
            $item = $_items->get($i);   
        } else {
            $item = $list->items->add();
        }
        
        $item->imageIndex = $action['ICON_ID'];
        
        $item->caption = $action['TEXT'];
        $inline = myActions::getInline($action, $line);
        
        $item->subItems = $inline;
    }
    
    static function generate($code, $check = true){
        
        if ( $check && !c('fmMSBCreator',1)->visible ) return;
        
        $arr = explode(_BR_, $code);
        $list= c('fmMSBCreator->list',1);
        
        //$list->items->clear();
        
        foreach ($arr as $i=>$line){
            
            $action = myActions::getAction($line);
            self::setAction($action, action_Simple::trimLine($line), $i);
        }
        
        $_items = $list->items;
        $c1 = $_items->count();
        $c2 = count($arr);

        if ( $c1>$c2 ){
            
            for($i=$c1;$i>$c2;$i--){
                $_items->delete($i);
            }
        }
        
        $_items->delete($c2);
        
        myMSBCreator::selectIndex(c('fmPHPEditor.memo',1)->caretY-1);
    }
}


class ev_fmMSBCreator_list {
    
    static function onClick($self){
        
        $index = c($self)->items->selected[0];
        
        $code = explode(_BR_, c('fmPHPEditor.memo',1)->text);
        $line = $code[$index];
        
        c('fmMSBCreator->e_code')->text = $line;
        c('fmPHPEditor.memo',1)->caretY = $index+1;
    }
    
    static function onKeyUp($self, $key){
         
        self::onClick($self);
    }
    
    static function onKeyDown($self, $key){
        
        if ($key==VK_RETURN)
            self::onDblClick($self);
        elseif ($key==VK_ESCAPE){
            c('fmMSBCreator')->close();
            c('fmMSBCreator')->modalResult = mrCancel;
        }    
    }
    
    static function onDblClick($self){
        
        $action = myActions::getAction(action_Simple::getLine());
        if ($action){
            action_Simple::openDialog($action['DIALOG'], $action);
            self::onClick($self);
        }
    }
}