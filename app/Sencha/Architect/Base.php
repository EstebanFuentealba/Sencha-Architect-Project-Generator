<?PHP
namespace Sencha\Architect;


class Base {
	
	private $__fileName			= NULL;
	public $__functions			= array();
	public $__events			= array();
	public $userClassName		= NULL;
	public $userAlias			= NULL;
	
	
	public $__object	= 	NULL;
	
	public function __construct(){
		
		$this->__object	= $this;
		$this->__object->__type	= str_replace('\\','.',get_class($this->__object));
	}
	public function toArray(){
		#return (array)$this->__object;
		return (array)$this;
	}
	public function toArchitect(){
		$temp = array(
			'id'	=> $this->__designerId
		);
		if(count($this->__functions)>0){
			/*TODO*/
			foreach($this->__functions as $fn){
				$temp["cn"]	= array(
					'id'	=> $fn->__designerId
				);
			}
		}
		return $temp;
	}
	
	public function toArrayDefinition(){
		$definition = array();
		foreach($this as $key => $value) {
			if(!is_null($value)){
				if(!is_object($value) && !is_array($value)) {
					if(!preg_match("/^__(.*)$/", $key)){
						/* NO private attributes */
						$definition[$key] = $value;
					}
				}
			}
		}
		return $definition;
	}
	
}

?>