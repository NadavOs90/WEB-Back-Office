<?php
header('Content-Type: text/css');
header('Content-Disposition: inline; filename="style.css"');

header("Cache-Control: no-cache, must-revalidate"); 
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 

#
session_start();

$css = array();
$css['body']['color'] = '000033';
$css['body']['bgcolor'] = 'CCCCCC';
$css['h1']['color'] = '003399';
$css['a']['color'] = '990000';
if(isset( $_SESSION['statFlag']) && $_SESSION['statFlag'] ==0){
$css['form']['width'] = '50%';
$css['form']['color'] = 'black';
$css['body']['bgcolor'] = 'white';

}
else{
    
$css['form']['width'] = '80%';
$css['form']['color'] = 'blue';
$css['body']['bgcolor'] = '#8babe0';
    
}


# Validates and maintains a copy of default css file that works.
# If dynamic css file is verified, use it.
$css_file = isset($_GET['css'])?(string)$_GET['css'].'.css':'default.css';
$css_file = (file_exists($css_file))?$css_file:'default.css';

/**
* CSS is highly sensistive on wrong attributes.
* So, to make sure that it does not product errors, I am showing you a way out only to supress the errors.
* But still, you must have the correct parameters, and existing values in $css array.
*/
function write($identifier='', $index='')
{
	global $css;
	return(!empty($css[$identifier][$index])?$css[$identifier][$index]:'');
}

# Now begin writing your dynamic css using your variables.
# Below code is a true css content.
require_once($css_file);
?>