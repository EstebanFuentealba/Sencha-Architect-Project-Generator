<?PHP
namespace Ext\data;
require_once(dirname(__FILE__).'/../Base.php');

use Ext\Base as Base;

class Field extends Base {

	public $convert				= NULL;
	public $dateFormat			= NULL;
	public $dateReadFormat		= NULL;
	public $dateWriteFormat		= NULL;
	public $defaultValue		= NULL;
	public $mapping				= NULL;
	public $name				= NULL;
	public $persist				= NULL;
	public $serialize			= NULL;
	public $sortDir				= NULL;
	public $sortType			= NULL;
	public $type				= NULL;
	public $useNull				= NULL;
	
	public function __construct(){
		call_user_func_array(array(
			'parent', 
			'__construct'
		), func_get_args());
		
		$this->__reference = array(
			"name"	=> "fields",
			"type"	=> "array"
		);
	}
	public function toArchitect(){
		$temp = parent::toArchitect();
		return $temp;
	}
	public function toArrayDefinition() {
		$definition = parent::toArrayDefinition();
		return $definition;
	}
	public function toMetaDataArray() {
		$meta = parent::toMetaDataArray();
		$meta["reference"]["name"] = 'fields';
		return $meta;
	}
	
}

?>