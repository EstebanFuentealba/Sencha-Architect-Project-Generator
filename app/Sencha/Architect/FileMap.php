<?PHP
namespace Sencha\Architect;

require_once(dirname(__FILE__).'/Base.php');

use Sencha\Architect\Base as Base;

class FileMap extends Base {
	
	public $paths			= array();

	public function __construct(){
		call_user_func_array(array(
			'parent', 
			'__construct'
		), func_get_args());
		unset($this->__type);
		unset($this->__designerId);
		unset($this->__object);
		unset($this->__functions);
		unset($this->__events);
		unset($this->userClassName);
		unset($this->userAlias);
	}
	public function toMap() {
		return array(
			'paths'	=> $this->paths,
			'className'	=> $this->__className
		);
	}
}

?>