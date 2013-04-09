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
		parent::__construct();
	}
	
	
}


?>