<?PHP
namespace Sencha\Architect\app\controller;
use Ext\Base as Base;
class Action extends Base {

	public $fn			= NULL;
	public $implHandler	= array(
		"/* Action Generated */\r"
	);
	public $name		= NULL;
	public $scope		= "me";
	
	public function __construct(){
		parent::__construct();
		$this->__reference = array(
			"name"	=> "listeners",
			"type"	=> "array"
		);
		$this->__type = 'controlleraction';
		$this->__params = array(
			'target'
		);
	}
	public function toMetaDataArray() {
		$meta = parent::toMetaDataArray();
		$meta['userConfig']['implHandler'] = $this->implHandler;
		return $meta;
	}
	
}
?>