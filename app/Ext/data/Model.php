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
	public $idProperty			= 'id';
	public $idgen				= null;
	public $proxy				= null;
	public $validations			= null;	
	
	public function __construct(){
		parent::__construct();
	}
	
	public function addField($field) {
		$this->fields[] = $field;
	}
	
}

?>