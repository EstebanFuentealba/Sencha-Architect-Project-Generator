<?PHP
namespace Ext\toolbar;

require_once(dirname(__FILE__).'/../toolbar/Toolbar.php');

use Ext\toolbar\Toolbar as Toolbar;

class Paging extends Toolbar {

	public $afterPageText	=	NULL;
	public $beforePageText	=	NULL;
	public $displayInfo		=	true;
	public $displayMsg		=	NULL;
	public $emptyMsg		=	NULL;
	public $firstText		=	NULL;
	public $inputItemWidth	=	NULL;
	public $lastText		=	NULL;
	public $nextText		=	NULL;
	public $prependButtons	=	NULL;
	public $prevText		=	NULL;
	public $refreshText		=	NULL;
	public $store			=	NULL;
	
	public function __construct(){
		$this->dock		=	'bottom';
		call_user_func_array(array(
			'parent', 
			'__construct'
		), func_get_args());
		$this->__type 	= 	'pagingtoolbar';
	}
	public function toMetaDataArray() {
		$meta = parent::toMetaDataArray();
		$meta["reference"]["name"] = 'dockedItems';
		return $meta;
	}
}


?>