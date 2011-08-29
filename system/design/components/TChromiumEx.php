<?

$result = array();

$result['GROUP']   = 'internet';
$result['CLASS']   = basenameNoExt(__FILE__);
$result['CAPTION'] = t('TChromium_Caption');
$result['SORT']    = 1999;
$result['NAME']    = 'chromium';
$result['W'] = 40;
$result['H'] = 30;
$result['USE_SKIN'] = true;

$result['DLLS'] = array('avcodec-53.dll', 'avformat-53.dll', 'avutil-51.dll', 'd3dcompiler_43.dll', 'd3dx9_43.dll', 'icudt.dll', 
					'libcef.dll', 'libEGL.dll', 'libGLESv2.dll');

return $result;