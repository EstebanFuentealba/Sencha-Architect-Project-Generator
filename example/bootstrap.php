<?PHP

#	DB Config
include(dirname(__FILE__).'/config.php');
#	Browser Layout Project
include(dirname(__FILE__).'/../app/app.php'); 

require_once(dirname(__FILE__).'/../libraries/Mustache/src/Mustache/Autoloader.php');
require_once(dirname(__FILE__).'/../extra/PHP/simple/PHPCodeGenerator.php');

$run = new PHPCodeGenerator();
#$run->save();
echo "<b>dir build</b>: ".dirname(__FILE__).'/build<br />';

?>