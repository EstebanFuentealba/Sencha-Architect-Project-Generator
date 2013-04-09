<?PHP
namespace Sencha;

require_once(dirname(__FILE__).'/../../libraries/Utils.php');
require_once(dirname(__FILE__).'/../../libraries/Debug.php');
require_once(dirname(__FILE__).'/XDS.php');
require_once(dirname(__FILE__).'/Architect/FileMap.php');
require_once(dirname(__FILE__).'/Architect/OrderMap.php');
require_once(dirname(__FILE__).'/Architect/State.php');
require_once(dirname(__FILE__).'/Architect/TabState.php');
require_once(dirname(__FILE__).'/Architect/ExpandedState.php');

use Sencha\XDS as XDS;
use Sencha\Architect\FileMap as FileMap;
use Sencha\Architect\OrderMap as OrderMap;

use Sencha\Architect\State as State;
use Sencha\Architect\TabState as TabState;
use Sencha\Architect\ExpandedState as ExpandedState;
use \Utils as Utils;
use \Debug as Debug;


class Architect {
	/* Config */
	public $application 	= 	NULL;
	public $tabState		= 	NULL;
	public $canvasState		=	NULL;
	public $inspectorState	=	NULL;
	public $codeState		=	NULL;
	public $editMode		= 	'code';
	public $resources		= 	array();
	public $expandedState	= 	NULL;
	
	public function __construct(){
	}
	public function setApp($app) {
		$this->application = $app;
		$this->expandedState	= new ExpandedState();
		$this->tabState 		= new TabState();
		$this->canvasState		= new State();
		$this->inspectorState	= new State();
		$this->codeState		= new State();
	}	
	public function save($path){
	
		Debug::dump('[delete] Delete dir project');
		Utils::rrmdir($path.PROJECT_PATH);
		sleep(1);
		
		##
		##	Save as Sencha Architect Project (ExtJS 4.2)
		##
		$xds = new XDS();
		$orderMap = new OrderMap();
		/* Save all models */
		Debug::dump('[save] Save all models');
		foreach($this->application->models as $model) {
			@mkdir($path.PROJECT_PATH.'/metadata/model/', 0777, true);
			$parseArray = $model->toMetaDataArray();
			
			/* add to xds */
			$fileMap = new FileMap();
				$fileMap->__className	= $model->__className;
				$fileMap->paths	= array(
					"metadata/model/".$model->__fileName,
					"app/model/override/".$model->__fileName.".js",
					"app/model/".$model->__fileName.".js"
				);
			
			$orderMap->model[] = $model->__designerId;
			
			$xds->topInstanceFileMap[$model->__designerId] = $fileMap->toMap();
			
			$key = $model->__designerId;
			$this->expandedState->$key = $model->toArchitect();
			
			file_put_contents(
				$path.PROJECT_PATH.'/metadata/model/'.$model->__fileName, 
				json_encode($parseArray , JSON_PRETTY_PRINT )
			);
			
		}
		/* Save all stores */
		Debug::dump('[save] Save all stores');
		foreach($this->application->stores as $store) {
			@mkdir($path.PROJECT_PATH.'/metadata/store/', 0777, true);
			$parseArray = $store->toMetaDataArray();
			
			/* add to xds */
			$fileMap = new FileMap();
				$fileMap->__className	= $store->__className;
				$fileMap->paths	= array(
					"metadata/store/".$store->__fileName,
					"app/store/override/".$store->__fileName.".js",
					"app/store/".$store->__fileName.".js"
				);
			
			$orderMap->store[] = $store->__designerId;
			$xds->topInstanceFileMap[$store->__designerId] = $fileMap->toMap();
			
			$key = $store->__designerId;
			$this->expandedState->$key = $store->toArchitect();
			
			file_put_contents(
				$path.PROJECT_PATH.'/metadata/store/'.$store->__fileName,
				json_encode($parseArray , JSON_PRETTY_PRINT )
			);
		}
		/* Save all resources */
		Debug::dump('[save] Save all resources');
		foreach($this->resources as $resource) {
			@mkdir($path.PROJECT_PATH.'/metadata/resource/', 0777, true);
			$parseArray = $resource->toMetaDataArray();
			/* add to xds */
			$fileMap = new FileMap();
				$fileMap->__className	= $resource->__className;
				$fileMap->paths	= array(
					"metadata/resource/".$resource->__fileName
				);
			$orderMap->resource[] = $resource->__designerId;
			$xds->topInstanceFileMap[$resource->__designerId] = $fileMap->toMap();
			
			$key = $resource->__designerId;
			$this->expandedState->$key = $resource->toArchitect();
			
			
			file_put_contents(
				$path.PROJECT_PATH.'/metadata/resource/'.$resource->__fileName, 
				json_encode($parseArray , JSON_PRETTY_PRINT )
			);
		}
		/* Save all views */
		Debug::dump('[save] Save all views');
		foreach($this->application->views as $view) {
			@mkdir($path.PROJECT_PATH.'/metadata/view/', 0777, true);
			$parseArray = $view->toMetaDataArray();
			/* add to xds */
			$fileMap = new FileMap();
				$fileMap->__className	= $view->__className;
				$fileMap->paths	= array(
					"metadata/view/".$view->__fileName
				);
			$orderMap->view[] = $view->__designerId;
			$xds->topInstanceFileMap[$view->__designerId] = $fileMap->toMap();
			
			$key = $view->__designerId;
			$this->expandedState->$key = $view->toArchitect();
			
			
			file_put_contents(
				$path.PROJECT_PATH.'/metadata/view/'.$view->__fileName, 
				json_encode($parseArray , JSON_PRETTY_PRINT )
			);
		}
		/* TODO: save all controllers */
		
		$orderMap->app[] = 'application';
		$xds->viewOrderMap	= $orderMap;
		
		
		$parseArray = $this->application->toMetaDataArray();
		Debug::dump('[save] Save Application');
		file_put_contents(
			$path.PROJECT_PATH.'/metadata/'.$this->application->__fileName, 
			json_encode($parseArray, JSON_PRETTY_PRINT )
		);
				
		/* TODO: edit Parser for this file */
		Debug::dump('[save] Save XDS File');

		$parseArray = $xds->toMetaDataArray();
		file_put_contents(
			$path.PROJECT_PATH.'/'.$xds->__fileName, 
			json_encode($parseArray, JSON_PRETTY_PRINT )
		);
		
		$parseArray = $this->toArray();
		Debug::dump('[save] Save Architect file ');
		file_put_contents(
			$path.PROJECT_PATH.'/.architect', 
			json_encode($parseArray, JSON_PRETTY_PRINT )
		);
	}
	
	public function toArray() {
		return array(
			'expandedState' 	=> $this->expandedState,
			'editMode'			=> $this->editMode,
			'codeState'			=> $this->codeState,
			'inspectorState'	=> $this->inspectorState,
			'canvasState'		=> $this->canvasState,
			'tabState'			=> $this->tabState
		);
	}
	
	public function toJSON() {
	
	}
}

?>