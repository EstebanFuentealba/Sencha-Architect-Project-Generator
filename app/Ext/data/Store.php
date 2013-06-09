<?PHP
namespace Ext\data;
require_once(dirname(__FILE__).'/AbstractStore.php');
class Store extends AbstractStore {
	
	public $autoDestroy	=	NULL;
	public $buffered	=	NULL;
	public $clearOnPageLoad	=	NULL;
	public $clearRemovedOnLoad	=	NULL;
	public $data	=	NULL;
	public $groupDir	=	NULL;
	public $groupField	=	NULL;
	public $groupers	=	NULL;
	public $leadingBufferZone	=	NULL;
	public $pageSize	=	NULL;
	public $proxy 	=	NULL;
	public $purgePageCount	=	NULL;
	public $remoteFilter	=	NULL;
	public $remoteGroup	=	NULL;
	public $remoteSort	=	NULL;
	public $sortOnFilter	=	NULL;
	public $trailingBufferZone	=	NULL;
	
	
	public function __construct(){
		call_user_func_array(array(
			'parent', 
			'__construct'
		), func_get_args());
	}
}

?>