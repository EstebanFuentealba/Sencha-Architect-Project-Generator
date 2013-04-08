<?PHP
namespace Ext\data;

require_once(dirname(__FILE__).'/../Base.php');
require_once(dirname(__FILE__).'/../util/Observable.php');
require_once(dirname(__FILE__).'/../util/Sortable.php');

use Ext\Base as Base;
use Ext\util\Observable as Observable;
use Ext\util\Sortable as Sortable;

abstract class AbstractStore extends Base implements Observable, Sortable {

	public 	$autoLoad 				= false;
	public	$autoSync				= false;
	public 	$batchUpdateMode		= NULL;
	public 	$defaultSortDirection	= NULL;
	public 	$fields					= NULL;
	public 	$filterOnLoad			= NULL;
	public 	$filters				= NULL;
	public 	$model					= NULL;
	public 	$proxy					= NULL;
	public 	$remoteFilter			= NULL;
	public 	$remoteSort				= NULL;
	public 	$sortOnLoad				= NULL;
	public 	$statefulFilters		= NULL;
	public 	$storeId				= NULL;
	
	public function __construct(){
		parent::__construct();
	}
	
	public function toArchitect(){
		$temp = parent::toArchitect();
		if(is_array($this->fields)){
			foreach($this->fields as $field) {
				$temp["cn"][] = $field->toArchitect();
			}
		}
		/*
		if(!is_null($this->model)){
			$temp["cn"][] = $this->model->toArchitect();
		}*/
		if(!is_null($this->proxy)){
			$temp["cn"][] = $this->proxy->toArchitect();
		}
		return $temp;
	}
	public function toMetaDataArray() {
		$meta = parent::toMetaDataArray();
		if(!is_null($this->proxy)){
			$meta["cn"][] = $this->proxy->toMetaDataArray();
		}
		return $meta;
	}
}

?>