<?PHP
namespace Sencha\Architect;

require_once(dirname(__FILE__).'/Base.php');

use Sencha\Architect\Base as Base;

class FileMap extends Base {
	
	public $paths			= array();
	public $className		= NULL;

	public function __construct(){
		parent::__construct();
		unset($this->__type);
		unset($this->__designerId);
		unset($this->__object);
		unset($this->__functions);
		unset($this->__events);
		unset($this->userClassName);
		unset($this->userAlias);
	}

}

?>