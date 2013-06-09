<?PHP
namespace Ext\app;

require_once(dirname(__FILE__).'/../Base.php');

use Ext\Base as Base;

class Controller extends Base  {

	public $id		= NULL;
	public $models	= array();
	public $refs 	= array();
	public $stores	= array();
	public $views	= array();
	
	# Sencha Architect Attribute
	public $actions = array();
	
	public function __construct(){
		call_user_func_array(array(
			'parent', 
			'__construct'
		), func_get_args());
		$this->__reference = array(
			"name"	=> "items",
			"type"	=> "array"
		);
	}
	
	public function toMetaDataArray() {
		$meta = parent::toMetaDataArray();
		foreach($this->actions as $action) {
			$meta["cn"][] = $action->toMetaDataArray();
		}
		foreach($this->refs as $ref) {
			$meta["cn"][] = $ref->toMetaDataArray();
		}
		return $meta;
	}
}

?>