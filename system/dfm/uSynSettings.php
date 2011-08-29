<?


class ev_fmEditorSettings {
    
    static $bColor;
    static $fColor;
    static $bgColor;
    
    function getAttri(){
        
        $list    = c('fmEditorSettings->list');
        $prefixs = array('Comment', 'Identifier', 'Key', 'Number', 'Space', 'String', 'Symbol', 'Variable');
        $index   = $list->itemIndex;
        
        if ($index != -1)
            return c('fmPHPEditor->SynPHPSyn')->getAttri($prefixs[$index]);
        else
            return false;
    }
    
    function bColorSelect($self, $color){
        
        $attr = self::getAttri();
        $attr->background = $color;
    }
    
    function bgColorSelect($self, $color){
        
        c('fmPHPEditor->memo')->color = $color;
    }
    
    function fColorSelect($self, $color){
        
        $attr = self::getAttri();
        $attr->foreground = $color;
    }
    
    function onActive(){
        
        ev_fmEditorSettings::$bgColor->value = c('fmPHPEditor->memo')->color;
        ev_fmEditorSettings_list::onClick(0);
        ev_fmEditorSettings::updateHighLightCfg();
    }
    
    function getHighlight(){
        
        $files = findFiles(SYSTEM_DIR.'/myprofile/highlight/','ini');
        $files = array_merge( $files, findFiles(DS_USERDIR.'/highlight/','ini') );
        
        foreach ($files as $file){
            $lines[] = basenameNoExt($file); 
        }
        
        $lines = array_unique($lines);
        return (array)$lines;
    }
    
    function updateHighLightCfg(){
        
        c('fmEditorSettings->c_config')->text = self::getHighlight();
        c('fmEditorSettings->c_config')->itemIndex = -1;
    }
    
    function saveHightLight($name){
        
        c('fmPHPEditor->SynPHPSyn')->saveToArray($arr);
        $arr['main']['color'] = c('fmPHPEditor->memo')->color;
        
        $ini = new TIniFileEx;
        $ini->arr = $arr;
        $ini->filename = DS_USERDIR.'/highlight/'.$name.'.ini';
        $ini->updateFile();
    }
    
    function loadHightLight($name){
        
        $file = DS_USERDIR.'/highlight/'.$name.'.ini';
        if (! file_exists($file) )
            $file = SYSTEM_DIR.'/myprofile/highlight/'.$name.'.ini';
            
        if (!$file) continue;
        
        $ini = new TIniFileEx($file);
        c('fmPHPEditor->SynPHPSyn')->loadFromArray($ini->arr);
        c('fmPHPEditor->memo')->color = $ini->read('main','color',clWhite);
    }
    
    function deleteHighlight($name){
        
        $file = DS_USERDIR.'/highlight/'.$name.'.ini';
        if (file_exists($file))
            unlink($file);    
    }
    
    function onShow(){
        
        $form = c('fmEditorSettings');
        $group= c('fmEditorSettings->groupBox');
        self::$bColor = new TEditColorDialog( $form );
        self::$bColor->parent = $group;
        self::$bColor->x = 90;
        self::$bColor->y = 28;
        self::$bColor->w = 215;
        self::$bColor->onSelect = 'ev_fmEditorSettings::bColorSelect';
        
        self::$fColor = new TEditColorDialog( $form );
        self::$fColor->parent = $group;
        self::$fColor->x = 90;
        self::$fColor->y = 55;
        self::$fColor->w = 215;
        self::$fColor->onSelect = 'ev_fmEditorSettings::fColorSelect';
        
        self::$bgColor = new TEditColorDialog( $form );
        self::$bgColor->parent = $form;
        self::$bgColor->y = 196;
        self::$bgColor->x = 90;
        self::$bgColor->w = 160;
        self::$bgColor->onSelect = 'ev_fmEditorSettings::bgColorSelect';
        
        self::onActive();
    }
    
    function getStyle($style, $checked, $val){
        
        $style = str_ireplace($val,'',$style);
        $style = str_replace(' ','',$style);
        $style = str_replace(',,',',',$style);
        if (substr($style,-1)==',') $style = substr($style,0,-1);
        
        if ($checked)
            $style .= $style ? ','.$val : $val;
        
        return $style;
    }
}


class ev_fmEditorSettings_c_bold {
    
    function onMouseUp($self){
        
        $attr = ev_fmEditorSettings::getAttri();
        if ($attr)
            $attr->style = ev_fmEditorSettings::getStyle($attr->style, c($self)->checked, 'fsBold');
    }
}


class ev_fmEditorSettings_c_italic {
    
    function onMouseUp($self){
        
        $attr = ev_fmEditorSettings::getAttri();
        if ($attr)
            $attr->style = ev_fmEditorSettings::getStyle($attr->style, c($self)->checked, 'fsItalic');    
    }
}

class ev_fmEditorSettings_c_underline {
    
    function onMouseUp($self){
        
        $attr = ev_fmEditorSettings::getAttri();
        if ($attr)
            $attr->style = ev_fmEditorSettings::getStyle($attr->style, c($self)->checked, 'fsUnderline');
    }
}

class ev_fmEditorSettings_list {
    
    function onClick($self){
        
        $attr = ev_fmEditorSettings::getAttri();
        if ($attr){
            
            ev_fmEditorSettings::$bColor->value = $attr->background;
            ev_fmEditorSettings::$fColor->value = $attr->foreground;
            c('fmEditorSettings->c_bold')->checked = strpos($attr->style, 'fsBold')!==false;
            c('fmEditorSettings->c_italic')->checked = strpos($attr->style, 'fsItalic')!==false;
            c('fmEditorSettings->c_underline')->checked = strpos($attr->style, 'fsUnderline')!==false;
        }
    }
}

class ev_fmEditorSettings_c_config {
    
    function onChange($self){
        
        $files = c($self)->items->lines;
        $index = c($self)->itemIndex;
        ev_fmEditorSettings::loadHightLight($files[$index]);
    }
}

class ev_fmEditorSettings_btn_addcfg {
    
    function onClick($self){
        
        $self  = c('fmEditorSettings->c_config')->self;
        $files = c($self)->items->lines;
        $index = c($self)->itemIndex;
        $name  = inputText(t('Add highlight'), t('Name'), $files[$index]);
        $name  = str_ireplace(array('?','\\','/','>','<','|','"',':'),'', $name);
        
        if ($name){
            ev_fmEditorSettings::saveHightLight($name);
            ev_fmEditorSettings::updateHighLightCfg();
        }
    }
}

class ev_fmEditorSettings_btn_delcfg {
    
    function onClick($self){
        
        $self  = c('fmEditorSettings->c_config')->self;
        $files = c($self)->items->lines;
        $index = c($self)->itemIndex;
        
        if (!$files[$index]) return;
        
        if (confirm(t('To delete "%s" highlight?', $files[$index]))){
            
            $name = $files[$index];
            if ($name){
                ev_fmEditorSettings::deleteHighlight($name);
                ev_fmEditorSettings::updateHighLightCfg();
            }
        }
    }
}