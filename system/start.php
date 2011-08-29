<?

    err_status(false); // отключаем вывод ошибок


    // расширение для работы с ресурсами...
    if (!EMULATE_DVS_EXE){
        
        if (!extension_loaded('phpwinres'))
        if (!dl('php_winres.dll')){
            msg('php_winres.dll - error load');   
        }
        
        /*if (!extension_loaded('phpdmsdialogs'))
        if (!dl('php_dmsdialogs.dll')){
              msg('php_dmsdialogs.dll - error load');
        }*/
         
        if (!extension_loaded('osinfo'))
        if (!dl('php_osinfo.dll'))
           msg('php_osinfo.dll - error load');
            
        if (!extension_loaded('mcrypt'))
        if (!dl('php_mcrypt.dll'))
           msg('php_mcrypt.dll - error load');
           
        if (!extension_loaded('bcompiler'))
        if (!dl('php_bcompiler.dll'))
           msg('php_bcompiler.dll - error load');
        
        if (!extension_loaded('bz2'))
        if (!dl('php_bz2.dll'))
           msg('php_bz2.dll - error load');
    }
        

    define('DS_USERDIR',winLocalPath(CSIDL_PERSONAL).'/DevelStudio/' );
    $ini = new TIniFileEx(DS_USERDIR.'allconfig.ini');
    $GLOBALS['ALL_CONFIG'] = $ini->arr;
    
    
    require 'libs/mvc.php';
    
    define_ex('DV_YEAR', 2011);
    define_ex('DV_VERSION', '2.0.0.8');
    define_ex('DV_PREFIX','plus');
    
    if (!EMULATE_DVS_EXE){
        loader::lib('data');
        loader::model('options');
        $def = substr(strtolower(osinfo_syslang()), 0, 2);
        
        $lang = myOptions::get('main','lang',$def);
        $lang_charset = myOptions::get('main','lang_charset', 'DEFAULT_CHARSET');
        
        define_ex('LANG_CHARSET', constant($lang_charset));
        define_ex('LANG_ID', $lang);
        Localization::setLocale($lang);
        Thread::addCode("Localization::setLocale('$lang');");
    }
    
    if (!EMULATE_DVS_EXE) loader::model('compile');
    
    loader::model('prover');
    loader::modules('modules');
    loader::lib('syntax');
    loader::lib('zip');
    loader::lib('vseditor');
    loader::lib('synedit');
    loader::lib('docking');
    loader::lib('catbuttons');
    loader::lib('bcompiler');
    
    
    if (!EMULATE_DVS_EXE){
        
        loader::model('codegen');
        loader::model('syntaxCheck');
        loader::model('design');
        loader::model('copyer');
        loader::model('properties');
        loader::model('images');
   
        loader::model('events');
        loader::model('utils');
    
        loader::model('inspector');
        loader::model('project');
        //loader::model('options');
        loader::model('modules');
        loader::model('novisual');
        loader::model('winres');
        loader::model('upx');
        loader::model('history');
        loader::model('debug');
        loader::model('masters');
        loader::model('complete');
    }
    
    loader::model('evalproject');
    
    if (!EMULATE_DVS_EXE){
        loader::model('dialogs_ex');
        loader::model('propcomponents_ex');
        loader::model('dsapi');
    }
	
	