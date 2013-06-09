<?PHP
namespace Ext\view;

require_once(dirname(__FILE__).'/../Component.php');

use Ext\Component as Component;

class AbstractView extends Component {

	public $blockRefresh		=	NULL;
	public $deferEmptyText		=	NULL;
	public $deferInitialRefresh	=	NULL;
	public $disableSelection	=	NULL;
	public $emptyText			=	NULL;
	public $itemCls				=	NULL;
	public $itemSelector		=	NULL;
	public $itemTpl				=	NULL;
	public $loadMask			=	NULL;
	public $loadingCls			=	NULL;
	public $loadingHeight		=	NULL;
	public $loadingText			=	NULL;
	public $overItemCls			=	NULL;
	public $preserveScrollOnRefresh	=	NULL;
	public $selectedItemCls		=	NULL;
	public $store				=	NULL;
	public $tpl					=	NULL;
	public $trackOver			=	NULL;
	
	public function __construct(){
	
		call_user_func_array(array(
			'parent', 
			'__construct'
		), func_get_args());
		
	}
}


?>