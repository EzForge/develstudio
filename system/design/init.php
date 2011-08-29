<?
global $SCREEN, $fmEdit, $fmComponents, $fmMain, $fmObjInspect;

if (!EMULATE_DVS_EXE){  
    
$fmComponents->caption = t('components');

$aw = getSystemMetrics(SM_CXFULLSCREEN);
$ah = getSystemMetrics(SM_CYFULLSCREEN);

$cfg_array = array(
    'main' => array (
        'gridSize' => 8,
        'btnColor' => clBlack,
        'showGrid' => false,
        'lastVer'  => '',
    ),
    
    'fmMain' => array (
        'x' => 0,
        'y' => 0,
        'w' => 800,
        'h' => 800,
        'wS' => 'wsMaximized',
    ),
    
    'fmPHPEditor' => array ('x'=>false,'y'=>0,'w'=>0,'h'=>0,'panelH'=>0,'wS'=>0),
    
    'newProjectDialog' => array(
        'startup' => true,
    ),
);


$dsg_cfg = new TConfigIni($cfg_array);
$dsg_cfg->loadFromFile(winLocalPath(CSIDL_PERSONAL).'/DevelStudio/config.ini');
myVars::set($dsg_cfg, 'dsg_cfg');

    require 'design/dialogs.php';
}

require 'design/components.php';

if (!EMULATE_DVS_EXE){  
    
    require 'design/events.php';    

    c('fmLogoin->label5')->show();
    $GLOBALS['APPLICATION']->processMessages();    

    $_sc = new TSizeCtrl($fmEdit);
    $_sc->gridSize = $dsg_cfg->main->gridSize;

    $_sc->btnColor = $dsg_cfg->main->btnColor;
    $_sc->showGrid = (int)$dsg_cfg->main->showGrid;
    $_sc->enable   = true;
    $_sc->popupMenu= c('fmMain->editorPopup');
    $_sc->onStartSizeMove = 'myDesign::startSizeMove';
    $_sc->OnDuringSizeMove = 'myDesign::duringSizeMove';

    $myProperties = new myProperties;

    c('fmNewProject->startup')->checked = (int)$dsg_cfg->newProjectDialog->startup;

    $fmMain->left = $dsg_cfg->fmMain->x;
    $fmMain->top  = $dsg_cfg->fmMain->y;
    $fmMain->width= $dsg_cfg->fmMain->w;
    $fmMain->height=$dsg_cfg->fmMain->h;
    $fmMain->windowState = $dsg_cfg->fmMain->wS;

    if ($dsg_cfg->fmPHPEditor->x){
        
        c('fmPHPEditor',1)->position = poDesigned;
        c('fmPHPEditor',1)->x = $dsg_cfg->fmPHPEditor->x;
        c('fmPHPEditor',1)->y = $dsg_cfg->fmPHPEditor->y;
        c('fmPHPEditor',1)->w = $dsg_cfg->fmPHPEditor->w;
        c('fmPHPEditor',1)->h = $dsg_cfg->fmPHPEditor->h;
        c('fmPHPEditor',1)->windowState = $dsg_cfg->fmPHPEditor->wS;
    }
    
    $fmMain->caption = 'DevelStudio '. DV_YEAR;
    
    //$fmEdit->align = 'alCustom';
    $fmMain->popupMenu = c('fmMain->editorPopup');
    $fmEdit->popupMenu = c('fmMain->editorPopup');
    $_sc->popupMenu    = c('fmMain->editorPopup');
    global $inspectList;
    $inspectList->popupMenu    = c('fmMain->editorPopup');
    
    $GLOBALS['dsg_cfg'] =& $dsg_cfg;
    $GLOBALS['_sc']     =& $_sc;
    $GLOBALS['myProperties'] =& $myProperties;
    
    $GLOBALS['myEvents'] = new myEvents;
   
    c('fmPropsAndEvents->btn_addEvent')->onClick = 'myEvents::clickAddEvent';

    myComplete::init();
	setTimeout(5000, 'myBackup::updateSettings()');
}