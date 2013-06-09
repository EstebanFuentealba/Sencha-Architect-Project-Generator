<?PHP
namespace Ext\form\field;

require_once(dirname(__FILE__).'/Trigger.php');

use Ext\form\field\Trigger as Trigger;

class Spinner extends Trigger {
	
	public $keyNavEnabled	=	NULL;
	public $mouseWheelEnabled	=	NULL;
	public $repeatTriggerClick	=	NULL;
	public $spinDownEnabled	=	NULL;
	public $spinUpEnabled	=	NULL;
	
	public function __construct(){
		call_user_func_array(array(
			'parent', 
			'__construct'
		), func_get_args());
	}
	
	
}


?>