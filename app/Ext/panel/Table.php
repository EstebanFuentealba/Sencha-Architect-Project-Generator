<?PHP
namespace Ext\panel;

require_once(dirname(__FILE__).'/Panel.php');
require_once(dirname(__FILE__).'/../container/DockingContainer.php');

use Ext\panel\Panel as Panel;
use Ext\container\DockingContainer as DockingContainer;

class Table extends Panel implements DockingContainer {

	public $allowDeselect	=	NULL;
	public $columnLines	=	NULL;
	public $columns 		=	array();
	public $deferRowRender	=	NULL;
	public $disableSelection	=	NULL;
	public $emptyText 	=	NULL;
	public $enableColumnHide	=	NULL;
	public $enableColumnMove	=	NULL;
	public $enableColumnResize 	=	NULL;
	public $enableLocking 	=	NULL;
	public $features 	=	NULL;
	public $forceFit 	=	NULL;
	public $hideHeaders 	=	NULL;
	public $layout	=	NULL;
	public $rowLines	=	NULL;
	public $scroll 	=	NULL;
	public $sealedColumns	=	NULL;
	public $selModel 	=	NULL;
	public $selType 	=	NULL;
	public $sortableColumns	=	NULL;
	public $store 	=	NULL;
	public $verticalScroller	=	NULL;
	public $view	=	NULL;
	public $viewConfig 	=	NULL;
	public $viewType	=	NULL;
	
	public function __construct(){
		parent::__construct();
	}
	public function toMetaDataArray() {
		$meta = parent::toMetaDataArray();
		foreach($this->columns as $column) {
			$meta["cn"][] = $column->toMetaDataArray();
		}
		if(!is_null($this->selModel)) {
			$meta['cn'][] = $this->selModel->toMetaDataArray();
		}
		return $meta;
	}
}


?>