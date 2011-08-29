<?

$result = array();


$result[] = array(
                  'CAPTION'=>t('Device'),
                  'TYPE'=>'combo',
                  'PROP'=>'device',
                  'VALUES'=>array('fdScreen', 'fdPrinter', 'fdBoth'),
                  );
$result[] = array(
                  'CAPTION'=>t('Font'),
                  'TYPE'=>'',
                  'PROP'=>'font',
                  'CLASS'=>'TFont',
                  );
$result[] = array(
                  'CAPTION'=>t('Min Font size'),
                  'TYPE'=>'number',
                  'PROP'=>'minFontSize',
                  );
$result[] = array(
                  'CAPTION'=>t('Max Font size'),
                  'TYPE'=>'number',
                  'PROP'=>'maxFontSize',
                  );
return $result;