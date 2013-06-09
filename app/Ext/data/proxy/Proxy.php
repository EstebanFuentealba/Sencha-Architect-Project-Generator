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
		call_user_func_array(array(
			'parent', 
			'__construct'
		), func_get_args());
		
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
	public function toMetaDataArray() {
		$meta = parent::toMetaDataArray();
		$meta["reference"]["name"] = 'proxy';
		$meta["reference"]["type"] = 'object';
		if(!is_null($this->reader)){
			$meta["cn"][] = $this->reader->toMetaDataArray();
		}
		if(!is_null($this->writer)){
			$meta["cn"][] = $this->writer->toMetaDataArray();
		}
		if(!is_null($this->model)){
			$meta["cn"][] = $this->model->toMetaDataArray();
		}
		return $meta;
	}
	
}

?>