<?PHP
class ExtJSColumn {

	function __construct($row){
		foreach ($row as $key => $value) {
			$this->$key = $value;
		}
	}
	public function isInt(){
		return in_array($this->type,array(
			'tinyint',
			'smallint',
			'mediumint',
			'int',
			'integer',
			'bigint',
			'numeric'
		));
	}
	public function isBoolean(){
		return in_array($this->type,array(
			'bool',
			'boolean'
		));
	}
	public function isFloat(){
		return in_array($this->type,array(
			'decimal',
			'dec',
			'float',
			'double'
		));
	}
	public function isString(){
		return is_string($this->type);
	}
}
?>