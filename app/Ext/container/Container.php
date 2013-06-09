<?PHP
namespace Ext\container;

require_once(dirname(__FILE__).'/AbstractContainer.php');

use Ext\container\AbstractContainer as AbstractContainer;

class Container extends AbstractContainer {
	public function __construct(){
		call_user_func_array(array(
			'parent', 
			'__construct'
		), func_get_args());
	}
}

?>