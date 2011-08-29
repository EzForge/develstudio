<?
// инициализация всех компонентов, которые можно добавлять на форму


$_components = array();
$componentProps   = array();
$componentEvents  = array();
$files = findFiles(dirname(__FILE__) . '/components/','php');
$dir_n  = dirname(__FILE__);

foreach ($files as $file){
    
    $base_n = basenameNoExt($file);
    if (!EMULATE_DVS_EXE){
        Localization::incXml('/design/components/lang/'.$base_n.'/');    
        $_components[] = include($dir_n . '/components/' . $file);
    }
    
    $file_m = $dir_n.'/components/modules/'.$base_n;
    
    if (file_exists($file_m.'.php')){    
        loader::inc($file_m.'.php');
    }
    
    if (file_exists($file_m.'.phpe')){
        loader::inc($file_m.'.phpe');
    }
    
    if (file_exists($file_m.'.phpe2')){
        loader::inc($file_m.'.phpe2');
    }
}

if (EMULATE_DVS_EXE) return;
    
    $files = findFiles($dir_n . '/components/properties/','php');
    foreach ($files as $file){
        $componentProps[basenameNoExt($file)] = include($dir_n . '/components/properties/' . $file);
    }
    
    $files = findFiles($dir_n . '/components/events/','php');
    foreach ($files as $file){
        $componentEvents[basenameNoExt($file)] = include($dir_n . '/components/events/' . $file);
    }
    
    $files = findFiles($dir_n . '/components/methods/','php');
    foreach ($files as $file){
        $componentMethods[basenameNoExt($file)] = include($dir_n . '/components/methods/' . $file);
    }

    $files = findFiles($dir_n . '/components/modifers/','php');
    foreach ($files as $file){
        include($dir_n . '/components/modifers/' . $file);
    }

    BlockData::sortList($_components, 'SORT');
    
    
    $files = findFiles($dir_n . '/editor_types/','php');
    foreach ($files as $file)
        require $dir_n . '/editor_types/' . $file;
    
    ////// создаем панель компонентов /////////
    global $fmComponents;
    /*$cp = new TComponentPanel($fmComponents);
    
    $cp->parent = c('fmComponents');*/
    //$cp->hide();
    //$cp->name = 'list';
    //$cp->text = '';
    //$cp->align  = 'alClient';
    $cp = c('fmComponents->list');
    
        $_winControls = array();
        $componentClasses = array();
        $groups = array();
        foreach ($_components as $c){
            
            foreach ((array)$c['MODULES'] as $mod){
                
                if ( ! extension_loaded(str_ireplace('php_','',basenameNoExt($mod))) ){
                    dl($mod);
                }
            }
            
            if ($c['USE_SKIN'])
                myModules::$skinClasses[] = $c['CLASS'];
            
            if (!in_array($c['GROUP'], $groups)){
                $cp->addSection($c['GROUP'],t('gr_'.$c['GROUP']));
                $groups[] = $c['GROUP'];
            }
    
            $btn = $cp->addButton($c['GROUP']);
           // $btn->onClick = 'myDesign::selectClass(0, _c('.$btn->self.')); _empty';
            
            $componentClasses[$btn->self] = $c;
           
            $btn->caption    = $c['CAPTION'];
            $btn->hint       = $c['CAPTION'] .' - '.$c['CLASS'];
            $btn->imageIndex = myImages::getImgID($c['CLASS']);
            if ($btn->imageIndex == -1)
                $btn->imageIndex = myImages::getImgID('component');
                
            if (isset($c['WINCONTROL']) && $c['WINCONTROL'])
                $_winControls[] = $c['CLASS'];
            //$btn->picture->loadFromFile(myImages::get24($c['CLASS']));
        }
        
        $cp->onButtonClicked = 'myDesign::selectClass';
        // $cp->show();    
    
    
        unset($groups);
        myVars::set2($componentClasses, 'componentClasses');
        myVars::set2($cp,'_componentPanel');
        myVars::set2($componentProps,'componentProps');
        myVars::set2($componentEvents,'componentEvents');
        myVars::set2($componentMethods,'componentMethods');
        
        $_winControls[] = 'TTabSheet';
        myVars::set2($_winControls,'_winControls');