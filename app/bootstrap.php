<?php

require_once(dirname(__FILE__).'/../libraries/Database.class.php');
require_once(dirname(__FILE__).'/../config.php');
require_once(dirname(__FILE__).'/../libraries/Koala.Mapping.php');
require_once(dirname(__FILE__).'/../libraries/Koala.Generator.php');

require_once(dirname(__FILE__).'/../libraries/Mustache/src/Mustache/Autoloader.php');
require_once(dirname(__FILE__).'/../libraries/PHPZip/Zip.php');

require_once(dirname(__FILE__).'/Mapper.php');
require_once(dirname(__FILE__).'/ExtJSColumn.php');

$mapper = new Mapper();
$zip = new Zip();
$m = new Mustache_Engine;
$zip->setComment("Koala Generator v1.0.\nExtJS 4.2 application\nCreated on " . date('l jS \of F Y h:i:s A'));
foreach($mapper->templates as $template){
	$fileInfo = $mapper->getFileName(null,$template);
	if($fileInfo['typeMapping'] == 's') {
		/* Single File */
		$renderJS = $m->render(file_get_contents($template), array(
			'defaultConfig' => $mapper->_defaultConfig,
			'items' => $mapper->raw
		));
		$zip->addFile($renderJS , $fileInfo['fileNamePath']);
	} else if($fileInfo['typeMapping'] == 'm') {
		/* Multi Files */
		foreach($mapper->raw as $table) {
			$filePath = $mapper->getFileName($table["tableName"],$template);
			$renderJS = $m->render(file_get_contents($template), $table);
			$zip->addFile($renderJS , $filePath["fileNamePath"]);
		}
	}
	
}
$zip->sendZip("KoalaGenerator-".time().".zip");

?>