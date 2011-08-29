<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('Visual Component'),
                  'TYPE'=>'',
                  'PROP'=>'control',
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
                  'CAPTION'=>t('Pen'),
                  'TYPE'=>'pen',
                  'PROP'=>'pen',
                  'CLASS'=>'TPen',
                  );

$result[] = array('CAPTION'=>t('Pen color'), 'PROP'=>'pen->color');
$result[] = array('CAPTION'=>t('Pen mode'), 'PROP'=>'pen->mode');
$result[] = array('CAPTION'=>t('Pen style'), 'PROP'=>'pen->style');
$result[] = array('CAPTION'=>t('Pen width'), 'PROP'=>'pen->width');


$result[] = array(
                  'CAPTION'=>t('Brush'),
                  'TYPE'=>'brush',
                  'PROP'=>'brush',
                  'CLASS'=>'TBrush',
                  );

$result[] = array('CAPTION'=>t('Brush color'), 'PROP'=>'brush->color');
$result[] = array('CAPTION'=>t('Brush style'), 'PROP'=>'brush->style');

return $result;