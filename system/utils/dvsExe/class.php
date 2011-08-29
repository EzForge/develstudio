<?


class master_dvsExe {
    
    static function open($msp_project){
        
        $dlg = new TOpenDialog;
        $dlg->filter = 'DVS Projects|*.dvs;*.dvsexe';
        if ($dlg->execute()){
            
            evalProject::openAsExe( $dlg->fileName );    
        }
        
        $dlg->free();
        //$project = evalProject::open(dirname(__FILE__).'/'.$msp_project);
        //$project->showModal();
    }
}