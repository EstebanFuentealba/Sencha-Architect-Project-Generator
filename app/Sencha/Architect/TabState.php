<?PHP
namespace Sencha\Architect;

require_once(dirname(__FILE__).'/State.php');

use Sencha\Architect\State as State;

class TabState extends State {

	/* Config */
	public $openTabs 			= 	array();
	
	public function __construct(){
		call_user_func_array(array(
			'parent', 
			'__construct'
		), func_get_args());
		unset($this->topInstance);
	}
	
}

?>