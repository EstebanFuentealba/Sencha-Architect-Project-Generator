<?PHP
namespace Ext\form\field;

require_once(dirname(__FILE__).'/Trigger.php');

use Ext\form\field\Trigger as Trigger;

class Picker extends Trigger {
	
	public $editable		=	NULL;
	public $matchFieldWidth	=	NULL;
	public $openCls			=	NULL;
	public $pickerAlign		=	NULL;
	public $pickerOffset	=	NULL;
	
	public function __construct(){
		parent::__construct();
	}
	
	
}


?>