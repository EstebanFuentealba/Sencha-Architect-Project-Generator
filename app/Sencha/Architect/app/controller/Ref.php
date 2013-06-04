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
		parent::__construct();
		$this->__type = 'controllerref';
		$this->__reference = array(
			"name"	=> "items",
			"type"	=> "array"
		);
	}
	
}
?>