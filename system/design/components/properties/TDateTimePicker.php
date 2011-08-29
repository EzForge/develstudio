<?

$result = array();


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
                  'CAPTION'=>t('Date'),
                  'TYPE'=>'text',
                  'PROP'=>'date',
                  );


$result[] = array(
                  'CAPTION'=>t('Date Format'),
                  'TYPE'=>'combo',
                  'PROP'=>'dateFormat',
                  'VALUES'=>array('dfShort','dfLong'),
                  );
$result[] = array(
                  'CAPTION'=>t('Date Mode'),
                  'TYPE'=>'combo',
                  'PROP'=>'dateMode',
                  'VALUES'=>array('dmComboBox','dmUpDown'),
                  );

$result[] = array(
                  'CAPTION'=>t('Format'),
                  'TYPE'=>'text',
                  'PROP'=>'format',
                  );
$result[] = array(
                  'CAPTION'=>t('Kind'),
                  'TYPE'=>'combo',
                  'PROP'=>'kind',
                  'VALUES'=>array('dtkDate','dtkTime'),
                  );
$result[] = array(
                  'CAPTION'=>t('Max Date'),
                  'TYPE'=>'text',
                  'PROP'=>'maxDate',
                  );
$result[] = array(
                  'CAPTION'=>t('Min Date'),
                  'TYPE'=>'text',
                  'PROP'=>'minDate',
                  );
$result[] = array(
                  'CAPTION'=>t('Show Checkbox'),
                  'TYPE'=>'check',
                  'PROP'=>'showCheckbox',
                  );
$result[] = array(
                  'CAPTION'=>t('Time'),
                  'TYPE'=>'text',
                  'PROP'=>'time',
                  );

$result[] = array(
                  'CAPTION'=>t('Hint'),
                  'TYPE'=>'text',
                  'PROP'=>'hint',
                  );

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