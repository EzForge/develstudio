<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('Path to Skin file (.asz)'),
                  'TYPE'=>'text',
                  'PROP'=>'skinFile',
                  );

$result[] = array(
                  'CAPTION'=>t('Skin directory'),
                  'TYPE'=>'',
                  'PROP'=>'skinDirectory',
                  );

$result[] = array(
                  'CAPTION'=>t('Skin name'),
                  'TYPE'=>'',
                  'PROP'=>'skinName',
                  );

$result[] = array(
                  'CAPTION'=>t('Skin All'),
                  'TYPE'=>'check',
                  'PROP'=>'skinAll',
                  );

$result[] = array(
                  'CAPTION'=>t('Active'),
                  'TYPE'=>'check',
                  'PROP'=>'active',
                  );



return $result;