<?

$result = array();


$result[] = array(
                  'CAPTION'=>t('Align'),
                  'TYPE'=>'combo',
                  'PROP'=>'align',
                  'VALUES'=>array('alNone', 'alTop', 'alBottom', 'alLeft', 'alRight', 'alClient', 'alCustom'),
                  );
$result[] = array(
                  'CAPTION'=>t('Location URL'),
                  'TYPE'=>'text',
                  'PROP'=>'url',
                  );
$result[] = array(
                  'CAPTION'=>t('Silent'),
                  'TYPE'=>'check',
                  'PROP'=>'silent',
                  );
$result[] = array(
                  'CAPTION'=>t('Theater Mode'),
                  'TYPE'=>'check',
                  'PROP'=>'TheaterMode',
                  );
$result[] = array(
                  'CAPTION'=>t('Proxy').' (ip:port)',
                  'TYPE'=>'text',
                  'PROP'=>'proxy',
                  );
$result[] = array(
                  'CAPTION'=>t('Busy'),
                  'TYPE'=>'',
                  'PROP'=>'busy',
                  );

$result[] = array(
                  'CAPTION'=>t('HTML Code'),
                  'TYPE'=>'',
                  'PROP'=>'html',
                  );

$result[] = array(
                  'CAPTION'=>t('Sizes and position'),
                  'TYPE'=>'sizes',
                  'PROP'=>'',
                  'ADD_GROUP'=>true,
                  );

$result[] = array('CAPTION'=>t('p_Left'), 'PROP'=>'x','TYPE'=>'number','ADD_GROUP'=>1,'UPDATE_DSGN'=>1);
$result[] = array('CAPTION'=>t('p_Top'), 'PROP'=>'y','TYPE'=>'number','ADD_GROUP'=>1,'UPDATE_DSGN'=>1);
$result[] = array('CAPTION'=>t('Width'), 'PROP'=>'w','TYPE'=>'number','ADD_GROUP'=>1,'UPDATE_DSGN'=>1);
$result[] = array('CAPTION'=>t('Height'), 'PROP'=>'h','TYPE'=>'number','ADD_GROUP'=>1,'UPDATE_DSGN'=>1);

return $result;