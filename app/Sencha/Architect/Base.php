<?PHP
namespace Sencha\Architect;


class Base {
	
	private $__fileName			= NULL;
	public $__functions			= array();
	public $__events			= array();
	public $__userClassName		= NULL;
	public $__userAlias			= NULL;
	public $__displayName		= NULL;
	public $__createAlias		= NULL;
	public $__type				= NULL;
	public $__className			= NULL;
	public $__columnWidth		= NULL;
	public $__object			= NULL;
	public $__params			= NULL;
	public $__controlQuery		= NULL;
	
	public function __construct(){
		$this->__object	= $this;
		$this->__object->__type	= str_replace('\\','.',get_class($this->__object));
		$this->__type	= str_replace('\\','.',get_class($this));
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
	public function toMetaDataArray() {
		
		$meta = array();
		
		$meta["type"] = $this->__type;
		$meta["reference"] = array(
			"name" => "items",
			"type" => "array"
        );
		$meta["codeClass"] = null;
		if(!is_null($this->__userClassName)) {
			$meta["userConfig"]["designer|userClassName"] = $this->__userClassName;
		}
		if(!is_null($this->__className)) {
			$meta["userConfig"]["designer|className"] = $this->__className;
		}
		if(!is_null($this->__params)) {
			$meta["userConfig"]["designer|params"] = $this->__params;
		}
		if(!is_null($this->__controlQuery)) {
			$meta["userConfig"]["designer|controlQuery"] = $this->__controlQuery;
		}
		if(!is_null($this->__displayName)) {
			$meta["userConfig"]["designer|displayName"] = $this->__displayName;
		}
		if(!is_null($this->__createAlias)) {
			$meta["userConfig"]["designer|createAlias"] = $this->__createAlias;
		}
		if(!is_null($this->__columnWidth)){
			$meta["userConfig"]["layout|columnWidth"] = $this->__columnWidth;
		}
		foreach($this as $key => $value) {
			if(!is_null($value)){
				if(!is_object($value) && !is_array($value)) {
					if(!preg_match("/^__(.*)$/", $key)){
						/* NO private attributes */
						$meta["userConfig"][$key] = $value;
					} 
				}
			}
		}
		$meta["designerId"] = $this->__designerId;
		return $meta;
	}
	
}

?>