<?PHP
include(dirname(__FILE__).'/../config.php');
include(dirname(__FILE__).'/app.php');
global $zip;
global $app;
$zip->sendZip("SenchaArchitectProjectGenerator-".$app->name.".zip");
?>