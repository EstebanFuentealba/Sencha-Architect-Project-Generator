<?PHP

namespace Ext;

require_once(dirname(__FILE__).'/../Sencha/Architect/Base.php');

use Sencha\Architect\Base as BaseArchitect;

class Base extends BaseArchitect {

	public $class 			= NULL;
	public $className		= NULL;
	public $__designerId	= NULL;
	
	public $__reference		= array(
		"name"	=> "items",
        "type"	=> "array"
	);
	
	
	public function __construct(){
		call_user_func_array(array(
			'parent', 
			'__construct'
		), func_get_args());
		
		$this->__designerId = self::newGUID();
	}
	
	public function addMembers(){}
	public function addStatics(){}
	public function create(){}
	public function createAlias(){}
	public function getInitialConfig(){}
	public function getName(){}	
	
	/* Ext Code Generator Methods */
	
	public function toArray() {
		return (array)$this;
	}
	public function toJSON() {
		return json_encode($this->toArray(), JSON_PRETTY_PRINT);
	}
	
	public  static function newGUID(){
		return str_replace(array('{','}'),'',com_create_guid());
	}
}

?>