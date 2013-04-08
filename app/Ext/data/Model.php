<?PHP
namespace Ext\data;
require_once(dirname(__FILE__).'/../Base.php');
require_once(dirname(__FILE__).'/../util/Observable.php');

use Ext\Base as Base;
use Ext\util\Observable as Observable;

class Model extends Base implements Observable {

	public $associations		= null;
	public $belongsTo			= null;
	public $clientIdProperty	= null;
	public $defaultProxyType	= null;
	public $fields				= array();
	public $hasMany				= null;
	public $idProperty			= NULL ; /*'id'*/
	public $idgen				= null;
	public $proxy				= null;
	public $validations			= null;	
	
	public function __construct(){
		parent::__construct();
	}
	
	public function addField($field) {
		$this->fields[] = $field;
	}
	
	public function toArchitect(){
		$temp = parent::toArchitect();
		foreach($this->fields as $field) {
			$temp["cn"][] = $field->toArchitect();
		}
		return $temp;
	}

	public function toArrayDefinition() {
		$definition = parent::toArrayDefinition();
		$definition["extend"] = str_replace('\\','.',get_class($this));
		foreach($this->fields as $field) {
			$definition["fields"][] = $field->toArrayDefinition();
		}
		return $definition;
	}
	
	public function toMetaDataArray() {
		$meta = parent::toMetaDataArray();
		foreach($this->fields as $field) {
			$meta["cn"][] = $field->toMetaDataArray();
		}
		return $meta;
	}
}

?>