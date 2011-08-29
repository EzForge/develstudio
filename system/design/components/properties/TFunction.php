<?

$result = array();
/*
$result[] = array(
                  'CAPTION'=>t('Name'),
                  'TYPE'=>'text',
                  'PROP'=>'name',
                  );
*/
$result[] = array(
                  'CAPTION'=>t('Parameters'),
                  'TYPE'=>'text',
                  'PROP'=>'parameters',
                  );
$result[] = array(
                  'CAPTION'=>t('Description'),
                  'TYPE'=>'text',
                  'PROP'=>'description',
                  );
$result[] = array(
                  'CAPTION'=>t('Register as PHP Func'),
                  'TYPE'=>'check',
                  'PROP'=>'toRegister',
                  );

$result[] = array(
                  'CAPTION'=>t('Call on start'),
                  'TYPE'=>'check',
                  'PROP'=>'callOnStart',
                  );

$result[] = array(
                  'CAPTION'=>t('Work in background'),
                  'TYPE'=>'check',
                  'PROP'=>'workBackground',
                  );

$result[] = array(
                  'CAPTION'=>t('Priority'),
                  'TYPE'=>'combo',
                  'PROP'=>'priority',
                  'VALUES'=> array('tpIdle', 'tpLowest', 'tpLower', 'tpNormal', 'tpHigher', 'tpHighest',
                                    'tpTimeCritical'),
                  );

return $result;