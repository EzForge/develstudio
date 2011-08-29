<?


class myMasters {
    
    const UTIL_DIR = '/utils/';
    
    static function generate(){
        
        $utils = findDirs(SYSTEM_DIR . self::UTIL_DIR);
        
        foreach ($utils as $code)
            self::createMaster($code);
    }
    
    static function createMaster($code){
        
        if (!eregi('([a-z0-9\_]+)',$code)) return false;
        
        $dir = SYSTEM_DIR . self::UTIL_DIR . $code;
        
        /// פאיכ ÿחûךא
        Localization::inc($dir . '/lang');
        
        if (file_exists($dir . '/info.php')){
            $info = include $dir . '/info.php';
            
            $it = new TMenuItem(c('fmMain'));
            $it->caption = $info['CAPTION'];
            styleMenu::addItem($it);   
            
            if (file_exists($dir.'/icon.bmp'))
                $it->loadPicture($dir.'/icon.bmp');
            elseif (file_exists($dir.'/icon.png'))
                $it->loadPicture($dir.'/icon.png');
            elseif (file_exists($dir.'/icon.gif'))
                $it->loadPicture($dir.'/icon.gif');
            
            c('fmMain->it_Utils')->addItem($it);
            $it->onClick = 'master_'.$code.'::open("'.$info['MSP_PROJECT'].'"); _empty';
        }
        
        if (file_exists($dir.'/class.php')){
            include $dir .'/class.php';
        }
        
        if (file_exists($dir.'/class.phz'))
            bcompiler_load($dir.'/classs.phz');
        
        foreach ((array)$info['FORMS'] as $form){
            if (file_exists($dir.'/'.$form.'.dfm')){   
                $frm = TForm::loadFromFile(self::UTIL_DIR .$code.'/'. $form, true);
                $frm->name = 'mst_' . $code;
            }
        }
    }
    
}