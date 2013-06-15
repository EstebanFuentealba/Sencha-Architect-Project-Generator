<?PHP

#	DB Config
include(dirname(__FILE__).'/config.php');
#	Browser Layout Project
include(dirname(__FILE__).'/../app/app.php'); 
global $zip;
require_once(dirname(__FILE__).'/../libraries/Mustache/src/Mustache/Autoloader.php');
require_once(dirname(__FILE__).'/../extra/PHP/simple/PHPCodeGenerator.php');

$filesZip = new PHPCodeGenerator();
foreach($filesZip->files() as $file) {
	$zip->addFile($file["fileContent"], $file["fileName"]);
}
$zip->sendZip("SenchaArchitectProjectGenerator-".$app->name.".zip");

#echo "<b>dir build</b>: ".dirname(__FILE__).'/build<br />';

?>