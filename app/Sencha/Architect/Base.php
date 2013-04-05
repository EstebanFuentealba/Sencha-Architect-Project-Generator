<?PHP
namespace Sencha\Architect;


class Base {
	
	private $__fileName			= NULL;
	public $userClassName		= NULL;
	public $userAlias			= NULL;
	
	public $__object	= 	NULL;
	
	public function __construct(){
		
		$this->__object	= $this;
		$this->__object->__type	= str_replace('\\','.',get_class($this->__object));
	}
	public function toArray(){
		return (array)$this->__object;
	}
	
}

?>