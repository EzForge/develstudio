<?

$result = array();


$result[] = array(
                  'CAPTION'=>t('Text'),
                  'TYPE'=>'text',
                  'PROP'=>'text',
                  );
$result[] = array(
                  'CAPTION'=>t('font'),
                  'TYPE'=>'font',
                  'PROP'=>'font',
                  'CLASS'=>'TFont',
                  );

$result[] = array('CAPTION'=>t('Font color'), 'PROP'=>'font->color');
$result[] = array('CAPTION'=>t('Font size'), 'PROP'=>'font->size');
$result[] = array('CAPTION'=>t('Font style'), 'PROP'=>'font->style');

$result[] = array(
                  'CAPTION'=>t('Color'),
                  'TYPE'=>'color',
                  'PROP'=>'color',
                  );
$result[] = array(
                  'CAPTION'=>t('Char Case'),
                  'TYPE'=>'combo',
                  'PROP'=>'charCase',
                  'VALUES'=>array('ecNormal', 'ecUpperCase', 'ecLowerCase'),
                  );
$result[] = array(
                  'CAPTION'=>t('Ctl3D'),
                  'TYPE'=>'check',
                  'PROP'=>'ctl3D',
                  );
$result[] = array(
                  'CAPTION'=>t('Auto Size'),
                  'TYPE'=>'check',
                  'PROP'=>'autoSize',
                  );
$result[] = array(
                  'CAPTION'=>t('Read Only'),
                  'TYPE'=>'check',
                  'PROP'=>'readOnly',
                  );

$result[] = array(
                  'CAPTION'=>t('Max Length'),
                  'TYPE'=>'number',
                  'PROP'=>'maxLength',
                  );
$result[] = array(
                  'CAPTION'=>t('Password Char'),
                  'TYPE'=>'text',
                  'PROP'=>'passwordChar',
                  );

$result[] = array(
                  'CAPTION'=>t('Hint'),
                  'TYPE'=>'text',
                  'PROP'=>'hint',
                  );

$result[] = array('CAPTION'=>t('selStart'), 'PROP'=>'selStart');
$result[] = array('CAPTION'=>t('selLength'), 'PROP'=>'selLength');
$result[] = array('CAPTION'=>t('selText'), 'PROP'=>'selText');

$result[] = array(
                  'CAPTION'=>t('Cursor'),
                  'TYPE'=>'combo',
                  'PROP'=>'cursor',
                  'VALUES'=>$GLOBALS['cursors_meta'],
                  'ADD_GROUP'=>true,
                  );

$result[] = array(
                  'CAPTION'=>t('Sizes and position'),
                  'TYPE'=>'sizes',
                  'PROP'=>'',
                  'ADD_GROUP'=>true,
                  );

$result[] = array(
                  'CAPTION'=>t('Enabled'),
                  'TYPE'=>'check',
                  'PROP'=>'aenabled',
                  'REAL_PROP'=>'enabled',
                  'ADD_GROUP'=>true,
                  );

$result[] = array(
                  'CAPTION'=>t('visible'),
                  'TYPE'=>'check',
                  'PROP'=>'avisible',
                  'REAL_PROP'=>'visible',
                  'ADD_GROUP'=>true,
                  );

$result[] = array('CAPTION'=>t('p_Left'), 'PROP'=>'x','TYPE'=>'number','ADD_GROUP'=>1,'UPDATE_DSGN'=>1);
$result[] = array('CAPTION'=>t('p_Top'), 'PROP'=>'y','TYPE'=>'number','ADD_GROUP'=>1,'UPDATE_DSGN'=>1);
$result[] = array('CAPTION'=>t('Width'), 'PROP'=>'w','TYPE'=>'number','ADD_GROUP'=>1,'UPDATE_DSGN'=>1);
$result[] = array('CAPTION'=>t('Height'), 'PROP'=>'h','TYPE'=>'number','ADD_GROUP'=>1,'UPDATE_DSGN'=>1);
return $result;