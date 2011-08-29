<?

include_once dirname(__FILE__).'/pclzip.lib.php';

class master_Pakages {
    
    static function init(){
        
        evalProject::open(dirname(__FILE__).'/pakageMaster.dvs');
    }
    
    static function installPak($file){
        
        self::init();
        
        $ext = fileExt($file);
            
            if ($ext=='zipdspak'){
                
                $rand = rand();
                $zip = new PclZip($file);
                $zip->extract(PCLZIP_OPT_PATH, TEMP_DIR.'/devels/dspaks/'.$rand.'/');
                
                $file = TEMP_DIR.'/devels/dspaks/'.$rand.'/'.basenameNoExt($file).'.dspak';
            }
        
        showInstallPak($file);
    }
    
    static function install($self){
        
        self::init();
        $dlg = new TOpenDialog;
        $dlg->filter = 'All DS Packages|*.dspak;*.zipdspak|DS Packages (*.dspak)|*.dspak|ZIP DS Packages (*.zipdspak)|*.zipdspak';
        
        if ($dlg->execute()){
            
            self::installPak($dlg->fileName);
        }
        
        $dlg->free();
    }
    
    static function alist($self){
        
        self::init();
        showPakagesList();
    }
}


$item = menuItem(t('Pakages'), true,'itPakages');
// добавляем пункт меню
c('fmMain->MainMenu')->items->insertAfter( c('fmMain->itProject'),
            $item
            );

$itInstall = menuItem(t('Install Pakage'), true, 'itInstallPakage',
                        'master_Pakages::install',false, dirname(__FILE__).'/img/install.bmp' );

$item->addItem($itInstall);
$item->addItem(menuItem('-',true));

$itPakages = menuItem(t('Pakages List'), true, 'itPakagesList', 'master_Pakages::alist');
$item->addItem($itPakages);