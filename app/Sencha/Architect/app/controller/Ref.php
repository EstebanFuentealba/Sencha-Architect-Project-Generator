<?PHP
namespace Sencha\Architect\app\controller;
use Ext\Base as Base;
class Ref extends Base {

	public $ref 		= NULL;
	public $selector 	= NULL;
	public $autoCreate 	= NULL;
	public $forceCreate = NULL;
	public $xtype 		= NULL;
	
	public function __construct(){
		call_user_func_array(array(
			'parent', 
			'__construct'
		), func_get_args());
		$this->__type = 'controllerref';
		$this->__reference = array(
			"name"	=> "items",
			"type"	=> "array"
		);
	}
	
}
?>