<?PHP
namespace Ext\grid;

require_once(dirname(__FILE__).'/../panel/Table.php');

use Ext\panel\Table as Table;

class Panel extends Table {

	public $columns		=	array();
	public $rowLines	=	NULL;
	public $viewType	=	NULL;
	
	public function __construct(){
		parent::__construct();
		$this->title		= "My Grid Panel";
		$this->height 		= 450;
		$this->dockedItems	= array();
	}
	public function toMetaDataArray() {
		$meta = parent::toMetaDataArray();
		if(count($this->dockedItems)>0){
			foreach($this->dockedItems as $key => $item) {
				$meta['cn'][] = $item->toMetaDataArray();
			}
		}
		if(!is_null($this->selModel)) {
			$meta['cn'][] = $this->selModel->toMetaDataArray();
		}
		return $meta;
	}
}


?>