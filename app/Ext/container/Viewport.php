<?PHP
namespace Ext\container;

require_once(dirname(__FILE__).'/Container.php');

use Ext\container\Container as Container;

class Viewport extends Container {
	public function __construct(){
		call_user_func_array(array(
			'parent', 
			'__construct'
		), func_get_args());
	}
}

?>