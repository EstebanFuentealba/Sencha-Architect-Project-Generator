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
require_once(dirname(__FILE__).'/ext/container/Viewport.php');
require_once(dirname(__FILE__).'/ext/app/Controller.php');
require_once(dirname(__FILE__).'/ext/resource/LibraryResource.php');
require_once(dirname(__FILE__).'/ext/data/Field.php');
require_once(dirname(__FILE__).'/ext/data/Model.php');
require_once(dirname(__FILE__).'/ext/data/proxy/Ajax.php');
require_once(dirname(__FILE__).'/ext/data/JsonStore.php');
require_once(dirname(__FILE__).'/ext/data/TreeStore.php');
require_once(dirname(__FILE__).'/ext/data/reader/Json.php');
require_once(dirname(__FILE__).'/ext/panel/Panel.php');
require_once(dirname(__FILE__).'/ext/form/Panel.php');
require_once(dirname(__FILE__).'/ext/grid/Panel.php');
require_once(dirname(__FILE__).'/ext/tree/Panel.php');
require_once(dirname(__FILE__).'/ext/grid/column/Number.php');
require_once(dirname(__FILE__).'/ext/toolbar/Paging.php');
require_once(dirname(__FILE__).'/ext/selection/CheckboxModel.php');

require_once(dirname(__FILE__).'/ext/form/field/Text.php');
require_once(dirname(__FILE__).'/ext/form/field/Number.php');
require_once(dirname(__FILE__).'/ext/form/field/HtmlEditor.php');
require_once(dirname(__FILE__).'/ext/form/field/ComboBox.php');
require_once(dirname(__FILE__).'/ext/form/field/Hidden.php');
require_once(dirname(__FILE__).'/ext/button/Button.php');


use Ext\container\Viewport as Viewport;
use Ext\container\Container as Container;
use Ext\tree\Panel as TreePanel;
use Ext\app\Controller as Controller;
use Sencha\Architect\app\controller\Action as Action;
use Sencha\Architect\app\controller\Ref as Ref;
use Sencha\Architect\property\Property as Property;

use Ext\data\proxy\Ajax as Ajax;
use Ext\data\JsonStore as JsonStore;
use Ext\data\TreeStore as TreeStore;
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


$treeFile	= array(
	'text'		=> '.',
	'children'	=> array()
);


$architect = new Architect();



$app = new Application();
$app->name					=	'MyAppTest';
$app->autoCreateViewport 	= true;

/* PORTAL VIEW */

	$model = new Model();
	$model->__userClassName	= 'TreeMenuNode';
	$model->__className		= 'TreeMenuNode';
	$model->__fileName		= 'TreeMenuNode';
		$field = new Field();
		$field->name = 'module_name';
	$model->addField($field);
		$field = new Field();
		$field->name = 'component';
	$model->addField($field);
		$field = new Field();
		$field->name = 'text';
	$model->addField($field);
		$field = new Field();
		$field->name = 'node_type';
	$model->addField($field);
		$field = new Field();
		$field->name = 'url_action';
	$model->addField($field);
		
	
$architect->models[$model->__className] = $model;
$app->models[$model->__className] 		= $model;

	$store = new TreeStore();
	$store->storeId 		= 'TreeMenuStore';
	$store->__userClassName	= 'TreeMenuStore';
	$store->__className		= 'TreeMenuStore';
	$store->__fileName		= 'TreeMenuStore';

	$store->autoLoad		= true;
	$store->autoSync		= true;
		$proxy = new Ajax();
		$proxy->url 	= './mantenedor/__menu/read.php';
			$reader = new Json();
		$proxy->reader	= $reader;
	$store->proxy		= $proxy;
	$store->root		= array(
		"{\r",
		"    text: 'Portal',\r",
		"    expanded: true\r",
		"}"
	);
	$store->model 		= $model->__userClassName;
$architect->stores[$store->__className] = $store;
$app->stores[$store->__className] 		= $store;


	$viewport = new Viewport();
	$viewport->__userClassName	= 'Portal';
	$viewport->__className		= 'Portal';
	$viewport->__fileName		= 'Portal';
	$viewport->__initialView	= true;
	$viewport->stateful = true;
	$viewport->layout = "border";
		$container 			= new Container();
		$container->region 	= 'north';
		$container->height 	= 30;
	$viewport->items[] = $container;
		$panel 			= new Panel();
		$panel->region 	= 'west';
		$panel->margin 	= '5 5 5 5';
		$panel->width	= 150;
		$panel->title	= 'Menu';
			$treepanel = new TreePanel();
			$treepanel->border 		= 0;
			$treepanel->itemId		= 'tree-panel-menu';
			$treepanel->title		= '';
			$treepanel->store		= $store->__userClassName;
			$treepanel->useArrows 	= true;
			$treepanel->autoScroll	= true;
			$treepanel->rootVisible	= false;
		$panel->items[] = $treepanel;
	$viewport->items[] = $panel;
		$contentPanel 			= new Panel();
		$contentPanel->region 	= 'center';
		$contentPanel->itemId  		= 'content-panel';
		$contentPanel->margin	= '5 5 5 0';
		$contentPanel->stateful = true;
		$contentPanel->layout 	= 'card';
		$contentPanel->title	= '';
		$contentPanel->border 	= 0;
			$container 			= new Panel();
			$container->title	= 'ExtJS Code Creator Portal';
			$container->itemId 	= 'content-panel-container';
			$container->html	= '<div style="margin: 20px;"><b>Link: </b> <a target="_blank" href="https://github.com/EstebanFuentealba/ExtJS-Code-Generator">https://github.com/EstebanFuentealba/ExtJS-Code-Generator</a></div>';
		$contentPanel->items[]	= $container;
	$viewport->items[] = $contentPanel;
$architect->views[$viewport->__className] = $viewport;
$app->views[$viewport->__className] = $viewport;
	
$tableConfig	= array(
	'prefix'	=> 'm_',
	'suffix'	=> ''
);



Debug::dump("[mapping] obtaining all tables name");
foreach($tables as $tableName => $table){
	Debug::dump("[mapping] obtaining info the {".$tableName."}");
	
	$treeComponent = array(
		'views'			=> array(),
		'stores'		=> array(),
		'models'		=> array(),
		'controllers'	=> array(),
		'requires'		=> array()
	);
	
	
	
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

	$store->autoLoad		= true;
	$store->autoSync		= true;

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
	
	$panelItemId 			= 'panel-'.strtolower(str_replace(array($tableConfig['prefix'], $tableConfig['suffix'],'_','-'),array("", "","-","-"), $tableName));
	$panelNameText			= ucwords(str_replace(array($tableConfig['prefix'], $tableConfig['suffix'],'_','-'),array("", "","-","-"), $tableName));
	
	$panel->itemId			= $panelItemId;
	
	$panel->layout			= "column";
	$panel->bodyPadding		= 5;
	if(is_null($panel->items) || !is_array($panel->items)){
		$panel->items = array();
	}
		$grid = new GridPanel();
		$grid->__columnWidth	= 0.6;
		$grid->store			= $store->__className;
		$grid->itemId			= 'gridListPanel';
			$paging	= new Paging();
			$paging->store	= $grid->store;
		$grid->dockedItems[] = $paging;	
			$gridToolbar = new Toolbar();
				$removeSelectedButton = new Button();
				$removeSelectedButton->text	= 'Remove Selected';
				$removeSelectedButton->iconCls	= 'icon-delete';
				$removeSelectedButton->itemId	= 'btnRemoveSelected';
				$removeSelectedButton->disabled = true;
					#	Extra attributes (used in controller)
					$customProperty = new Property();
					$customProperty->name = 'storeName';
					$customProperty->value = $storeName;
				$removeSelectedButton->__customProperties[]	= $customProperty;
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
			
			$treeComponent['stores'][] 	= $formField->store;
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
					
					$architect->stores[$storeENUM->__className] = $storeENUM;
					$treeComponent['stores'][] 	= $storeENUM->__className;
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
	/*
	$controller = new Controller();
	$controller->__userClassName 	= $controllerName;
	$controller->__className 		= $controllerName;
	$controller->__fileName			= $controllerName;
	$controller->views[] = $panel->__className;
		$ref = new Ref();
		$ref->ref = "form".ucwords($PHPClassName);
		$ref->selector = '#form'.ucwords($PHPClassName);
	$controller->refs[] = $ref;
$app->controllers[$controller->__className] 	= $controller;
	*/
	
	
	

	/* Append store, Model, View and Controller to Applicaton */
	
	$architect->models[$model->__className] 		= $model;
	$architect->stores[$store->__className] 		= $store;
	$architect->views[$panel->__className] 			= $panel;
	
	
	$treeComponent['views'][] 	= $app->name.'.view.'.$panel->__className;
	$treeComponent['models'][] 	= $app->name.'.model.'.$modelName;
	$treeComponent['stores'][] 	= $store->__className;
	
	/* Add Models, Stores, Views to Aplication */
	#$app->models[$model->__className] 				= $model;
	#$app->stores[$store->__className] 				= $store;
	#$app->views[$panel->__className] 				= $panel;
	
	
	$treeItem = array(
		'text'		=> $panelNameText,
		'itemId'	=> $panelItemId,
		'node_type'	=> 'panel',
		'leaf'		=> true,
		'component'	=> $treeComponent
	);
	$treeFile['children'][] = $treeItem;
	
}

# Generic Controller (basic functions)
$controllerUtils = new Controller();
$controllerUtils->__userClassName 	= 'GenericController';
$controllerUtils->__className 		= 'GenericController';
$controllerUtils->__fileName		= 'GenericController';
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

	#	Action Delete item
	$action = new Action();
	$action->fn 			= 'removeItem';
	$action->implHandler 	= array(
		"var records = this.getGridList().getView().getSelectionModel().getSelection();\r",
		"if(records.length > 0) {\r",
		"	Ext.MessageBox.confirm('Confirmar', '¿Estás seguro que quieres eliminar los seleccionados?', function(opt){\r",
		"		if(opt != 'no') {\r",
		"			var store = Ext.data.StoreManager.lookup(target.storeName);\r",
		"			store.remove(records);\r",
		"		}\r",
		"	});\r",
		"}\r"
	);
	$action->name			= "click";
	$action->__controlQuery	= "#btnRemoveSelected";
$controllerUtils->actions[] = $action;

	#	Action Selection item
	$action = new Action();
	$action->fn 			= 'selectRowOfGrid';
	$action->__params[]		= 'selections';	
	$action->implHandler 	= array(
		"this.getGridList().down('#btnRemoveSelected').setDisabled(selections.length === 0);\r"
	);
	$action->name			= "selectionchange";
	$action->__controlQuery	= "#gridListPanel";
$controllerUtils->actions[] = $action;


	#	Reference to component Form
	$ref = new Ref();
	$ref->ref = "createForm"; /* obtain form */
	$ref->selector = 'form'; /* itemid selector of form */
$controllerUtils->refs[] = $ref;
	#	Reference to component Grid
	$ref = new Ref();
	$ref->ref = "gridList"; /* obtain form */
	$ref->selector = '#gridListPanel'; /* itemid selector of grid */
$controllerUtils->refs[] = $ref;


$architect->controllers['GenericController'] 	= $controllerUtils;
$app->controllers['GenericController'] 			= $controllerUtils;



#Portal Controller
$controllerPortal = new Controller();
$controllerPortal->__userClassName 	= 'Portal';
$controllerPortal->__className 		= 'Portal';
$controllerPortal->__fileName		= 'Portal';
	#	Action Event Select Tree Item
	$action = new Action();
	$action->fn 			= 'selectItem';
	$action->__params		= array(
		'selModel',
		'record',
		'index',
		'options'
	);	
	$action->implHandler 	= array(
		"console.log('select item');\r",
		"var contentPanel = this.getContentPanel();\r",
		"contentPanel.setLoading(true);\r",
		"switch (record.get(\"node_type\")) {\r",
		"\tcase 'panel' :\r",
		"\tif (record.get('leaf')) {\r",
		"\t\tvar component = record.get('component');\r",
		"\t\tExt.application({\r",
		"\t\t\trequires: \tcomponent.requires,\r",
		"\t\t\tmodels: \tcomponent.models,\r",
		"\t\t\tstores: \tcomponent.stores,\r",
		"\t\t\tviews: \t\tcomponent.views,\r",
		"\t\t\tlaunch: \tfunction() {\r",
		"\t\t\t\tvar view = Ext.create(component.views[0],{\r",
		"\t\t\t\t\tlisteners: {\r",
		"\t\t\t\t\t\trender: function () {\r",
		"\t\t\t\t\t\t\tcontentPanel.layout.setActiveItem(this.getItemId());\r",
		"\t\t\t\t\t\t\tcontentPanel.setLoading(false);\r",
		"\t\t\t\t\t\t}\r",
		"\t\t\t\t\t}\r",
		"\t\t\t\t});\r",
		"\t\t\t\tcontentPanel.removeAll();\r",
		"\t\t\t\tcontentPanel.add(view);\r",
		"\t\t\t},\r",
		"\t\t\tname: '".$app->name."'\r",
		"\t\t});\r",
		"\t}\r",
		"\tbreak;\r",
		"\tcase 'link' :\r",
		"\t\tcontentPanel.setLoading(false);\r",
		"\t\twindow.location = record.get(\"url_action\");\r",
		"\tbreak;\r",
		"}"
	);
	$action->name			= "select";
	$action->__controlQuery	= "#tree-panel-menu";
$controllerPortal->actions[] = $action;
$architect->controllers['Portal'] 	= $controllerPortal;
$app->controllers['Portal'] 		= $controllerPortal;
	#	Reference to component Content Panel
	$ref = new Ref();
	$ref->ref = "contentPanel"; /* obtain form */
	$ref->selector = '#content-panel'; /* itemid selector of grid */
$controllerPortal->refs[] = $ref;



# Create Project structure
$architect->setApp($app);
	$resource = new LibraryResource();
	$resource->theme = 'gray';
$architect->resources[] = $resource;
$architect->save(dirname(__FILE__).'/../');


$treeFilePath = dirname(__FILE__).'/../build/mantenedor/__menu';
@mkdir($treeFilePath, 0755, true);
file_put_contents($treeFilePath.'/read.php', json_encode($treeFile));
?>