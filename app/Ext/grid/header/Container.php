<?PHP
namespace Ext\grid\header;

require_once(dirname(__FILE__).'/../../container/Container.php');

use Ext\container\Container as Cont;

class Container extends Cont {

	public $baseCls				=	NULL;
	public $border				=	NULL;
	public $defaultType			=	NULL;
	public $defaultWidth		=	NULL;
	public $detachOnRemove		=	NULL;
	public $enableColumnHide	=	NULL;
	public $sealed				=	NULL;
	public $sortable			=	NULL;
	public $weight				=	NULL;
	
	public function __construct(){
		call_user_func_array(array(
			'parent', 
			'__construct'
		), func_get_args());
	}
}


?>