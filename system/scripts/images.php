<?

global $_IMAGES16, $_IMAGES24, $_IMAGES32, $allImages;

$allImages = array();
$is_exists = array();
$c         = 0;
$files = findFiles(SYSTEM_DIR . '/images/24/',array('bmp','png','gif'));
foreach ($files as $i=>$file){
    
    if ( in_array(basenameNoExt($file), $is_exists) ){
        $c++;
        continue;
    }
    
    $_IMAGES24->addFromFile(SYSTEM_DIR . '/images/24/' . $file);
    
    if (file_exists(SYSTEM_ROOT . '/images/32/' . $file))
        $_IMAGES32->addFromFile(SYSTEM_DIR . '/images/32/' . $file);
    else
        $_IMAGES32->addFromFile(SYSTEM_DIR . '/images/32/empty.bmp');
        
    if (file_exists(SYSTEM_ROOT . '/images/16/' . $file))
        $_IMAGES16->addFromFile(SYSTEM_DIR . '/images/16/' . $file);
    else
        $_IMAGES16->addFromFile(SYSTEM_DIR . '/images/16/empty.bmp');
        
    
    $is_exists[] = basenameNoExt($file);
    $allImages[basenameNoExt($file)] = array('ID' => $i-$c, 'FILE'=>$file);
}