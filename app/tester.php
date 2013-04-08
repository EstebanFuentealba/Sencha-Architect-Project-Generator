<?php
/* DataBase Mapping */
require_once(dirname(__FILE__).'/../libraries/Database.class.php');
require_once(dirname(__FILE__).'/../config.php');
require_once(dirname(__FILE__).'/../libraries/Koala.Mapping.php');
require_once(dirname(__FILE__).'/../libraries/Koala.Generator.php');
require_once(dirname(__FILE__).'/../libraries/Utils.php');


/* Export Fles */
#require_once(dirname(__FILE__).'/../libraries/Mustache/src/Mustache/Autoloader.php');
require_once(dirname(__FILE__).'/../libraries/PHPZip/Zip.php');
require_once(dirname(__FILE__).'/Mapper.php');


/* Sencha Architect */
require_once(dirname(__FILE__).'/ext/app/Application.php');
require_once(dirname(__FILE__).'/Sencha/Architect.php');
require_once(dirname(__FILE__).'/Sencha/Architect/Base.php');

/* ExtJS 4.2 Files */
require_once(dirname(__FILE__).'/ext/resource/LibraryResource.php');
require_once(dirname(__FILE__).'/ext/data/Field.php');
require_once(dirname(__FILE__).'/ext/data/Model.php');
require_once(dirname(__FILE__).'/ext/data/proxy/Ajax.php');
require_once(dirname(__FILE__).'/ext/data/JsonStore.php');
require_once(dirname(__FILE__).'/ext/data/reader/Json.php');

use Ext\data\proxy\Ajax as Ajax;
use Ext\data\JsonStore as JsonStore;
use Ext\data\reader\Json as Json;
use Ext\data\Model as Model;
use Ext\data\Field as Field;
use Sencha\Architect\Base as Base;
use Sencha\Architect as Architect;
use Ext\app\Application as Application;
use Ext\resource\LibraryResource as LibraryResource;

echo "<pre>";

/*
	First: Mapping Tables of database
*/
$tables = KoalaMapping::getTables();


$app = new Application();
$app->name					=	'MyAppTest';
$app->autoCreateViewport 	= true;


foreach($tables as $tableName){

	/* obtengo la información (estructura) de cada tabla*/
	$table = KoalaMapping::getTable($tableName);
	
	/* STORE */
	$store = new JsonStore();
	$store->storeId 		= 'store'.$tableName;
	$store->__userClassName	= 'store'.$tableName;
	$store->__className		= 'store'.$tableName;
	$store->__fileName		= 'store'.$tableName;
		$proxy = new Ajax();
		$proxy->url 	= './mantenedor/test.php';
			$reader = new Json();
			$reader->root = 'records';
		$proxy->reader	= $reader;
	$store->proxy		= $proxy;
	
	/* MODEL */
	$model = new Model();
	$model->__userClassName	= $tableName;
	$model->__className		= $tableName;
	$model->__fileName		= $tableName;
	foreach($table["columns"] as $column){
		$field = new Field();
			$field->name = $column["columnName"];
			if($column['isPrimaryKey'] && $column['extra'] == 'auto_increment') {
				$field->useNull = true;
			}
		$model->addField($field);
		
	}
	
	
	$store->model = $model->__className;

	/* VIEW */
	

	/* Append store, Model and View to Applicaton */
	$app->models[] = $model;
	$app->stores[] = $store;
	
	/*
	echo '<pre>';
	print_r($store->toMetaDataArray());
	#print_r("Ext.define('".$app->name.".model.".$model->__className."',".json_encode($model->toArrayDefinition() , JSON_PRETTY_PRINT).");");
	echo '</pre>';
	exit(0);
	*/
	
}

$architect = new Architect();
$architect->setApp($app);
	$resource = new LibraryResource();
$architect->resources[] = $resource;
$architect->save(dirname(__FILE__).'/../');





echo '</pre>';

?>