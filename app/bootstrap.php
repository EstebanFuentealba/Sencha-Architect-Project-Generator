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
require_once(dirname(__FILE__).'/Sencha/Architect/app/controller/Ref.php');
require_once(dirname(__FILE__).'/Sencha/Architect/app/controller/Action.php');
require_once(dirname(__FILE__).'/Sencha/Architect/property/Property.php');

/* ExtJS 4.2 Files */
require_once(dirname(__FILE__).'/ext/app/Controller.php');
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
require_once(dirname(__FILE__).'/ext/selection/CheckboxModel.php');

require_once(dirname(__FILE__).'/ext/form/field/Text.php');
require_once(dirname(__FILE__).'/ext/form/field/Number.php');
require_once(dirname(__FILE__).'/ext/form/field/HtmlEditor.php');
require_once(dirname(__FILE__).'/ext/form/field/ComboBox.php');
require_once(dirname(__FILE__).'/ext/form/field/Hidden.php');
require_once(dirname(__FILE__).'/ext/button/Button.php');


use Ext\app\Controller as Controller;
use Sencha\Architect\app\controller\Action as Action;
use Sencha\Architect\app\controller\Ref as Ref;
use Sencha\Architect\property\Property as Property;

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
use Ext\toolbar\Toolbar as Toolbar;
use Ext\selection\CheckboxModel as CheckboxModel;

use Ext\form\field\Text as TextField;
use Ext\form\field\Number as NumberField;
use Ext\form\field\HtmlEditor as HtmlEditor;
use Ext\form\field\ComboBox as ComboBox;
use Ext\form\field\Hidden as Hidden;
use Ext\button\Button as Button;


/*
	First: Mapping Tables of database
*/
Debug::dump("[mapping] get all tables name");
$tables = KoalaMapping::getTables();


$app = new Application();
$app->name					=	'MyAppTest';
$app->autoCreateViewport 	= true;


$tableConfig	= array(
	'prefix'	=> 'm_',
	'suffix'	=> ''
);


Debug::dump("[mapping] obtaining all tables name");
foreach($tables as $tableName => $table){
	Debug::dump("[mapping] obtaining info the {".$tableName."}");
	
	$PHPClassName = Utils::getUnionName($tableName, $tableConfig);
	
	$storeName 		= 'store'.$PHPClassName;
	$modelName		= $PHPClassName;
	$viewName		= $PHPClassName.'View';
	$controllerName	= $PHPClassName.'Controller';
	
	
	
	/* STORE */
	$store = new JsonStore();
	$store->storeId 		= $storeName;
	$store->__userClassName	= $storeName;
	$store->__className		= $storeName;
	$store->__fileName		= $storeName;
		$customProperty = new Property();
		$customProperty->name = 'actionMethods';
		$customProperty->value = array(
			"{\r",
            "    create: 'POST',\r",
            "    read: 'GET',\r",
            "    update: 'POST',\r",
            "    destroy: 'POST'\r",
            "}"
		);
		$customProperty->configAlternates = 'object';
	$store->__customProperties[]	= $customProperty;
	
		$proxy = new Ajax();
		#$proxy->url 	= './mantenedor/'.$PHPClassName.'/read.php';
		$proxy->api		= array(
			"{\r",
			"    create: './mantenedor/".$PHPClassName."/add.php',\r",
			"    read: './mantenedor/".$PHPClassName."/read.php',\r",
			"    update: './mantenedor/".$PHPClassName."/update.php',\r",
			"    destroy: './mantenedor/".$PHPClassName."/delete.php'\r",
			"}"
		);
			$reader = new Json();
			$reader->root = 'records';
		$proxy->reader	= $reader;
	$store->proxy		= $proxy;
	
	/* MODEL */
	$model = new Model();
	$model->__userClassName	= $modelName;
	$model->__className		= $modelName;
	$model->__fileName		= $modelName;
	
	
	
	/* VIEW */
	$panel = new Panel();
	$panel->title = 'Panel '. $model->__className;
	$panel->__userClassName	= $viewName;
	$panel->__className		= $viewName;
	$panel->__fileName		= $viewName;
	
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
			$gridToolbar = new Toolbar();
				$removeSelectedButton = new Button();
				$removeSelectedButton->text	= 'Remove Selected';
				$removeSelectedButton->iconCls	= 'icon-delete';
				$removeSelectedButton->disabled = true;
				$gridToolbar->items[] = $removeSelectedButton;
			$gridToolbar->dock = 'top';
		$grid->dockedItems[] = $gridToolbar;	
			$selModel	= new CheckboxModel();
			$selModel->__userClassName	= 'MyCheckboxSelectionModel';
		$grid->selModel = $selModel;	
		
		
		$form = new FormPanel();
		$form->itemId 			= 'form'.ucwords($PHPClassName);
		$form->title			= 'Form ';
		$form->__columnWidth	= 0.4;
		$form->margin			= '0 0 0 5';
			$formToolbar = new Toolbar();
				$clearButton = new Button();
				$clearButton->text	= 'Clear';
				$clearButton->iconCls	= 'icon-clear';
				$clearButton->itemId	= 'btnClear';
			$formToolbar->items[] = $clearButton;
				$createButton = new Button();
				$createButton->text	= 'Create';
				$createButton->iconCls	= 'icon-create';
				$createButton->itemId	= 'btnCreate';
				
				#	Extra attributes (used in controller)
					$customProperty = new Property();
					$customProperty->name = 'storeName';
					$customProperty->value = $storeName;
				$createButton->__customProperties[]	= $customProperty;
					$customProperty = new Property();
					$customProperty->name = 'modelName';
					$customProperty->value = $app->name.'.model.'.$modelName;
				$createButton->__customProperties[]	= $customProperty;
				
				
			$formToolbar->items[] = $createButton;
			$formToolbar->dock = 'bottom';
		$form->dockedItems[] = $formToolbar;
	
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
			$formField->store = 'store'.Utils::getUnionName($table['constraints'][$columnName]['foreignTable'], $tableConfig);
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
					
					$PHPClassName = Utils::getUnionName($columnName, $tableConfig);
					
					
					$storeENUM = new Store();
					$storeENUM->storeId 		= $PHPClassName;
					$storeENUM->__userClassName	= $PHPClassName;
					$storeENUM->__className		= $PHPClassName;
					$storeENUM->__fileName		= $PHPClassName;
					
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
	
	
	
	/* CONTROLLER */
	$controller = new Controller();
	$controller->__userClassName 	= $controllerName;
	$controller->__className 		= $controllerName;
	$controller->__fileName			= $controllerName;
	$controller->views[] = $panel->__className;
		$ref = new Ref();
		$ref->ref = "form".ucwords($PHPClassName); /* obtain form */
		$ref->selector = '#form'.ucwords($PHPClassName); /* itemid selector of form */
	$controller->refs[] = $ref;
	
	
	/* append to generic controller */
	$controllerUtils->views[] = $panel->__className;
	
	
	

	/* Append store, Model, View and Controller to Applicaton */
	$app->models[$model->__className] 				= $model;
	$app->stores[$store->__className] 				= $store;
	$app->views[$panel->__className] 				= $panel;
	$app->controllers[$controller->__className] 	= $controller;
	
}

# Generic Controller (basic functions)
$controllerUtils = new Controller();
$controllerUtils->__userClassName 	= 'UtilsController';
$controllerUtils->__className 		= 'UtilsController';
$controllerUtils->__fileName		= 'UtilsController';
	#	Action Reset Form
	$action = new Action();
	$action->fn 			= 'clearForm';
	$action->implHandler[] 	= "this.getCreateForm().getForm().reset();\r"; /*Reset forms*/
	$action->name			= "click";
	$action->__controlQuery	= "#btnClear";
$controllerUtils->actions[] = $action;
	#	Action add record
	$action = new Action();
	$action->fn 			= 'addForm';
	$action->implHandler 	= array(
		"var form = this.getCreateForm();\r",
		"if(form.getForm().isValid()) {\r",
		"	var record = Ext.create(target.modelName, form.getForm().getValues()),\r",
		"		store = Ext.data.StoreManager.lookup(target.storeName),\r",
		"		model = Ext.ModelManager.getModel(target.modelName);\r",
		"	model.setProxy(store.getProxy());\r",
		"	record.save({\r",
		"		success: function(rec, op) {\r",
		"			store.add(rec);\r",
		"			form.getForm().reset();\r",
		"		},\r",
		"		failure: function(rec, op) {\r",
		"			console.log('ERROR');\r",
		"			console.log(op);\r",
		"		}\r",
		"	});\r",
		"};\r",
	);
	$action->name			= "click";
	$action->__controlQuery	= "#btnCreate";
$controllerUtils->actions[] = $action;
	#	Reference to component
	$ref = new Ref();
	$ref->ref = "createForm"; /* obtain form */
	$ref->selector = 'form'; /* itemid selector of form */
	$controllerUtils->refs[] = $ref;
$app->controllers['UtilsController'] 	= $controllerUtils;



# Create Project structure
$architect = new Architect();
$architect->setApp($app);
	$resource = new LibraryResource();
	$resource->theme = 'gray';
$architect->resources[] = $resource;
$architect->save(dirname(__FILE__).'/../');


?>