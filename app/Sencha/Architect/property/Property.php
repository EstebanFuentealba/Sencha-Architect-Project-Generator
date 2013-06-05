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
		parent::__construct();
	}
}

?>