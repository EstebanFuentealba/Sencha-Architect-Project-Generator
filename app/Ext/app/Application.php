<?PHP
namespace Ext\app;

require_once(dirname(__FILE__).'/Controller.php');

use Ext\app\Controller as Controller;

class Application extends Controller {

	public $appFolder 			= 'app';
	public $appProperty			= 'app';
	public $autoCreateViewport 	= false;
	public $controllers 		= array();
	public $enableQuickTips		= true;
	public $name				= 'MyApp';
	public $namespaces			= NULL;
	public $paths				= NULL;
	public $scope				= NULL;
	
	public function __construct(){
		parent::__construct();
		$this->__designerId 	= 'application';
		$this->__fileName 		= 'Application';
		$this->__type 			= 'Ext.app.Application';
	}
	public function toArray() {
		
		$temp 		= (array)$this;
		$tempArr 	= $this;
		
		unset($temp['controllers']);
		unset($temp['models']);
		unset($temp['stores']);
		unset($temp['views']);
		
		
		if(count($tempArr->controllers)>0){
			foreach($tempArr->controllers as $controller){
				$temp['controllers'][] = $controller->userClassName;
			}
		}
		if(count($tempArr->models)>0){
			foreach($tempArr->models as $model){
				$temp['models'][] = $model->userClassName;
			}
		}
		if(count($tempArr->stores)>0){
			foreach($tempArr->stores as $store){
				$temp['stores'][] = $store->userClassName;
			}
		}
		if(count($tempArr->views)>0){
			foreach($tempArr->views as $view){
				$temp['views'][] = $view->userClassName;
			}
		}
		return $temp;
	}
}

?>