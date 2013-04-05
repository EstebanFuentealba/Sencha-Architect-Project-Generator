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
		parent::__construct();
		unset($this->__type);
		unset($this->__designerId);
		unset($this->__object);
		unset($this->userClassName);
		unset($this->userAlias);
	}

}

?>