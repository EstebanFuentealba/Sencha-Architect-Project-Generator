<?PHP
namespace Ext\selection;

require_once(dirname(__FILE__).'/RowModel.php');

use Ext\selection\RowModel as RowModel;

class CheckboxModel extends RowModel  {
	
	public $checkOnly			=	NULL;
	public $checkSelector		=	NULL;
	public $injectCheckbox		=	NULL;
	public $mode				=	NULL;
	public $showHeaderCheckbox	=	NULL;
	
	public function __construct(){
		parent::__construct();
	}
	public function toMetaDataArray() {
		$meta = parent::toMetaDataArray();
		$meta["reference"]["name"] = 'selModel';
		$meta["reference"]["type"] = 'object';
		$meta["codeClass"] = $this->__type;
		return $meta;
	}
}

?>