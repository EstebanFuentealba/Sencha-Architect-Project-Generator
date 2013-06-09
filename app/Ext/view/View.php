<?PHP
namespace Ext\view;

require_once(dirname(__FILE__).'/AbstractView.php');

use Ext\view\AbstractView as AbstractView;

class View extends AbstractView {

	public $mouseOverOutBuffer		=	NULL;
	
	public function __construct(){
	
		call_user_func_array(array(
			'parent', 
			'__construct'
		), func_get_args());
		
	}
}


?>