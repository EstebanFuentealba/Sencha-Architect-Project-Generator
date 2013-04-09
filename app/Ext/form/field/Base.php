<?PHP
namespace Ext\form\field;

require_once(dirname(__FILE__).'/../../Component.php');
require_once(dirname(__FILE__).'/../Labelable.php');
require_once(dirname(__FILE__).'/Field.php');

use Ext\Component as Component;
use Ext\form\Labelable as Labelable;
use Ext\form\field\Field as Field;

class Base extends Component implements Labelable, Field {

	public $baseCls =	NULL;
	public $checkChangeBuffer =	NULL;
	public $checkChangeEvents =	NULL;
	public $componentLayout =	NULL;
	public $dirtyCls =	NULL;
	public $fieldCls =	NULL;
	public $fieldStyle =	NULL;
	public $focusCls =	NULL;
	public $inputAttrTpl =	NULL;
	public $inputId =	NULL;
	public $inputType =	NULL;
	public $invalidText =	NULL;
	public $name =	NULL;
	public $readOnly =	NULL;
	public $readOnlyCls =	NULL;
	public $tabIndex =	NULL;
	public $validateOnBlur =	NULL;
	
	public function __construct(){
		parent::__construct();
	}
	
	
}


?>