<?PHP
namespace Sencha;

require_once(dirname(__FILE__).'/Architect/Parser.php');
require_once(dirname(__FILE__).'/XDS.php');


use Sencha\Architect\Parser as Parser;
use Sencha\XDS as XDS;

class Architect {
	/* Config */
	public $application 	= 	NULL;
	public $expandedState	=	NULL;
	public $tabState		= 	NULL;
	public $canvasState		=	NULL;
	public $inspectorState	=	NULL;
	public $codeState		=	NULL;
	public $editMode		= 	'code';
	public $resources		= 	array();
	
	
	public function __construct(){
	}
	public function setApp($app) {
		$this->application = $app;
	}	
	public function save($path){
		$senchaParser = new Parser();
		
		foreach($this->application->models as $model) {
			@mkdir($path.PROJECT_PATH.'/metadata/model/', 0777, true);
			#echo $path.PROJECT_PATH.'/metadata/model/'.$model->userClassName;
			file_put_contents($path.PROJECT_PATH.'/metadata/model/'.$model->__fileName, json_encode($senchaParser->toSenchaArchitectJSON($model->toArray()) , JSON_PRETTY_PRINT ));
		}
		foreach($this->application->stores as $store) {
			@mkdir($path.PROJECT_PATH.'/metadata/store/', 0777, true);
			file_put_contents($path.PROJECT_PATH.'/metadata/store/'.$store->__fileName, json_encode($senchaParser->toSenchaArchitectJSON($store->toArray()) , JSON_PRETTY_PRINT ));
		}
		
		foreach($this->resources as $resource) {
			@mkdir($path.PROJECT_PATH.'/metadata/resource/', 0777, true);
			file_put_contents($path.PROJECT_PATH.'/metadata/resource/'.$resource->__fileName, json_encode($senchaParser->toSenchaArchitectJSON($resource->toArray()) , JSON_PRETTY_PRINT ));
		}
		
		
		file_put_contents($path.PROJECT_PATH.'/metadata/'.$this->application->__fileName, json_encode($senchaParser->toSenchaArchitectJSON($this->application->toArray()) , JSON_PRETTY_PRINT ));
		
		
		
		/* TODO: edit Parser for this file */
		$xds = new XDS();
		file_put_contents($path.PROJECT_PATH.'/'.$xds->__fileName, json_encode($senchaParser->toSenchaArchitectJSON($xds->toArray()), JSON_PRETTY_PRINT ));
	}
}

?>