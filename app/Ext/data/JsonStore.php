<?PHP
namespace Ext\data;

require_once(dirname(__FILE__).'/Store.php');

use Ext\data\Store as Store;

class JsonStore extends Store {

	public function __construct(){
		call_user_func_array(array(
			'parent', 
			'__construct'
		), func_get_args());
		$this->__type = 'jsonstore';
	}
}

?>