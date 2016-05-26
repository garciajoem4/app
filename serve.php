<?php
ini_set('memory_limit', '128M');
session_start();

$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$start = $time;

require_once("scssphp/scss.inc.php");

register_shutdown_function( "fatal_handler" );

function fatal_handler() {
  $error = error_get_last();
  if($error == NULL) {
    $error["type"] = 'UNKNOWN';
    $error["file"] = '/serve.php';
    $error["line"] = 0;
    $error["message"] = E_CORE_ERROR;
  }
  $result['error'] = $error;
  echo json_encode($result);
  exit();
}

use Leafo\ScssPhp\Compiler;
use Leafo\ScssPhp\Server;

$scss = new Compiler();

if(isset($_GET['sass']) && $_GET['sass'] == 'new') {
	$scss->setFormatter('Leafo\ScssPhp\Formatter\Expanded');
	$scss->setLineNumberStyle(Compiler::LINE_COMMENTS);
} else {
	$scss->setFormatter('Leafo\ScssPhp\Formatter\Compressed');
}

$scssimports[] = '"themes/theme_variables.scss"';
$scssimports[] = '"assets/stylesheets/_bootstrap.scss"';
$scssimports[] = '"css/scss/mixins.scss"';
$scssimports[] = '"css/scss/scaffolding.scss"';
$scssimports[] = '"themes/theme.scss"';

// $files = preg_grep('~\.(scss|css)$~', scandir('scss'));
// if(is_array($files)) {
// 	foreach($files as $file) {
// 		$filepath = '"assets/stylesheets/'.$file.'"';
// 		if(!in_array($filepath,$scssimports)) {
// 			$scssimports[] = $filepath;
// 		}
// 	}
// }

$result['css'] = $scss->compile('@import '.implode(', ',$scssimports).';');

$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$finish = $time;
$total_time = round(($finish - $start), 4);

$filelist = '/*
MEMORY USAGE: '.round(memory_get_peak_usage(TRUE)/1024/1024,2).'Mb
GENERATION TIME: '.$total_time.'s
GENERATED: '.date("d/m H:i:s").''.print_r($scssimports,true).'*/';

echo $result['css'].$filelist;

$content = $result['css'];
$fp = fopen($_SERVER['DOCUMENT_ROOT'] . '/app/css/style.css','w');
fwrite($fp,$content);
fclose($fp);

exit();

?>
