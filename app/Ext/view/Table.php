<?PHP
namespace Ext\view;

require_once(dirname(__FILE__).'/View.php');

use Ext\view\View as View;

class Table extends View {

	public $baseCls				=	NULL;
	public $componentLayout		=	NULL;
	public $enableTextSelection	=	NULL;
	public $firstCls			=	NULL;
	public $itemSelector		=	NULL;
	public $lastCls				=	NULL;
	public $markDirty			=	NULL;
	public $overItemCls			=	NULL;
	public $selectedItemCls		=	NULL;
	public $stripeRows			=	NULL;
	public $trackOver			=	NULL;
	
	public function __construct(){
	
		call_user_func_array(array(
			'parent', 
			'__construct'
		), func_get_args());
		
	}
}


?>