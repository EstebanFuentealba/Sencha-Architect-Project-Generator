<?PHP
namespace Sencha\Architect;

require_once(dirname(__FILE__).'/Base.php');

use Sencha\Architect\Base as Base;

class OrderMap extends Base {
	
	public $view			= array();
	public $store			= array();
	public $controller		= array();
	public $model			= array();
	public $resource		= array();
	public $app				= array();

	public function __construct(){
		call_user_func_array(array(
			'parent', 
			'__construct'
		), func_get_args());
		unset($this->__type);
		unset($this->__designerId);
		unset($this->__object);
		unset($this->userClassName);
		unset($this->userAlias);
	}
	public function toArray() {
		return array(
			'view'			=> $this->view,
			'store'			=> $this->store,
			'controller'	=> $this->controller,
			'model'			=> $this->model,
			'resource'		=> $this->resource,
			'app'			=> $this->app
		);
	}
}

?>