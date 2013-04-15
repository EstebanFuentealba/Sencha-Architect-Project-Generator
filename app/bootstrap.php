<?php
require_once(dirname(__FILE__).'/../libraries/Debug.php');

/* DataBase Mapping */
require_once(dirname(__FILE__).'/../libraries/Database.class.php');
require_once(dirname(__FILE__).'/../config.php');
require_once(dirname(__FILE__).'/../libraries/Koala.Mapping.php');
require_once(dirname(__FILE__).'/../libraries/Utils.php');


/* Export Fles */
require_once(dirname(__FILE__).'/../libraries/PHPZip/Zip.php');


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
require_once(dirname(__FILE__).'/ext/panel/Panel.php');
require_once(dirname(__FILE__).'/ext/form/Panel.php');
require_once(dirname(__FILE__).'/ext/grid/Panel.php');
require_once(dirname(__FILE__).'/ext/grid/column/Number.php');
require_once(dirname(__FILE__).'/ext/toolbar/Paging.php');

require_once(dirname(__FILE__).'/ext/form/field/Text.php');
require_once(dirname(__FILE__).'/ext/form/field/Number.php');
require_once(dirname(__FILE__).'/ext/form/field/HtmlEditor.php');
require_once(dirname(__FILE__).'/ext/form/field/ComboBox.php');
require_once(dirname(__FILE__).'/ext/form/field/Hidden.php');


use Ext\data\proxy\Ajax as Ajax;
use Ext\data\JsonStore as JsonStore;
use Ext\data\Store as Store;
use Ext\data\reader\Json as Json;
use Ext\data\Model as Model;
use Ext\data\Field as Field;
use Sencha\Architect\Base as Base;
use Sencha\Architect as Architect;
use Ext\app\Application as Application;
use Ext\resource\LibraryResource as LibraryResource;
use Ext\panel\Panel as Panel;
use Ext\grid\Panel as GridPanel;
use Ext\form\Panel as FormPanel;
use Ext\grid\column\Column as Column;
use Ext\grid\column\Number as NumberColumn;
use Ext\toolbar\Paging as Paging;

use Ext\form\field\Text as TextField;
use Ext\form\field\Number as NumberField;
use Ext\form\field\HtmlEditor as HtmlEditor;
use Ext\form\field\ComboBox as ComboBox;
use Ext\form\field\Hidden as Hidden;

/*
	First: Mapping Tables of database
*/
Debug::dump("[mapping] get all tables name");
$tables = KoalaMapping::getTables();


$app = new Application();
$app->name					=	'MyAppTest';
$app->autoCreateViewport 	= true;

Debug::dump("[mapping] obtaining all tables name");
foreach($tables as $tableName => $table){
	Debug::dump("[mapping] obtaining info the {".$tableName."}");
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
	
	
	
	/* VIEW */
	$panel = new Panel();
	$panel->title = 'Panel '. $model->__className;
	$panel->__userClassName	= $tableName.'View';
	$panel->__className		= $tableName.'View';
	$panel->__fileName		= $tableName.'View';
	
	$panel->layout			= "column";
	$panel->bodyPadding		= 5;
	if(is_null($panel->items) || !is_array($panel->items)){
		$panel->items = array();
	}
		$grid = new GridPanel();
		$grid->__columnWidth	= 0.6;
		$grid->store			= $store->__className;
			$paging	= new Paging();
			$paging->store	= $grid->store;
		$grid->dockedItems[] = $paging;
		
		$form = new FormPanel();
		$form->title = 'Form ';
		$form->__columnWidth	= 0.4;
		$form->margin	= '0 0 0 5';
	
	foreach($table["columns"] as $columnName => $col){

		##
		##	Fields of Model
		##
		
		$field = new Field();
			$field->name = $col["columnName"];
			if($col['isPrimaryKey'] && $col['extra'] == 'auto_increment') {
				$field->useNull = true;
			}
		$model->addField($field);
		
		##
		##	Columns of Grid
		##
			
		if($col['type'] == 'int') {
			$column = new NumberColumn();
		} else if($col['type'] == 'text') {
			$column = new Column();
		} else {
			$column = new Column();
		}
		
		##
		##	Fields of Form
		##
		
		if(array_key_exists($columnName, $table['constraints'])){
			##	Foreign Key to Combobox
			$formField = new ComboBox();
			$formField->store = 'store'.$table['constraints'][$columnName]['foreignTable'];
			##	TODO: Add variable to configure pageSize
			$formField->pageSize	= 25;
			$formField->valueField	= $table['constraints'][$columnName]['foreignColumn'];
		} else {
			if($col['isPrimaryKey'] && $col['extra'] == 'auto_increment') {
				$formField = new Hidden();
			} else {
				if($col['type'] == 'int') {
					$formField = new NumberField();
				} else if($col['type'] == 'text') {
					$formField = new HtmlEditor();
					$formField->labelAlign = 'top';
				} else if($col['type'] == 'enum') {
					
					$storeENUM = new Store();
					$storeENUM->storeId 		= $columnName;
					$storeENUM->__userClassName	= $columnName;
					$storeENUM->__className		= $columnName;
					$storeENUM->__fileName		= $columnName;
					if(is_null($storeENUM->fields) || !is_array($storeENUM->fields)){
						$storeENUM->fields = array();
					}
						$fieldKey = new Field();
						$fieldKey->name = "key";
					$storeENUM->fields[] = $fieldKey;
						$fieldValue = new Field();
						$fieldValue->name = "value";
					$storeENUM->fields[] = $fieldValue;
					$enumArray = array();
					foreach($col['columnValues'] as $enumValue) {
						$enumArray[] = array(
							'key'	=> $enumValue,
							'value'	=> $enumValue
						);
					}
					$storeENUM->data = json_encode($enumArray);
					
					$formField 					= new ComboBox();
					$formField->mode			= 'local';
					$formField->store 			= $storeENUM->__className;
					##	TODO: Add variable to configure pageSize
					$formField->pageSize		= 25;
					$formField->displayField	= 'value';
					$formField->valueField		= 'key';
					$app->stores[$storeENUM->__className] 	= $storeENUM;
					
				} else {
					$formField = new TextField();
				}
			}
		}
		
		##	Not NULL values
		if(!$col['nullCol']){
			$formField->allowBlank = false;
		}
		
		##	Configure Column 
		$column->text 		= $col["columnName"];
		$column->dataIndex 	= $col["columnName"];
		
		##	Configure Form Field
		$formField->fieldLabel	= $col["columnName"];
		$formField->name		= $col["columnName"];
		$formField->anchor		= '100%';
		
		
		
		## Append Form Field to Form Items 
		$form->items[] = $formField;
		## Append Column to Grid Columns
		$grid->columns[] = $column;
		
		
	}
	/*
	if(count($table['constraints'])>0){
		Debug::dump($table);
		foreach($table['constraints'] as $constraint) {
			Debug::dump($tables[$constraint['foreignTable']]["columns"][$constraint['foreignColumn']]);
		}
		exit(0);
	} else {
		#Not contains foreign keys
	}
	*/

	$panel->items[] = $grid;
	$panel->items[] = $form;
	
	
	$store->model 	= $model->__className;
	
	
	
	
	

	/* Append store, Model and View to Applicaton */
	$app->models[$model->__className] 	= $model;
	$app->stores[$store->__className] 	= $store;
	$app->views[$panel->__className] 	= $panel;

	
}

$architect = new Architect();
$architect->setApp($app);
	$resource = new LibraryResource();
$architect->resources[] = $resource;
$architect->save(dirname(__FILE__).'/../');


?>