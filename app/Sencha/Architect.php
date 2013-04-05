<?PHP
namespace Sencha;

require_once(dirname(__FILE__).'/Architect/Parser.php');
require_once(dirname(__FILE__).'/XDS.php');
require_once(dirname(__FILE__).'/Architect/FileMap.php');
require_once(dirname(__FILE__).'/Architect/OrderMap.php');
require_once(dirname(__FILE__).'/Architect/ExpandedState.php');

use Sencha\Architect\Parser as Parser;
use Sencha\XDS as XDS;
use Sencha\Architect\FileMap as FileMap;
use Sencha\Architect\OrderMap as OrderMap;
use Sencha\Architect\ExpandedState as ExpandedState;

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
	}	
	public function save($path){
		$senchaParser = new Parser();
		
		##
		##	Save as Sencha Architect Project (ExtJS 4.2)
		##
		$xds = new XDS();
		$orderMap = new OrderMap();
		/* Save all models */
		foreach($this->application->models as $model) {
			@mkdir($path.PROJECT_PATH.'/metadata/model/', 0777, true);
			$parseArray = $senchaParser->toSenchaArchitectJSON($model->toArray());
			
			/* add to xds */
			$fileMap = new FileMap();
				$fileMap->className	= $model->className;
				$fileMap->paths	= array(
					"metadata/model/".$model->__fileName,
					"app/model/override/".$model->__fileName.".js",
					"app/model/".$model->__fileName.".js"
				);
			
			$orderMap->model[] = $model->__designerId;
			
			$xds->topInstanceFileMap[$model->__designerId] = $fileMap;
			
			
			
			$cnModel = $senchaParser->toSenchaArchitectJSON($model->toArray());
			$key = $model->__designerId;
			$this->expandedState->$key = array(
				'id' 	=> $model->__designerId,
				'cn'	=> $cnModel["cn"]
			);
			
			file_put_contents(
				$path.PROJECT_PATH.'/metadata/model/'.$model->__fileName, 
				json_encode($parseArray , JSON_PRETTY_PRINT )
			);
		}
		/* Save all stores */
		foreach($this->application->stores as $store) {
			@mkdir($path.PROJECT_PATH.'/metadata/store/', 0777, true);
			$parseArray = $senchaParser->toSenchaArchitectJSON($store->toArray());
			
			/* add to xds */
			$fileMap = new FileMap();
				$fileMap->className	= $store->className;
				$fileMap->paths	= array(
					"metadata/store/".$store->__fileName,
					"app/store/override/".$store->__fileName.".js",
					"app/store/".$store->__fileName.".js"
				);
			
			$orderMap->store[] = $store->__designerId;
			$xds->topInstanceFileMap[$store->__designerId] = $fileMap;
			
			
			file_put_contents(
				$path.PROJECT_PATH.'/metadata/store/'.$store->__fileName,
				json_encode($parseArray , JSON_PRETTY_PRINT )
			);
		}
		/* Save all resources */
		foreach($this->resources as $resource) {
			@mkdir($path.PROJECT_PATH.'/metadata/resource/', 0777, true);
			$parseArray = $senchaParser->toSenchaArchitectJSON($resource->toArray());
			
			/* add to xds */
			$fileMap = new FileMap();
				$fileMap->className	= $resource->className;
				$fileMap->paths	= array(
					"metadata/resource/".$resource->__fileName
				);
			$orderMap->resource[] = $resource->__designerId;
			$xds->topInstanceFileMap[$resource->__designerId] = $fileMap;
			
			
			file_put_contents(
				$path.PROJECT_PATH.'/metadata/resource/'.$resource->__fileName, 
				json_encode($parseArray , JSON_PRETTY_PRINT )
			);
		}
		/* TODO: save all controllers and views */
		
		$xds->viewOrderMap	= $orderMap;
		
		
		/* */
		$parseArray = $senchaParser->toSenchaArchitectJSON($this->application->toArray());
		file_put_contents(
			$path.PROJECT_PATH.'/metadata/'.$this->application->__fileName, 
			json_encode($parseArray, JSON_PRETTY_PRINT )
		);
				
		/* TODO: edit Parser for this file */
		$parseArray = $senchaParser->toSenchaArchitectJSON($xds->toArray(), true);
		file_put_contents(
			$path.PROJECT_PATH.'/'.$xds->__fileName, 
			json_encode($parseArray, JSON_PRETTY_PRINT )
		);
		
		/*
		$parseArray = $senchaParser->toSenchaArchitectJSON((array)$this, true);
		file_put_contents(
			$path.PROJECT_PATH.'/.architect', 
			json_encode($parseArray, JSON_PRETTY_PRINT )
		);
		*/
		print_r($this->toArray());
	}
	
	public function toArray() {
		return $this->expandedState;
	}
}

?>