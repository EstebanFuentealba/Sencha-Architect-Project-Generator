<?PHP
namespace Ext\data\reader;
require_once(dirname(__FILE__).'/../../Base.php');
require_once(dirname(__FILE__).'/../../util/Observable.php');

use Ext\Base as Base;
use Ext\util\Observable as Observable;

class Reader extends Base implements Observable {

	public $idProperty				= NULL;
	public $implicitIncludes		= NULL;
	public $messageProperty			= NULL;
	public $readRecordsOnFailure	= NULL;
	public $root					= NULL;
	public $successProperty			= 'success';
	public $totalProperty			= 'total';
	
	public function __construct(){
		parent::__construct();
		/*$this->__reference = array(
			"name"	=> "reader",
			"type"	=> "object"
		);*/
	}
	public function toMetaDataArray() {
		$meta = parent::toMetaDataArray();
		$meta["reference"]["name"] = 'reader';
		$meta["reference"]["type"] = 'object';
		return $meta;
	}
}

?>