<?PHP
namespace Ext;

require_once(dirname(__FILE__).'/Base.php');

abstract class AbstractPlugin 
	extends Base {

	public $pluginId = NULL;
	
	public function __construct(){
		call_user_func_array(array(
			'parent', 
			'__construct'
		), func_get_args());
	}
	

}

?>