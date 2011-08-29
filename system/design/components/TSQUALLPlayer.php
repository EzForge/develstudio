<?

$result = array();

$result['GROUP']   = 'system';
$result['CLASS']   = basenameNoExt(__FILE__);
$result['CAPTION'] = t('TSQUALLPlayer_Caption');
$result['SORT']    = 740;
$result['NAME']    = 'sqPlayer';
$result['MODULES'] = array('php_squall.dll');

return $result;