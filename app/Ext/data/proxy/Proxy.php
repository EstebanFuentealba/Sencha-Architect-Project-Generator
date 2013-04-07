<?PHP
namespace Ext\data\proxy;

require_once(dirname(__FILE__).'/../../Base.php');
require_once(dirname(__FILE__).'/../../util/Observable.php');

use Ext\Base as Base;
use Ext\util\Observable as Observable;

class Proxy extends Base implements Observable {

	public $batchActions		= NULL;
	public $batchOrder			= NULL;
	public $model				= NULL;
	public $reader 				= NULL;
	public $writer				= NULL;
	
	public function __construct(){
		parent::__construct();
		$this->__reference = array(
			"name"	=> "proxy",
			"type"	=> "object"
		);
	}
	
	public function toArchitect(){
		$temp = parent::toArchitect();
		if(!is_null($this->reader)){
			$temp["cn"][] = $this->reader->toArchitect();
		}
		if(!is_null($this->writer)){
			$temp["cn"][] = $this->writer->toArchitect();
		}
		if(!is_null($this->model)){
			$temp["cn"][] = $this->model->toArchitect();
		}
		return $temp;
	}
	
}

?>