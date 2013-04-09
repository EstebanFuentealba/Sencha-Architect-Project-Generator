<?PHP
namespace Ext\form\field;

require_once(dirname(__FILE__).'/Text.php');

use Ext\form\field\Text as Text;

class Trigger extends Text {
	
	public $componentLayout	=	NULL;
	public $editable	=	NULL;
	public $hideTrigger	=	NULL;
	public $readOnly	=	NULL;
	public $repeatTriggerClick	=	NULL;
	public $selectOnFocus	=	NULL;
	public $triggerBaseCls	=	NULL;
	public $triggerCls	=	NULL;
	public $triggerNoEditCls	=	NULL;
	public $triggerWrapCls	=	NULL;
	
	public function __construct(){
		parent::__construct();
	}
	
	
}


?>