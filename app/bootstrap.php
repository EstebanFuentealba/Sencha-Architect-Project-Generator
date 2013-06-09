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


$architect = new Architect(array(
	'resources'	=> array(
		new LibraryResource(array(
			'theme' => 'gray'
		))
	)
));

$app = new Application(array(
	'name'					=>	'MyAppTest',
	'autoCreateViewport' 	=> true
));

/* PORTAL VIEW */

	$model = new Model(array(
		'__userClassName'	=> 'TreeMenuNode',
		'__className'		=> 'TreeMenuNode',
		'__fileName'		=> 'TreeMenuNode',
		'fields'			=> array(
			new Field(array(
				'name'	=> 'module_name'
			)),
			new Field(array(
				'name'	=> 'component'
			)),
			new Field(array(
				'name'	=> 'text'
			)),
			new Field(array(
				'name'	=> 'node_type'
			)),
			new Field(array(
				'name'	=> 'url_action'
			))
		)
	));
$architect->models[$model->__className] = $model;
$app->models[$model->__className] 		= $model;

	$store = new TreeStore(array(
		'storeId'			=> 'TreeMenuStore',
		'__userClassName'	=> 'TreeMenuStore',
		'__className'		=> 'TreeMenuStore',
		'__fileName'		=> 'TreeMenuStore',
		'autoLoad'			=> true,
		'autoSync'			=> true,
		'proxy'				=> new Ajax(array(
			'url'		=> './mantenedor/__menu/read.php',
			'reader'	=> new Json()
		)),
		'root'				=> array(
			"{\r",
			"    text: 'Portal',\r",
			"    expanded: true\r",
			"}"
		),
		'model'				=> $model->__userClassName
	));

$architect->stores[$store->__className] = $store;
$app->stores[$store->__className] 		= $store;


	$viewport = new Viewport(array(
		'__userClassName'	=> 'Portal',
		'__className'		=> 'Portal',
		'__fileName'		=> 'Portal',
		'__initialView'		=> true,
		'stateful' 			=> true,
		'layout' 			=> "border",
		'items'				=> array(
			new Container(array(
				'region'	=> 'north',
				'height'	=> 30
			)),
			new Panel(array(
				'region' 	=> 'west',
				'margin' 	=> '5 5 5 5',
				'width'		=> 150,
				'title'		=> 'Menu',
				'items'		=> array(
					new TreePanel(array(
						'border' 		=> 0,
						'itemId'		=> 'tree-panel-menu',
						'title'			=> '',
						'store'			=> $store->__userClassName,
						'useArrows' 	=> true,
						'autoScroll'	=> true,
						'rootVisible'	=> false
					))
				)
			)),
			new Panel(array(
				'region' 	=> 'center',
				'itemId'  	=> 'content-panel',
				'margin'	=> '5 5 5 0',
				'stateful' 	=> true,
				'layout' 	=> 'card',
				'title'		=> '',
				'border' 	=> 0,
				'items'		=> array(
					new Panel(array(
						'title'		=> 'ExtJS Code Creator Portal',
						'itemId' 	=> 'content-panel-container',
						'html'		=> '<div style="margin: 20px;"><b>Link: </b> <a target="_blank" href="https://github.com/EstebanFuentealba/ExtJS-Code-Generator">https://github.com/EstebanFuentealba/ExtJS-Code-Generator</a></div>'
					))
				)
			))
		)
	));
	
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
	$store = new JsonStore(array(
		'storeId'				=> $storeName,
		'__userClassName'		=> $storeName,
		'__className'			=> $storeName,
		'__fileName'			=> $storeName,
		'autoLoad'				=> true,
		'autoSync'				=> true,
		'__customProperties'	=> array(
			new Property(array(
				'name'		=> 'actionMethods',
				'value'		=> array(
					"{\r",
					"    create: 'POST',\r",
					"    read: 'GET',\r",
					"    update: 'POST',\r",
					"    destroy: 'POST'\r",
					"}"
				),
				'configAlternates'	=> 'object'
			))
		),
		'proxy'					=> new Ajax(array(
			'api'	=> array(
				"{\r",
				"    create: './mantenedor/".$PHPClassName."/add.php',\r",
				"    read: './mantenedor/".$PHPClassName."/read.php',\r",
				"    update: './mantenedor/".$PHPClassName."/update.php',\r",
				"    destroy: './mantenedor/".$PHPClassName."/delete.php'\r",
				"}"
			),
			'reader'	=> new Json(array(
				'root'	=> 'records'
			))
		))
	));
	
	/* MODEL */
	$model = new Model(array(
		'__userClassName'	=> $modelName,
		'__className'		=> $modelName,
		'__fileName'		=> $modelName
	));	
	
	/* VIEW */
	
	$panelItemId 			= 'panel-'.strtolower(str_replace(array($tableConfig['prefix'], $tableConfig['suffix'],'_','-'),array("", "","-","-"), $tableName));
	$panelNameText			= ucwords(str_replace(array($tableConfig['prefix'], $tableConfig['suffix'],'_','-'),array("", "","-","-"), $tableName));
	
	$panel = new Panel(array(
		'title' 			=> 'Panel '. $model->__className,
		'__userClassName'	=> $viewName,
		'__className'		=> $viewName,
		'__fileName'		=> $viewName,
		'itemId'			=> $panelItemId,
		'layout'			=> "column",
		'bodyPadding'		=> 5,
		
	));
		$grid = new GridPanel(array(
			'__columnWidth'	=> 0.6,
			'store'			=> $store->__className,
			'itemId'		=> 'gridListPanel',
			'dockedItems'	=> array(
				new Paging(array(
					'dock'		=> 'bottom',
					'store'		=> $store->__className
				)),
				new Toolbar(array(
					'dock'		=> 'top',
					'items'		=> array(
						new Button(array(
							'text'					=> 'Remove Selected',
							'iconCls'				=> 'icon-delete',
							'itemId'				=> 'btnRemoveSelected',
							'disabled'				=> true,
							'__customProperties'	=> array(
								new Property(array(
									'name'	=> 'storeName',
									'value'	=> $storeName
								))
							)
						))
					)
				))
			),
			'selModel'		=> new CheckboxModel(array(
				'__userClassName'	=> 'MyCheckboxSelectionModel'
			))
		));	
		
		
		$form = new FormPanel(array(
			'itemId' 			=> 'form'.ucwords($PHPClassName),
			'title'				=> 'Form ',
			'__columnWidth'		=> 0.4,
			'margin'			=> '0 0 0 5',
			'dockedItems'		=> array(
				new Toolbar(array(
					'dock' 	=> 'bottom',
					'items'	=> array(
						new Button(array(
							'text'		=> 'Clear',
							'iconCls'	=> 'icon-clear',
							'itemId'	=> 'btnClear'
						)),
						new Button(array(
							'text'					=> 'Create',
							'iconCls'				=> 'icon-create',
							'itemId'				=> 'btnCreate',
							'__customProperties'	=> array(
								new Property(array(
									'name' 	=> 'storeName',
									'value' => $storeName
								)),
								new Property(array(
									'name' 	=> 'modelName',
									'value' => $app->name.'.model.'.$modelName
								))
							)
						))
					)
				))
			)
		));
	
	foreach($table["columns"] as $columnName => $col){

		##
		##	Fields of Model
		##
			$field = new Field(array(
				'name'		=> $col["columnName"],
				'useNull'	=> ($col['isPrimaryKey'] && $col['extra'] == 'auto_increment')
			));
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
		##	Configure Column 
		$column->text 		= $col["columnName"];
		$column->dataIndex 	= $col["columnName"];
		
		
		##
		##	Fields of Form
		##
		
		if(array_key_exists($columnName, $table['constraints'])){
		
			##	Foreign Key to Combobox
			$formField = new ComboBox(array(
				'store'			=> 'store'.Utils::getUnionName($table['constraints'][$columnName]['foreignTable'], $tableConfig),
				'pageSize'		=> 25,
				'valueField'	=> $table['constraints'][$columnName]['foreignColumn']
			));
			
			
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
					
					$enumArray = array();
					foreach($col['columnValues'] as $enumValue) {
						$enumArray[] = array(
							'key'	=> $enumValue,
							'value'	=> $enumValue
						);
					}
					
					$storeENUM = new Store(array(
						'storeId' 			=> $PHPClassName,
						'__userClassName'	=> $PHPClassName,
						'__className'		=> $PHPClassName,
						'__fileName'		=> $PHPClassName,
						'fields'			=> array(
							new Field(array(
								'name' => "key"
							)),
							new Field(array(
								'name' => "value"
							))
						),
						'data' 				=> json_encode($enumArray)
					));
					
					$formField 					= new ComboBox(array(
						'mode'			=> 'local',
						'store' 		=> $storeENUM->__className,
						'pageSize'		=> 25,
						'displayField'	=> 'value',
						'valueField'	=> 'key'
					));
					
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
	

	#	Append store, Model, View and Controller to Applicaton
	
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
$controllerUtils = new Controller(array(
	'__userClassName' 	=> 'GenericController',
	'__className' 		=> 'GenericController',
	'__fileName'		=> 'GenericController',
	'actions'			=> array(
		new Action(array(
			'fn' 				=> 'clearForm',
			'implHandler' 		=> array(
				"this.getCreateForm().getForm().reset();\r"
			),
			'name'				=> "click",
			'__controlQuery'	=> "#btnClear"
		)),
		new Action(array(
			'fn' 				=> 'addForm',
			'implHandler' 		=> array(
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
			),
			'name'				=> "click",
			'__controlQuery'	=> "#btnCreate"
		)),
		new Action(array(
			'fn' 				=> 'removeItem',
			'implHandler' 		=> array(
				"var records = this.getGridList().getView().getSelectionModel().getSelection();\r",
				"if(records.length > 0) {\r",
				"	Ext.MessageBox.confirm('Confirmar', 'Are you sure you want to delete the selected rows?', function(opt){\r",
				"		if(opt != 'no') {\r",
				"			var store = Ext.data.StoreManager.lookup(target.storeName);\r",
				"			store.remove(records);\r",
				"		}\r",
				"	});\r",
				"}\r"
			),
			'name'				=> "click",
			'__controlQuery'	=> "#btnRemoveSelected"
		)),
		new Action(array(
			'fn' 				=> 'selectRowOfGrid',
			'__params'			=> array(
				'target',
				'selections'
			),
			'implHandler' 		=> array(
				"this.getGridList().down('#btnRemoveSelected').setDisabled(selections.length === 0);\r"
			),
			'name'				=> "selectionchange",
			'__controlQuery'	=> "#gridListPanel"
		))
	),
	'refs'	=> array(
		new Ref(array(
			'ref' 		=> "createForm",
			'selector' 	=> 'form'
		)),
		new Ref(array(
			'ref' 		=> "gridList",
			'selector' 	=> '#gridListPanel'
		))
	)
));

$architect->controllers['GenericController'] 	= $controllerUtils;
$app->controllers['GenericController'] 			= $controllerUtils;



#Portal Controller
$controllerPortal = new Controller(array(
	'__userClassName' 	=> 'Portal',
	'__className' 		=> 'Portal',
	'__fileName'		=> 'Portal',
	'actions'			=> array(
		new Action(array(
			'fn' 			=> 'selectItem',
			'__params'		=> array(
				'selModel',
				'record',
				'index',
				'options'
			),
			'implHandler' 	=> array(
				"console.log('select item');\r",
				"var contentPanel = this.getContentPanel();\r",
				"contentPanel.setLoading(true);\r",
				"switch (record.get(\"node_type\")) {\r",
				"    case 'panel' :\r",
				"    if (record.get('leaf')) {\r",
				"        var component = record.get('component');\r",
				"       \r",
				"        Ext.application({\r",
				"            requires: \tcomponent.requires,\r",
				"            models: \tcomponent.models,\r",
				"            stores: \tcomponent.stores,\r",
				"            views: \t\tcomponent.views,\r",
				"            launch: \tfunction() {\r",
				"                try{\r",
				"                    var view = Ext.create(component.views[0],{\r",
				"                        listeners: {\r",
				"                            render: function () {\r",
				"                                contentPanel.layout.setActiveItem(this.getItemId());\r",
				"                                contentPanel.setLoading(false);\r",
				"                            }\r",
				"                        }\r",
				"                    });\r",
				"                    contentPanel.removeAll();\r",
				"                    contentPanel.add(view);\r",
				"                    \r",
				"                }catch(e){\r",
				"                \tcontentPanel.setLoading(false);\r",
				"                }\r",
				"            },\r",
				"            name: '".$app->name."'\r",
				"        });\r",
				"    }\r",
				"    break;\r",
				"    case 'link' :\r",
				"    contentPanel.setLoading(false);\r",
				"    window.location = record.get(\"url_action\");\r",
				"    break;\r",
				"}"
			),
			'name'					=> "select",
			'__controlQuery'		=> "#tree-panel-menu"
		))
	),
	'refs'			=> array(
		new Ref(array(
			'ref'		=> "contentPanel",
			'selector'	=> '#content-panel'
		))
	)
));

$architect->controllers['Portal'] 	= $controllerPortal;
$app->controllers['Portal'] 		= $controllerPortal;



# Create Project structure
$architect->setApp($app);
$architect->save(dirname(__FILE__).'/../');


$treeFilePath = dirname(__FILE__).'/../build/mantenedor/__menu';
@mkdir($treeFilePath, 0755, true);
file_put_contents($treeFilePath.'/read.php', json_encode($treeFile));
?>