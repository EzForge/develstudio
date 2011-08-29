<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('stop'),
                  'PROP'=>'stop()',
                  'INLINE'=>'stop ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('stopDownload'),
                  'PROP'=>'stopDownload()',
                  'INLINE'=>'stopDownload ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('refresh'),
                  'PROP'=>'refresh()',
                  'INLINE'=>'refresh ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('toPrint'),
                  'PROP'=>'toPrint()',
                  'INLINE'=>'toPrint ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('toSaveAs'),
                  'PROP'=>'toSaveAs()',
                  'INLINE'=>'toSaveAs ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('printDialog'),
                  'PROP'=>'printDialog()',
                  'INLINE'=>'printDialog ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('showPrint'),
                  'PROP'=>'showPrint()',
                  'INLINE'=>'showPrint ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('post'),
                  'PROP'=>'post',
                  'INLINE'=>'post ( string url, array postData )',
                  );

$result[] = array(
                  'CAPTION'=>t('saveToFile'),
                  'PROP'=>'saveToFile',
                  'INLINE'=>'saveToFile ( string fileName )',
                  );

$result[] = array(
                  'CAPTION'=>t('navigate'),
                  'PROP'=>'navigate',
                  'INLINE'=>'navigate ( string url )',
                  );

$result[] = array(
                  'CAPTION'=>t('execWB'),
                  'PROP'=>'execWB',
                  'INLINE'=>'execWB ( int cmdID [, int cmdExe = OLECMDEXECOPT_PROMPTUSER] )',
                  );

$result[] = array(
                  'CAPTION'=>t('Show'),
                  'PROP'=>'show()',
                  'INLINE'=>'show ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('Hide'),
                  'PROP'=>'hide()',
                  'INLINE'=>'hide ( void )',
                  );


$result[] = array(
                  'CAPTION'=>t('To back'),
                  'PROP'=>'toBack()',
                  'INLINE'=>'toBack ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('To front'),
                  'PROP'=>'toFront()',
                  'INLINE'=>'toFront ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('Invalidate'),
                  'PROP'=>'invalidate()',
                  'INLINE'=>'invalidate ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('Repaint'),
                  'PROP'=>'repaint()',
                  'INLINE'=>'repaint ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('Perform'),
                  'PROP'=>'perform',
                  'INLINE'=>'perform ( string msg, int hparam, int lparam )',
                  );

$result[] = array(
                  'CAPTION'=>t('Create'),
                  'PROP'=>'create',
                  'INLINE'=>'create ( [object parent = activeForm] )',
                  );

$result[] = array(
                  'CAPTION'=>t('Free'),
                  'PROP'=>'free()',
                  'INLINE'=>'free ( void )',
                  );

return $result;