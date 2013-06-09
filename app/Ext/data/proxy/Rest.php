<?PHP
namespace Ext\data\proxy;

require_once(dirname(__FILE__).'/Ajax.php');
require_once(dirname(__FILE__).'/../../util/Observable.php');

use Ext\data\proxy\Ajax as Ajax;
use Ext\util\Observable as Observable;

class Rest extends Ajax implements Observable {

	public $appendId		= NULL;
	public $batchActions	= NULL;
	public $format			= NULL;
	
	public function __construct(){
		call_user_func_array(array(
			'parent', 
			'__construct'
		), func_get_args());
	}
}

?>