<?PHP

#	DB Config
include(dirname(__FILE__).'/config.php');
require_once(dirname(__FILE__).'/../libraries/Database.singleton.php');

$db = Database::obtain(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();
#	Browser Layout Project
include(dirname(__FILE__).'/../app/app.php');
	global $zip;
	require_once(dirname(__FILE__).'/../libraries/Mustache/src/Mustache/Autoloader.php');
	require_once(dirname(__FILE__).'/../extra/PHP/simple/PHPCodeGenerator.php');
	$filesZip = new PHPCodeGenerator();
	foreach($filesZip->files() as $file) {
		$zip->addFile($file["fileContent"], $file["fileName"]);
	}
$db->close();
$zip->sendZip("SenchaArchitectProjectGenerator-".$app->name.".zip");

#echo "<b>dir build</b>: ".dirname(__FILE__).'/build<br />';

?>