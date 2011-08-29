<?

$GLOBALS['checkVer_timer'] = setTimer(10000, 'evfmMain::checkVer()');

class evfmMain {
    
    static function checkVer(){
        
        global $dsg_cfg;
        $last_ver = c("fmMain")->lastVer;
        if ($last_ver){
            
            if ($dsg_cfg->main->lastVer!=$last_ver && compareVer($last_ver, DV_VERSION)===1){
                
                
                $dsg_cfg->main->lastVer = $last_ver;
                
                if (messageBox(t("Доступна новая версия: %s\nОбновить программу?",$last_ver), t('.: Мастер обновления :.'), MB_YESNO)==mrYes){
                    run(dirname(EXE_NAME).'/update.exe');
                }
            }
            
            $GLOBALS['checkVer_timer']->free();
        }
    }
    
    static function onShow(){
        
        $t = new Thread;
        $t->code = '
            
            err_no();
            $file_info = file("http://develstudio.ru/upd/last.txt");
            $last_ver = $file_info[3];
            
                c("fmMain")->lastVer  = $last_ver;
                c("fmMain")->fileInfo = $file_info;
        ';

        $t->start();
    }
    
    // сохранение настроек программы...
    static function saveMainConfig(){
        
        global $_sc;
        $_sc->clearTargets();
        myProperties::unFocusPanel(); // fix AV !!!
        global $dsg_cfg, $_sc;
        global $fmEdit, $fmComponents, $fmMain, $fmObjInspect;
        
        $dsg_cfg->main->gridSize = $_sc->gridSize;
        $dsg_cfg->main->btnColor = $_sc->btnColor;
        $dsg_cfg->main->showGrid = (int)$_sc->showGrid;
        $dsg_cfg->main->lastVer  = $fmMain->lastVer;
        
        myProject::clearProject(); // for fix AV
        
        $dsg_cfg->fmMain->x  = $fmMain->left;
        $dsg_cfg->fmMain->y  = $fmMain->top;
        $dsg_cfg->fmMain->w  = $fmMain->width;
        $dsg_cfg->fmMain->h  = $fmMain->height;
        $dsg_cfg->fmMain->wS = $fmMain->windowState;
        
        $dsg_cfg->lastVer    = DV_VERSION;
        //$dsg_cfg->fmEdit->x = $fmEdit->left; 
        //$dsg_cfg->fmEdit->y = $fmEdit->top;
        
        $dsg_cfg->fmPHPEditor->w = c('fmPHPEditor',1)->w;
        $dsg_cfg->fmPHPEditor->h = c('fmPHPEditor',1)->h;
        $dsg_cfg->fmPHPEditor->x = c('fmPHPEditor',1)->x;
        $dsg_cfg->fmPHPEditor->y = c('fmPHPEditor',1)->y;
        $dsg_cfg->fmPHPEditor->wS= c('fmPHPEditor',1)->windowState;
        $dsg_cfg->fmPHPEditor->panelH = c('fmPHPEditor->errPanel')->h;
        
        $dsg_cfg->fmObjInspect->visible = (int)$fmObjInspect->visible;
        $dsg_cfg->newProjectDialog->startup = (int)c('fmNewProject->startup')->checked;
        $dsg_cfg->saveToFile(DS_USERDIR.'config.ini');
        
        Docking::saveFile(c('fmMain->pDockBottom'),DS_USERDIR.'bottom.dock');
        Docking::saveFile(c('fmMain->pDockRight'),DS_USERDIR.'right.dock');
        Docking::saveFile(c('fmMain->pDockLeft'),DS_USERDIR.'left.dock');
        
        myOptions::set('pDockRight','width', c('fmMain->pDockRight')->w);
        myOptions::set('pDockLeft','width', c('fmMain->pDockLeft')->w);
        myOptions::set('pDockBottom','height', c('fmMain->pDockBottom')->h);

        myOptions::setFloat('pComponents', c('fmMain->pComponents'));
        myOptions::setFloat('pInspector', c('fmMain->pInspector'));
        myOptions::setFloat('pProps', c('fmMain->pProps'));
        myOptions::setFloat('pDebugWindow', c('fmMain->pDebugWindow'));
        
        myOptions::set('components','groups', implode(',',c('fmMain->list')->selectedList));
        myOptions::set('components','smallIcons', c('fmMain->list')->smallIcons);        
        
        myOptions::set('actions','groups', implode(',',c('fmPHPEditor->list')->selectedList));
        myOptions::set('actions','smallIcons', c('fmPHPEditor->list')->smallIcons);        
        myOptions::set('actions','width', c('fmPHPEditor->panelActions')->w);
        
        myOptions::setXYWH('rundebug', c('fmRunDebug'));
        
        c('fmPHPEditor->SynPHPSyn')->saveToArray($arr);
        $arr['main']['color'] = c('fmPHPEditor->memo')->color;
        $ini = new TIniFileEx;
        $ini->arr = $arr;
        $ini->filename = DS_USERDIR.'phpsyn.ini';
        $ini->updateFile();
        
        $ini = new TIniFileEx;
        $ini->arr = (array)$GLOBALS['ALL_CONFIG'];
        $ini->filename = DS_USERDIR.'allconfig.ini';
        $ini->updateFile();
    }
    
    static function isDocked($obj){
        
        $panels = array('pDockLeft','pDockRight','pDockBottom');
        foreach ($panels as $panel){
            $list = c('fmMain->'.$panel)->dockList;
            foreach ($list as $el)
                if ($el->self == $obj->self) return true;
        }
        
        return false;
    }
    
    static function panelStartDock($self){
        
        __setVarEx( control_dragobject($self) );
    }
    
    static function loadMainConfig(){
        
        $ini = new TIniFileEx(DS_USERDIR.'phpsyn.ini');
        c('fmPHPEditor->SynPHPSyn')->loadFromArray($ini->arr);
        c('fmPHPEditor->memo')->color = $ini->read('main','color',clWhite);
        c('fmPHPEditor->panelActions')->width = myOptions::get('actions','width',111);
        if (c('fmPHPEditor->panelActions')->width < 5)
            c('fmPHPEditor->panelActions')->width = 5;
        
        myOptions::getXYWH('rundebug', c('fmRunDebug'));
        
        c('fmMain->pDockRight')->w = myOptions::get('pDockRight','width',200);
        c('fmMain->pDockLeft')->w = myOptions::get('pDockLeft','width',220);
        c('fmMain->pDockBottom')->h = myOptions::get('pDockBottom','height',170);
        
        c('fmMain->list')->selectedList = explode(',',myOptions::get('components','groups', 'main'));
        c('fmMain->list')->smallIcons   = myOptions::get('components','smallIcons',false);
        c('fmMain->c_type')->itemIndex  = c('fmMain->list')->smallIcons ? 1 : 0;
        
        c('fmPHPEditor->list')->selectedList = explode(',',myOptions::get('actions','groups', 'main'));
        c('fmPHPEditor->list')->smallIcons   = myOptions::get('actions','smallIcons',true);
        
        control_floatstyle( c('fmMain->pDockRight')->self );
        control_floatstyle( c('fmMain->pDockLeft')->self );
        control_floatstyle( c('fmMain->pDockBottom')->self );
        control_floatstyle( c('fmMain->pInspector')->self );
        control_floatstyle( c('fmMain->pComponents')->self );
        control_floatstyle( c('fmMain->pProps')->self );
        control_floatstyle( c('fmMain->pDebugWindow')->self );
        
        c('fmMain->pDebugWindow')->onStartDock = 'evfmMain::panelStartDock';
        c('fmMain->pInspector')->onStartDock = 'evfmMain::panelStartDock';
        c('fmMain->pProps')->onStartDock = 'evfmMain::panelStartDock';
        c('fmMain->pComponents')->onStartDock = 'evfmMain::panelStartDock';
           
        if (!file_exists(DS_USERDIR.'bottom.dock')){
            
            c('fmMain->pComponents')->manualDock(c('fmMain->pDockRight'), alTop);
            c('fmMain->pInspector')->manualDock(c('fmMain->pDockBottom'),alTop);
            c('fmMain->pProps')->manualDock(c('fmMain->pDockLeft'),alTop);
            c('fmMain->pDebugWindow')->manualDock(c('fmMain->pDockBottom'),alBottom);
            
        } else {
            Docking::loadFile(c('fmMain->pDockBottom'),DS_USERDIR.'bottom.dock');
            Docking::loadFile(c('fmMain->pDockRight'),DS_USERDIR.'right.dock');
            Docking::loadFile(c('fmMain->pDockLeft'),DS_USERDIR.'left.dock');
            
            if (!self::isDocked(c('fmMain->pComponents')))
                myOptions::getFloat('pComponents', c('fmMain->pComponents'));
            
            if (!self::isDocked(c('fmMain->pInspector')))    
                myOptions::getFloat('pInspector', c('fmMain->pInspector'));
                
            if (!self::isDocked(c('fmMain->pProps')))
                myOptions::getFloat('pProps', c('fmMain->pProps'));
                
            if (!self::isDocked(c('fmMain->pDebugWindow')))
                myOptions::getFloat('pDebugWindow', c('fmMain->pDebugWindow'));
        
            
            c('fmMain->it_components')->checked = c('fmMain->pComponents')->visible;
            c('fmMain->it_objectinspector')->checked = c('fmMain->pInspector')->visible;
            c('fmMain->it_props')->checked = c('fmMain->pProps')->visible;
            c('fmMain->it_debuginfo')->checked = c('fmMain->pDebugWindow')->visible;
        }
        
    }
    
    static function onCloseQuery($self, $canClose){
        
        
        if (!defined('IS_APPLICATION_START')) return false;
        $res = messageBox(t("Все данные будут утерены.\nВы хотите сохранить проект перед выходом?"),t('Closing Devel Studio'),MB_YESNOCANCEL);
        
        if ($res == mrYes){
            
            if (!myProject::saveAsDVSDialog()){
                __setVarEx(false);
                return false;
            }
            
            self::saveMainConfig();
        } elseif ($res == mrNo){
            
            self::saveMainConfig();
        } elseif ($res == mrCancel) {
            
            __setVarEx(false);
        }
        
    }

}

class ev_it_objectinspector {
    
    static function onClick($self){
        
        $GLOBALS['_sc']->updateBtns();
        c('fmMain->pInspector')->visible = !c('fmMain->pInspector')->visible;
        ev_it_props::setWidth(c('fmMain->pDockLeft'));
        ev_it_props::setWidth(c('fmMain->pDockRight'));
        ev_it_props::setHeight(c('fmMain->pDockBottom'));
    }
}

class ev_it_components {
    
    static function onClick($self){
        
        $GLOBALS['_sc']->updateBtns();
        c('fmMain->pComponents')->visible = !c('fmMain->pComponents')->visible;
        ev_it_props::setWidth(c('fmMain->pDockLeft'));
        ev_it_props::setWidth(c('fmMain->pDockRight'));
        ev_it_props::setHeight(c('fmMain->pDockBottom'));
    }
}


class ev_it_props {
    
    static function setWidth($panel){
        
        $list = $panel->dockList;
        $c = 0;
        foreach ($list as $el)
            if ($el->visible)
                $c++;
        
        if ($c > 0)
            $panel->w = 220;
        else
            $panel->w = 5;
    }
    
    static function setHeight($panel){
        
        $list = $panel->dockList;
        $c = 0;
        foreach ($list as $el)
            if ($el->visible)
                $c++;
        
        if ($c > 0)
            $panel->h = 170;
        else
            $panel->h = 5;
    }
    
    static function onClick($self){
        
        $GLOBALS['_sc']->updateBtns();
        c('fmMain->pProps')->visible = !c('fmMain->pProps')->visible;
        ev_it_props::setWidth(c('fmMain->pDockLeft'));
        ev_it_props::setWidth(c('fmMain->pDockRight'));
        ev_it_props::setHeight(c('fmMain->pDockBottom'));
    }
}


class ev_it_debuginfo {
    
    static function onClick($self){
        
        $GLOBALS['_sc']->updateBtns();
        c('fmMain->pDebugWindow')->visible = !c('fmMain->pDebugWindow')->visible;
        ev_it_props::setWidth(c('fmMain->pDockLeft'));
        ev_it_props::setWidth(c('fmMain->pDockRight'));
        ev_it_props::setHeight(c('fmMain->pDockBottom'));
    }
}

class ev_it_siteprogram {
    
    static function onClick(){
        
        shell_execute(0,'open','http://develstudio.ru/','','',SW_SHOW);
    }
}

class ev_fmMain_it_phphelp {
    
    static function onClick(){
        run('http://php.su/learnphp/');
    }
}

class ev_it_helpbook {
    
    static function onClick() {
        
        return shell_execute(0,'open','http://help.develstudio.ru/Vvedenie-16.html','','',SW_SHOW);
        
        if (!file_exists(DOC_ROOT . '/lang/' . LANG_ID . '/help.chm'))
            error_message(t('Help book not found for this language'));
        else
            shell_execute(0,'open', DOC_ROOT . '/lang/' . LANG_ID . '/help.chm');
    }
}

class ev_it_aboutprogram {
    
    static function onClick(){
        
        c('fmAbout')->showModal();
    }
}

class ev_it_exit {
    
    static function onClick(){
        c('fmMain')->close();
    }
}


class ev_it_masterupdate {
    
    static function onClick(){
        
        //run(dirname(EXE_NAME).'/update.exe');
        evalProject::openAsExe( dirname(EXE_NAME).'/update.dvsexe' );
    }
}

class ev_statusBar {
    
    static function onClick(){
        
        global $projectFile;
        shell_execute(0,'open', replaceSr(dirname($projectFile)).'\\', '', '', SW_SHOW);
    }
}

class ev_fmMain_pDockLeft {
    
    static function onDockDrop($self, $source){
        
        $GLOBALS['_sc']->updateBtns();
        $obj = c($self);
        $source = c($source);
        
        if ($obj->dockClientCount < 2)
          if ($obj->w < 30){
            $obj->w = 220;
            $source->w = 220;
          }
          else
            ;
    }
    
    static function onUndock($self, $count = 1){
        
        $GLOBALS['_sc']->updateBtns();
        $obj = c($self);
        if ($obj->dockClientCount <= 1)
            $obj->w = 5;
    }
}

class ev_fmMain_pDockRight {
    
    function onDockDrop($self){
        ev_fmMain_pDockLeft::onDockDrop($self);
    }
    
    function onUndock($self, $count = 1){
        ev_fmMain_pDockLeft::onUndock($self, $count);
    }
}


class ev_fmMain_pDockBottom {
    
    static function onDockDrop($self, $source){
        
        $GLOBALS['_sc']->updateBtns();
        
        $obj = c($self);
        $source = c($source);
        if ($obj->dockClientCount < 2)
          if ($obj->h < 30){
            $obj->h = 170;
            $source->h = 170;
          }
          else
           
            ;
    }
    
    static function onUndock($self, $count = 1){
        
        $GLOBALS['_sc']->updateBtns();
        $obj = c($self);
        if ($obj->dockClientCount <= 1)
            $obj->h = 5;
    }
}


class ev_fmMain_c_formComponents {
    
    static function onChange($self){
        
        global $fmEdit;
        
        $index = c($self)->itemIndex;
        
        if ($index===0) $obj = $fmEdit;
        else {
            
            global $_FORMS, $formSelected;
            $forms = myProject::getFormsObjects();
            $obj = $fmEdit->findComponent($forms[$_FORMS[$formSelected]][$index-1]['NAME']);
        }
        
        myDesign::inspectElement($obj);
    }
}

class ev_fmMain_pDockMain {
    
    function doit(){
        global $_sc, $fmEdit;
        
        myDesign::formProps();
        form_parent($fmEdit, c('fmMain->pDockMain')->self);
        $_sc->clearTargets();
    }
    
    function onClick(){
        
        setTimeout(50,'ev_fmMain_pDockMain::doit()');
    }
}

class ev_fmMain_c_type {
    
    function onChange($self){
        
        c('fmMain->list')->smallIcons = c($self)->itemIndex == 1;
    }
}


class ev_fmMain_shapeSize {
    
    function typeCursor($self, $x, $y){
        
        $obj = toObject($self);
        $w   = $obj->w;
        $h   = $obj->h;
        $curType = crDefault;
        
        if ( $y>$h-20 ){
            $curType = crSizeNS;
        }
        
        if ( $x>$w-20 ){
            $curType = crSizeWE;
        }
        
        if ( $y>$h-20 && $x>$w-20){
            $curType = crSizeNWSE;
        }
        
        return $curType;    
    }
    
    function onMouseDown($self, $button, $shift, $x, $y){
        
        global $shapeSize, $_preX, $_preY, $curType;
        c('fmMain->pDockMain',1)->doubleBuffer = true;
        
        
        $obj = c($self);
        $_preX = $obj->w - $x;
        $_preY = $obj->h - $y;
        $shapeSize = true;
        
        $curType = self::typeCursor($self, $x, $y);
        $obj->cursor = $curType;
    }
    
    function onMouseMove($self, $shift, $x, $y){
        
        global $curType, $shapeSize, $_preY, $_preX, $fmEdit;
        
        $obj = _c($self);
        $w   = $obj->w;
        $h   = $obj->h;
        
        $fW   = $fmEdit->w;
        $fH   = $fmEdit->h;
        $minW = $fmEdit->constraints->minWidth;
        $minH = $fmEdit->constraints->minHeight;
        $maxW = $fmEdit->constraints->maxWidth;
        $maxH = $fmEdit->constraints->maxHeight;
        $aSize= $fmEdit->autoSize;
        $gridSize = myOptions::get('sc','gridSize',8);
        
        if ($shapeSize){
        
            if ($fW<0 || $fH<0) return;
                
            if ($aSize) return;
            
            $obj->cursor = $curType;
            global $fmEdit;
            
            $fmEdit->y = 10;
            $fmEdit->x = 10;
            
            $new_w = $x+1 + $_preX;
            $new_w = $new_w - $new_w% $gridSize;
            
            if ($curType==crSizeWE || $curType==crSizeNWSE){
                if ((($new_w-17 < $maxW) || $maxW==0) && (($new_w-17 > $minW) || $minW==0)){
                    c('fmMain->shapeSize',1)->w = $new_w < 1 ? 16 : $new_w+1;
                    $fmEdit->w = $new_w-16;
                }
                /*c('fmMain->shapeSize',1)->w = $new_w;
                $fmEdit->w = $new_w-17;*/
            }
            
            $new_h = $y+1 + $_preY;
            $new_h = $new_h - ($new_h% $gridSize );
            
            if ($curType==crSizeNS || $curType==crSizeNWSE){
                
                if ((($new_h-17 < $maxH) || $maxH==0) && (($new_h-17 > $minH) || $minH==0)){
                    c('fmMain->shapeSize',1)->h = $new_h < 1 ? 16 : $new_h+1;
                    $fmEdit->h = $new_h-16;
                }
               
            }
            
            global $propFormW, $propFormH;
            $propFormW->value = $fmEdit->w;
            $propFormH->value = $fmEdit->h;
        } else {
            
            $obj->cursor = self::typeCursor($obj, $x, $y);
        }
    }
    
    function onMouseUp($self, $shift, $x, $y){
        
        global $shapeSize;
        $shapeSize = false;
    }
}