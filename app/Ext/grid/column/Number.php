<?PHP
namespace Ext\grid\column;

require_once(dirname(__FILE__).'/Column.php');

use Ext\grid\column\Column as Column;

class Number extends Column {

	public $format	= NULL;
	
	public function __construct(){
		call_user_func_array(array(
			'parent', 
			'__construct'
		), func_get_args());
	}
}


?>