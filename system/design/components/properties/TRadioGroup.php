<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('Align'),
                  'TYPE'=>'combo',
                  'PROP'=>'align',
                  'VALUES'=>array('alNone', 'alTop', 'alBottom', 'alLeft', 'alRight', 'alClient', 'alCustom'),
                  );

$result[] = array(
                  'CAPTION'=>t('Items'),
                  'TYPE'=>'text',
                  'PROP'=>'text',
                  );
$result[] = array(
                  'CAPTION'=>t('Caption'),
                  'TYPE'=>'text',
                  'PROP'=>'caption',
                  );
$result[] = array(
                  'CAPTION'=>t('font'),
                  'TYPE'=>'font',
                  'PROP'=>'font',
                  );


$result[] = array('CAPTION'=>t('Font color'), 'PROP'=>'font->color');
$result[] = array('CAPTION'=>t('Font size'), 'PROP'=>'font->size');
$result[] = array('CAPTION'=>t('Font style'), 'PROP'=>'font->style');


$result[] = array(
                  'CAPTION'=>t('items'),
                  'TYPE'=>'',
                  'PROP'=>'items',
                  'CLASS'=>'TStrings',
                  );

$result[] = array('CAPTION'=>t('Items count'), 'PROP'=>'items->count');
$result[] = array('CAPTION'=>t('Items lines'), 'PROP'=>'items->lines');
$result[] = array('CAPTION'=>t('Items selected'), 'PROP'=>'items->selected');


$result[] = array(
                  'CAPTION'=>t('Item Index'),
                  'TYPE'=>'number',
                  'PROP'=>'itemIndex',
                  );
$result[] = array(
                  'CAPTION'=>t('Columns'),
                  'TYPE'=>'number',
                  'PROP'=>'columns',
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

$result[] = array('CAPTION'=>t('p_Left'), 'PROP'=>'x','TYPE'=>'number','ADD_GROUP'=>true);
$result[] = array('CAPTION'=>t('p_Top'), 'PROP'=>'y','TYPE'=>'number','ADD_GROUP'=>true);
$result[] = array('CAPTION'=>t('Width'), 'PROP'=>'w','TYPE'=>'number','ADD_GROUP'=>true);
$result[] = array('CAPTION'=>t('Height'), 'PROP'=>'h','TYPE'=>'number','ADD_GROUP'=>true);
return $result;