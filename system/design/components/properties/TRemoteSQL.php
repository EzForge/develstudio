<?

$result = array();


$result[] = array(
                  'CAPTION'=>t('Url'),
                  'TYPE'=>'text',
                  'PROP'=>'url',
                  );

$result[] = array(
                  'CAPTION'=>t('API key'),
                  'TYPE'=>'text',
                  'PROP'=>'apiKey',
                  );

$result[] = array(
                  'CAPTION'=>t('Server'),
                  'TYPE'=>'text',
                  'PROP'=>'server',
                  );

$result[] = array(
                  'CAPTION'=>t('Database'),
                  'TYPE'=>'text',
                  'PROP'=>'database',
                  );

$result[] = array(
                  'CAPTION'=>t('Username'),
                  'TYPE'=>'text',
                  'PROP'=>'username',
                  );

$result[] = array(
                  'CAPTION'=>t('Password'),
                  'TYPE'=>'text',
                  'PROP'=>'password',
                  );

$result[] = array(
                  'CAPTION'=>t('Charset'),
                  'TYPE'=>'text',
                  'PROP'=>'charset',
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