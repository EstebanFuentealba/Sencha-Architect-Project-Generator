<?PHP
namespace Ext\grid\column;

require_once(dirname(__FILE__).'/../header/Container.php');

use Ext\grid\header\Container as Container;

class Column extends Container {

	public $align		= NULL;
	public $baseCls		= NULL;
	public $columns		= NULL;
	public $componentLayout= NULL;
	public $dataIndex = NULL;
	public $detachOnRemove= NULL;
	public $draggable= NULL;
	public $editRenderer= NULL;
	public $editor = NULL;
	public $emptyCellText= NULL;
	public $groupable= NULL;
	public $hideable = NULL;
	public $lockable = NULL;
	public $locked= NULL;
	public $menuDisabled= NULL;
	public $menuText= NULL;
	public $renderTpl= NULL;
	public $renderer = NULL;
	public $resizable = NULL;
	public $scope= NULL;
	public $sortable= NULL;
	public $stateId= NULL;
	public $tdCls = NULL;
	public $text= NULL;
	public $tooltip= NULL;
	public $tooltipType= NULL;
	
	public function __construct(){
		call_user_func_array(array(
			'parent', 
			'__construct'
		), func_get_args());
	}
	public function toMetaDataArray() {
		$meta = parent::toMetaDataArray();
		$meta["reference"]["name"] = 'columns';
		return $meta;
	}
}


?>