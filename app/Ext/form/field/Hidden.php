<?PHP
namespace Ext\form\field;

require_once(dirname(__FILE__).'/Base.php');

use Ext\form\field\Base as Base;

class Hidden extends Base {
	
	public $hideLabel	=	NULL;
	public $inputType	=	NULL;
	
	public function __construct(){
		parent::__construct();
	}
	
	
}


?>