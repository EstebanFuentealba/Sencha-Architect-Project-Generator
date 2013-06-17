<?PHP
include(dirname(__FILE__).'/../config.php');
require_once(dirname(__FILE__).'/../libraries/Database.singleton.php');

$db = Database::obtain(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();
include(dirname(__FILE__).'/app.php');
global $zip;
global $app;
$db->close();
$zip->sendZip("SenchaArchitectProjectGenerator-".$app->name.".zip");
?>