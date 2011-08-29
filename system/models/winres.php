<?


class winRes {
    
    
    static function changeIcon($fileExe, $fileIco){
        
        $fileExe = replaceSr($fileExe);
        $fileIco = replaceSr($fileIco);
        
        //winres_change_ico($fileExe, $fileIco);
        $hExe = winres_begin_update_resource($fileExe, false); // начинаю обновление иконки
        
        winres_load_icon_group_resource($hExe, 'MAINICON', 0, $fileIco); // Устанавливаю иконку
        winres_end_update_resource($hExe, false); // Обновление закончено
    }
    
    static function changeInfo($fileExe, $name, $value){
        
        winres_change_file_info((string)$fileExe, (string)$name, (string)$value);
    }
    
    static function changeCompanyName($fileExe, $companyName){
        
        self::changeInfo($fileExe, 'CompanyName', $companyName);
    }
    
    static function changeVersion($fileExe, $version){
        
        self::changeInfo($fileExe, 'ProductVersion', $version);
    }
    
    static function changeFileVersion($fileExe, $fileVersion){
        
        self::changeInfo($fileExe, 'FileVersion', $fileVersion);
    }
    
    static function changeFileDescription($fileExe, $desc){
        
        self::changeInfo($fileExe, 'FileDescription', $desc);
    }
    
    static function changeLegalCopyright($fileExe, $value){
        
        self::changeInfo($fileExe, 'LegalCopyright', $value);
    }
}