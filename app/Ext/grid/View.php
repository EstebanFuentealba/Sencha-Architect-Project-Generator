<?PHP
namespace Ext\grid;

require_once(dirname(__FILE__).'/../view/Table.php');

use Ext\view\Table as Table;

class View extends Table {

	public $autoScroll	=	NULL;
	public $stripeRows	=	NULL;
	
	public function __construct(){
	
		call_user_func_array(array(
			'parent', 
			'__construct'
		), func_get_args());
		
	}
	public function toMetaDataArray() {
		$meta = parent::toMetaDataArray();
		$meta["reference"]["name"] = 'viewConfig';
		$meta["reference"]["type"] = 'object';
		return $meta;
	}
	
}


?>