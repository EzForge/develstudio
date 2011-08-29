<?

class TDockTabSet extends TControl {
    public $class_name = __CLASS__;
}



class Docking {
    
    static function saveFile($panel, $file){
        
        $panel->dockSaveToFile($file);
    }
    
    static function loadFile($panel, $file){
        
        $panel->dockLoadFromFile($file);
    }
}