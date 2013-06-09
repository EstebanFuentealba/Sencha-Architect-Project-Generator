<?PHP
namespace Ext\selection;

require_once(dirname(__FILE__).'/Model.php');

use Ext\selection\Model as Model;

class RowModel  extends Model {
	
	public $enableKeyNav				=	NULL;
	public $ignoreRightMouseSelection	=	NULL;
	
	public function __construct(){
		call_user_func_array(array(
			'parent', 
			'__construct'
		), func_get_args());
	}
	
}

?>