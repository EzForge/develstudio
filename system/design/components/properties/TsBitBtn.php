<?

$result = array();


$result[] = array(
                  'CAPTION'=>t('caption'),
                  'TYPE'=>'text',
                  'PROP'=>'caption',
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
                  'CAPTION'=>t('Picture'),
                  'TYPE'=>'image',
                  'PROP'=>'picture',
                  'CLASS'=>'TBitmap',
                  );
$result[] = array(
                  'CAPTION'=>t('Layout picture'),
                  'TYPE'=>'combo',
                  'PROP'=>'layout',
                  'VALUES'=>array('blGlyphLeft', 'blGlyphRight', 'blGlyphTop', 'blGlyphBottom'),
                  );
$result[] = array(
                  'CAPTION'=>t('modal_result'),
                  'TYPE'=>'combo',
                  'PROP'=>'modalResult',
                  'VALUES'=>array(
                                  mrNone=>'mrNone',
                                  mrOk=>'mrOk',
                                  mrCancel=>'mrCancel',
                                  mrAbort=>'mrAbort',
                                  mrRetry=>'mrRetry',
                                  mrIgnore=>'mrIgnore',
                                  mrYes=>'mrYes',
                                  mrNo=>'mrNo',
                                  mrAll=>'mrAll',
                                  mrNoToAll=>'mrNoToAll',
                                  mrYesToAll=>'mrYesToAll'
                                  ),
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