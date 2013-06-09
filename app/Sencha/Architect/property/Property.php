<?PHP
namespace Sencha\Architect\property;
use Sencha\Architect\Base as Base;
class Property extends Base {

	public $group				= "(Custom Properties)";
	public $name				=	NULL;
	public $type				= "string";
	public $value				= 	NULL;
	public $configAlternates	=	NULL;
	
	public function __construct(){
		call_user_func_array(array(
			'parent', 
			'__construct'
		), func_get_args());
	}
}

?>