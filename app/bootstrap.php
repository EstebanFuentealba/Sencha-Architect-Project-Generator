<?php

require_once(dirname(__FILE__).'/../libraries/Database.class.php');
require_once(dirname(__FILE__).'/../config.php');
require_once(dirname(__FILE__).'/../libraries/Koala.Mapping.php');
require_once(dirname(__FILE__).'/../libraries/Koala.Generator.php');
require_once(dirname(__FILE__).'/../libraries/Utils.php');

require_once(dirname(__FILE__).'/../libraries/Mustache/src/Mustache/Autoloader.php');
require_once(dirname(__FILE__).'/../libraries/PHPZip/Zip.php');

require_once(dirname(__FILE__).'/Mapper.php');
require_once(dirname(__FILE__).'/ExtJSColumn.php');

$mapper = new Mapper();
$zip = new Zip();
$m = new Mustache_Engine;
$zip->setComment("Koala Generator v1.0.\nExtJS 4.2 application\nCreated on " . date('l jS \of F Y h:i:s A'));
$fileTemplates = array();
foreach($mapper->templates as $template){
	$fileInfo = $mapper->getFileName(null,$template);
	if($fileInfo['typeMapping'] == 's') {
		/* Single File */
		/*$renderJS = $m->render(file_get_contents($template), array(
			'defaultConfig' => $mapper->_defaultConfig,
			'items' => $mapper->raw
		));*/
		
		$filePath = $mapper->getFileName(
			Utils::getUnionName($mapper->_defaultConfig['projectName'],false),
			$template
		);
		
		$info = pathinfo($filePath["fileNamePath"]);
		$type = str_replace('app/','',$info['dirname']);
			
		$className = null;
		if(array_key_exists('extension', $info)) {
			$className = str_replace('.'.$info['extension'],'',$info['basename']);
		}
		
		
		$fileTemplates[$fileInfo['typeMapping']][(($type == 'model') ? 'model' :(( $type == 'store') ? 'store' :  (($type == 'view') ? 'view' :  'other')))][] = array(
			'template'			=> $template,
			'path' 				=> $filePath["fileNamePath"],
			'designerId'		=> KoalaGenerator::newGUID(),
			'className'			=> $className,
			'table' 			=> $mapper->raw,
			'isLessThanTotal'	=> true
		);
		//$zip->addFile($renderJS , $filePath["fileNamePath"]);
		
	} else if($fileInfo['typeMapping'] == 'm') {
		/* Multi Files */
		foreach($mapper->raw as $table) {
			$filePath = $mapper->getFileName(
				Utils::getUnionName($table["tableName"],false),
				$template
			);
			/*$renderJS = $m->render(file_get_contents($template), array(
				'defaultConfig' => $mapper->_defaultConfig,
				'table' => $table
			));*/
			$info = pathinfo($filePath["fileNamePath"]);
			$type = str_replace('app/','',$info['dirname']);
			$className = null;
			if(array_key_exists('extension', $info)) {
				$className = str_replace('.'.$info['extension'],'',$info['basename']);
			}
			
			$fileTemplates[$fileInfo['typeMapping']][(($type == 'model') ? 'model' :(( $type == 'store') ? 'store' :  (($type == 'view') ? 'view' :  'other')))][] = array(
				'template'			=> $template,
				'path' 				=> $filePath["fileNamePath"],
				'designerId'		=> KoalaGenerator::newGUID(),
				'className'			=> $className,
				'table' 			=> $table,
				'isLessThanTotal'	=> $table['isLessThanTotal']
			);
			//$zip->addFile($renderJS , $filePath["fileNamePath"]);
		}
	}
}

$dataExtJS = array(
	'model' => array_merge(
		((is_array($fileTemplates['s']) && array_key_exists('model', $fileTemplates['s'])) ? $fileTemplates['s']['model'] : array()),
		((is_array($fileTemplates['m']) && array_key_exists('model', $fileTemplates['m'])) ? $fileTemplates['m']['model'] : array())
	),
	'store'	=> array_merge(
		((is_array($fileTemplates['s']) && array_key_exists('store', $fileTemplates['s'])) ? $fileTemplates['s']['store'] : array()),
		((is_array($fileTemplates['m']) && array_key_exists('store', $fileTemplates['m'])) ? $fileTemplates['m']['store'] : array())
	),
	'view'	=> array_merge(
		((is_array($fileTemplates['s']) && array_key_exists('view', $fileTemplates['s'])) ? $fileTemplates['s']['view'] : array()),
		((is_array($fileTemplates['m']) && array_key_exists('view', $fileTemplates['m'])) ? $fileTemplates['m']['view'] : array())
	),
	'other'	=> array_merge(
		((is_array($fileTemplates['s']) && array_key_exists('other', $fileTemplates['s'])) ? $fileTemplates['s']['other'] : array()),
		((is_array($fileTemplates['m']) && array_key_exists('other', $fileTemplates['m'])) ? $fileTemplates['m']['other'] : array())
	)
);

/*
echo "<pre>";
print_r($dataExtJS);
echo "</pre>";
*/

foreach($dataExtJS as $key => $values) {
	foreach($values as $mutacheValue) {
		$renderJS = $m->render(file_get_contents($mutacheValue['template']), array(
			'defaultConfig' 	=> $mapper->_defaultConfig,
			'designerId'		=> $mutacheValue['designerId'],
			'table' 			=> $mutacheValue['table'],
			'ext'				=> $dataExtJS,
			'isLessThanTotal'	=> $mutacheValue['isLessThanTotal']
		));
		$zip->addFile($renderJS , $mutacheValue['path']);
	}
}
$zip->sendZip("KoalaGenerator-".time().".zip");

?>