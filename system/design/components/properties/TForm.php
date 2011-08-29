<?

$result = array();


$result[] = array('CAPTION'=>t('p_Left'), 'PROP'=>'x');
$result[] = array('CAPTION'=>t('p_Top'), 'PROP'=>'y');

$result[] = array(
                  'CAPTION'=>t('caption'),
                  'TYPE'=>'text',
                  'PROP'=>'caption',
                  );

$result[] = array(
                  'CAPTION'=>t('Hint'),
                  'TYPE'=>'text',
                  'PROP'=>'hint',
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
                  'CAPTION'=>t('Auto Scroll'),
                  'TYPE'=>'check',
                  'PROP'=>'autoScroll',
                  );
$result[] = array(
                  'CAPTION'=>t('Auto Size'),
                  'TYPE'=>'check',
                  'PROP'=>'autoSize',
                  );
$result[] = array(
                  'CAPTION'=>t('Alpha Blend'),
                  'TYPE'=>'check',
                  'PROP'=>'alphaBlend',
                  );
$result[] = array(
                  'CAPTION'=>t('Alpha Blend Value'),
                  'TYPE'=>'number',
                  'PROP'=>'alphaBlendValue',
                  );
$result[] = array(
                  'CAPTION'=>t('Border Style'),
                  'TYPE'=>'',
                  'PROP'=>'borderStyle',
                  'VALUES'=>array('bsNone', 'bsSingle', 'bsSizeable', 'bsDialog', 'bsToolWindow', 'bsSizeToolWin'),
                  'UPDATE'=>true,
                  );
$result[] = array(
                  'CAPTION'=>t('Border Width'),
                  'TYPE'=>'number',
                  'PROP'=>'borderWidth',
                  );
$result[] = array(
                  'CAPTION'=>t('Color'),
                  'TYPE'=>'color',
                  'PROP'=>'color',
                  );

$result[] = array(
                  'CAPTION'=>t('Icon'),
                  'TYPE'=>'',
                  'PROP'=>'icon',
                  );

$result[] = array(
                  'CAPTION'=>t('Cursor'),
                  'TYPE'=>'combo',
                  'PROP'=>'cursor',
                  'VALUES'=>$GLOBALS['cursors_meta'],
                  'ADD_GROUP'=>true,
                  );
$result[] = array(
                  'CAPTION'=>t('Enabled'),
                  'TYPE'=>'',
                  'PROP'=>'aenabled',
                  'REAL_PROP'=>'enabled',
                  'ADD_GROUP'=>true,
                  );
$result[] = array(
                  'CAPTION'=>t('Screen Snap'),
                  'TYPE'=>'check',
                  'PROP'=>'screenSnap',
                  'ADD_GROUP'=>true,
                  );
$result[] = array(
                  'CAPTION'=>t('Snap Buffer'),
                  'TYPE'=>'number',
                  'PROP'=>'snapBuffer',
                  'ADD_GROUP'=>true,
                  );
$result[] = array(
                  'CAPTION'=>t('Transparent Color'),
                  'TYPE'=>'check',
                  'PROP'=>'transparentColor',
                  'ADD_GROUP'=>true,
                  );
$result[] = array(
                  'CAPTION'=>t('Transparent Color Value'),
                  'TYPE'=>'color',
                  'PROP'=>'transparentColorValue',
                  'ADD_GROUP'=>true,
                  );


$result[] = array('CAPTION'=>t('Width'), 'PROP'=>'clientWidth','TYPE'=>'number','ADD_GROUP'=>true);
$result[] = array('CAPTION'=>t('Height'), 'PROP'=>'clientHeight','TYPE'=>'number','ADD_GROUP'=>true);

$result[] = array('CAPTION'=>t('Real Width'), 'PROP'=>'w','TYPE'=>'','ADD_GROUP'=>true);
$result[] = array('CAPTION'=>t('Real Height'), 'PROP'=>'h','TYPE'=>'','ADD_GROUP'=>true);

$result[] = array(
                  'CAPTION'=>t('Form Style'),
                  'TYPE'=>'',
                  'PROP'=>'formStyle',
                  );
$result[] = array(
                  'CAPTION'=>t('Position'),
                  'TYPE'=>'',
                  'PROP'=>'position',
                  );
$result[] = array(
                  'CAPTION'=>t('Window State'),
                  'TYPE'=>'',
                  'PROP'=>'windowState',
                  );
$result[] = array(
                  'CAPTION'=>t('Properties'),
                  'TYPE'=>'form',
                  'PROP'=>'fmFormProperties',
                  'ADD_GROUP'=>true,
                  );

$result[] = array(
                  'CAPTION'=>t('Modal result'),
                  'TYPE'=>'',
                  'PROP'=>'modalResult',
                  );
$result[] = array(
                  'CAPTION'=>t('Handle'),
                  'TYPE'=>'',
                  'PROP'=>'handle',
                  );

$result[] = array(
                  'CAPTION'=>t('Component List'),
                  'TYPE'=>'',
                  'PROP'=>'componentList',
                  );
$result[] = array(
                  'CAPTION'=>t('Component Count'),
                  'TYPE'=>'',
                  'PROP'=>'componentCount',
                  );
$result[] = array(
                  'CAPTION'=>t('Double Buffered'),
                  'TYPE'=>'',
                  'PROP'=>'doubleBuffered',
                  );

return $result;