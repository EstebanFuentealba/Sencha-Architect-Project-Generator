<?PHP
namespace Ext\selection;

require_once(dirname(__FILE__).'/../Base.php');
require_once(dirname(__FILE__).'/../util/Observable.php');
require_once(dirname(__FILE__).'/../util/Bindable.php');

use Ext\util\Observable as Observable;
use Ext\util\Bindable as Bindable;
use Ext\Base as Base;

abstract class Model extends Base	implements Observable , Bindable {
	
	public $allowDeselect	=	NULL;
	public $mode				=	NULL;
	public $pruneRemoved		=	NULL;
	
	public function __construct(){
		call_user_func_array(array(
			'parent', 
			'__construct'
		), func_get_args());
	}
	
}

?>