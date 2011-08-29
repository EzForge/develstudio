<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('On HotSpot Click'),
                  'EVENT'=>'onhotspotclick',
                  'INFO'=>'%func%($self, $url, $continue)',
                  'ICON'=>'onhotspotclick',
                  );
$result[] = array(
                  'CAPTION'=>t('On HotSpot Covered'),
                  'EVENT'=>'onhotspotcovered',
                  'INFO'=>'%func%($self, $url)',
                  'ICON'=>'onhotspotcovered',
                  );
$result[] = array(
                  'CAPTION'=>t('On Form Submit'),
                  'EVENT'=>'onformsubmit',
                  'INFO'=>'%func%($self, $action, $target, $enctype, $method, $results)',
                  'ICON'=>'onformsubmit',
                  );

return $result;