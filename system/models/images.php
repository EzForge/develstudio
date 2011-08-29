<?

class myImages {
    
    
    static function getImgID($name){
        global $allImages;
        
        return $allImages[$name]['ID'] ? $allImages[$name]['ID'] : -1;
    }
    
    static function get32($name){
        
        if (file_exists(SYSTEM_DIR . '/images/32/'.$name.'.png'))
            return SYSTEM_DIR . '/images/32/'.$name.'.png';
        if (file_exists(SYSTEM_DIR . '/images/32/'.$name.'.bmp'))
            return SYSTEM_DIR . '/images/32/'.$name.'.bmp';
        if (file_exists(SYSTEM_DIR . '/images/32/'.$name.'.gif'))
            return SYSTEM_DIR . '/images/32/'.$name.'.gif';
        
        else
            return false;
    }
    
    static function get24($name){
        
        
        if (file_exists(SYSTEM_DIR . '/images/24/'.$name.'.png'))
            return SYSTEM_DIR . '/images/24/'.$name.'.png';
        if (file_exists(SYSTEM_DIR . '/images/24/'.$name.'.bmp'))
            return SYSTEM_DIR . '/images/24/'.$name.'.bmp';
        if (file_exists(SYSTEM_DIR . '/images/24/'.$name.'.gif')){
            return SYSTEM_DIR . '/images/24/'.$name.'.gif';
        }
        
            return false;
    }
    
    static function get16($name){
        
        if (file_exists(SYSTEM_DIR . '/images/16/'.$name.'.png'))
            return SYSTEM_DIR . '/images/16/'.$name.'.png';
        if (file_exists(SYSTEM_DIR . '/images/16/'.$name.'.bmp'))
            return SYSTEM_DIR . '/images/16/'.$name.'.bmp';
        if (file_exists(SYSTEM_DIR . '/images/16/'.$name.'.gif'))
            return SYSTEM_DIR . '/images/16/'.$name.'.gif';
        
        else
            return false;
    }
}