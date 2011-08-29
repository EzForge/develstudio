<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('Caption Alignment'),
                  'TYPE'=>'combo',
                  'PROP'=>'captionAlignment',
                  'VALUES'=>array('taLeftJustify', 'taRightJustify', 'taCenter'),
                  );

$result[] = array(
                  'CAPTION'=>t('Resize Mode'),
                  'TYPE'=>'combo',
                  'PROP'=>'resizeMode',
                  'VALUES'=>array('rmStandart', 'rmBorder'),
                  );

$result[] = array(
                  'CAPTION'=>t('Show App Icon'),
                  'TYPE'=>'check',
                  'PROP'=>'showAppicon',
                  );

$result[] = array(
                  'CAPTION'=>t('Use global color'),
                  'TYPE'=>'check',
                  'PROP'=>'useGlobalColor',
                  );


return $result;