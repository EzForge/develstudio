<?

class evfmPHPEditorTest {
    
    
    static function onClick ($self){
        
        c('fmPHPEditor.memo')->setFocus();
        c('fmPHPEditor.memo')->insertLine('Run("$progDir/my.exe");');
        
    }
}

class evfmPHPEditorMEMO {
    
    static function onDblClick($self){
        
        $w = c('fmPHPEditor->panelActions')->w;
        if ($w < 35) return;
        
        $action = myActions::getAction(action_Simple::getLine());
        if ($action){
            
            action_Simple::openDialog($action['DIALOG'], $action);
        }
    }
    
    static function onMouseDown($self){
        
        
        $action = myActions::getAction(action_Simple::getLine());
        
        if ($action){
            c('fmPHPEditor.info',1)->caption = $action['TEXT'];
            c('fmPHPEditor.action_image',1)->loadPicture($action['ICON']);
            c('fmPHPEditor.desc',1)->caption = myActions::getInline($action);
        } else {
            c('fmPHPEditor.info',1)->caption = '';
            c('fmPHPEditor.desc',1)->caption = '';
            c('fmPHPEditor.action_image',1)->picture->clear();
        }
    }
    
    
    static function onKeyPress($self){
        
        self::onMouseDown($self);
    }
    
    static function onKeyUp($self){
        
        self::onMouseDown($self);
    }
    
    static function onClick($self){
        self::onMouseDown($self);
    }
    
}

class ev_fmPHPEditor_btn_new {
    static function onClick(){ c('fmPHPEditor->memo')->text = ''; }
}


class ev_fmPHPEditor_btn_open {
    static function onClick(){
        
        $dlg = new TOpenDialog;
        $dlg->filter = DLG_FILTER_ALL;
        
        if ($dlg->execute()){
            c('fmPHPEditor->memo')->text =  file_get_contents($dlg->fileName) ;   
        }
        
        $dlg->free();
    }
}


class ev_fmPHPEditor_btn_save {
    static function onClick(){
        
        $dlg = new TSaveDialog;
        $dlg->filter = 'PHP Script (.php)|*.php';
        
        if ($dlg->execute()){
            
            $fileName = $dlg->fileName;
            if (fileExt($fileName)!='php') $fileName .= '.php';
            
            file_p_contents( $fileName, c('fmPHPEditor->memo')->text );   
        }
        
        $dlg->free();
    }
}


class ev_fmPHPEditor_btn_find {
    static function onClick(){
        
        c('fmPHPEditor->p_search')->visible = !c('edt_FindDialog->p_search')->visible;
        c('fmPHPEditor->p_search')->repaint();
        c('fmPHPEditor->f_text')->setFocus();
    }
}


class ev_fmPHPEditor_it_find {
    
    static function onClick(){
        
        if (c('p_search')->visible){
            ev_fmPHPEditor_f_text::onKeyUp(0,13);
        } else {
            ev_fmPHPEditor_btn_find::onClick();
        }
    }
}

class ev_fmPHPEditor_f_next {
    
    static function onClick(){
        ev_fmPHPEditor_f_text::onKeyUp(0, 13);
    }
}


class ev_fmPHPEditor_f_prev {
    
    static function onClick(){
        
        $GLOBALS['__findIndex'] -= 1;
        
        if ($GLOBALS['__findIndex']<0)
            $GLOBALS['__findIndex'] = count($GLOBALS['__find'])-1;
        
        ev_fmPHPEditor_f_text::onKeyUp(0, 13);
        
        $GLOBALS['__findIndex'] -= 1;
    }
}

class ev_fmPHPEditor_c_register {
    
    static function onClick(){
        
        unset($GLOBALS['__find']);
        unset($GLOBALS['__findIndex']);
    }
    
    static function onKeyUp($self, $key){
        ev_fmPHPEditor_f_text::onKeyUp($self, $key);
    }
}

class ev_fmPHPEditor_f_text {
    
    static function onKeyUp($self, $key){
        
        if ($key==13 || $key==114){
            
            if (!c('f_text')->text) return;
            
            if (!isset($GLOBALS['__findIndex']))
                $GLOBALS['__findIndex'] = 0;
            
            
            c('memo')->selStart = 0;
            c('memo')->selEnd   = 0;
            
            $start = myEvents::findTextItem($GLOBALS['__findIndex']);
            $length = strlen(c('f_text')->text);
            
            if (!isset($start)){
                
                if (count($GLOBALS['__find'])==0)
                    msg(t('Nothing found.'));
                else
                    msg(t('Search is over. Found % matches.', count($GLOBALS['__find'])));
                
                $GLOBALS['__findIndex'] = 0;
                return;
            }
            
            $GLOBALS['__findIndex']++;
            
            c('memo')->selStart = $start;
            c('memo')->selEnd   = $start + $length;
            c('fmPHPEditor->memo')->setFocus();
            
        } elseif ($key==VK_ESCAPE){
                
            c('fmPHPEditor->p_search')->visible = !c('edt_FindDialog->p_search')->visible;
            c('fmPHPEditor->memo')->setFocus();
            
        } else {
            $GLOBALS['__findIndex'] = 0;
            myEvents::findText();
        }
    }
}



class ev_fmPHPEditor_btn_undo {
    static function onClick(){
        c('fmPHPEditor->memo')->undo();
    }
}

class ev_fmPHPEditor_btn_redo {
    static function onClick(){
        c('fmPHPEditor->memo')->redo();
    }
}


class ev_fmPHPEditor_btn_codemaster {
    static function onClick(){
        
        myMSBCreator::show();
    }
}


class ev_fmPHPEditor_it_codemaster {
    
    static function onClick(){
        
        myMSBCreator::show();
    }
}

class ev_fmPHPEditor_it_saveevent {
    function onClick(){
        global $myEvents;
        
        myComplete::saveCode();
        $event = c('fmPHPEditor')->event;
        $name  = $myEvents->selObj instanceof TForm ? '--fmedit' : $myEvents->selObj->name;
        eventEngine::setEvent($name, $event, c('fmPHPEditor->memo')->text);    
        myHistory::go();
        
        message_beep(66);
        c('fmPHPEditor->btn_cancel')->enabled = false;
    }
}

class ev_fmPHPEditor_it_selectall {
    static function onClick(){
         c('fmPHPEditor->memo')->selectAll();
    }
}

class ev_fmPHPEditor_it_cut {
    static function onClick(){
         c('fmPHPEditor->memo')->cutToClipboard();
    }
}

class ev_fmPHPEditor_it_copy {
    static function onClick(){
         c('fmPHPEditor->memo')->copyToClipboard();
    }
}

class ev_fmPHPEditor_it_paste {
    static function onClick(){
         c('fmPHPEditor->memo')->pasteFromClipboard();
    }
}

class ev_fmPHPEditor_btn_options {
    function onClick(){
        
        c('fmPHPEditor->SynPHPSyn')->saveToArray($arr);
        $color = c('fmPHPEditor->memo')->color;
        if (c('fmEditorSettings')->showModal()!=mrOk){
            c('fmPHPEditor->SynPHPSyn')->loadFromArray($arr);
            c('fmPHPEditor->memo')->color = $color;
        }
    }
}