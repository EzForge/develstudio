<?

$result = array();


$result[] = array(
                  'CAPTION'=>t('From Language'),
                  'TYPE'=>'text',
                  'PROP'=>'inLang',
                  );

$result[] = array(
                  'CAPTION'=>t('To Language'),
                  'TYPE'=>'text',
                  'PROP'=>'outLang',
                  );

$result[] = array(
                  'CAPTION'=>t('Charset'),
                  'TYPE'=>'text',
                  'PROP'=>'toCharset',
                  );

$result[] = array(
                  'CAPTION'=>t('Proxy').' (ip:port)',
                  'TYPE'=>'text',
                  'PROP'=>'proxyAddr',
                  );

$result[] = array(
                  'CAPTION'=>t('Time out (sec)'),
                  'TYPE'=>'number',
                  'PROP'=>'timeOut',
                  );

$result[] = array(
                  'CAPTION'=>t('Theater Mode'),
                  'TYPE'=>'check',
                  'PROP'=>'thread',
                  );

$result[] = array(
                  'CAPTION'=>t('Priority'),
                  'TYPE'=>'combo',
                  'PROP'=>'priority',
                  'VALUES'=> array('tpIdle', 'tpLowest', 'tpLower', 'tpNormal', 'tpHigher', 'tpHighest',
                                    'tpTimeCritical'),
                  );
$result[] = array(
                  'CAPTION'=>t('Get value from object'),
                  'TYPE'=>'components',
                  'PROP'=>'getObject',
                  'ONE_FORM'=>0,
                  );
$result[] = array(
                  'CAPTION'=>t('Set value of object'),
                  'TYPE'=>'components',
                  'PROP'=>'setObject',
                  'ONE_FORM'=>0,
                  );

return $result;