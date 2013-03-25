<?PHP
class Mapper extends KoalaGenerator {
	public $_defaultConfig = array(
		'defaultView' => 'KoalaView'
	);
	private $_defaultsColumns = array(
		"package" => "MyApp",
		"extension"	=> "js"
	);
	public $extColumns = array();
	
	function __construct() {
		parent::__construct();
		$tableIndex = 0;
		foreach($this->raw as $tableName => $table){
			$columnIndex = 0;
			foreach($table["columns"] as $column) {
				/* Add column Info */
				$this->raw[$tableIndex]["columns"][$columnIndex]["columnIdx"] 		= $columnIndex+1;
				$this->raw[$tableIndex]["columns"][$columnIndex]["isLessThanTotal"]	= ($table["columnsTotal"] > $columnIndex+1);
				$this->raw[$tableIndex] = array_merge($this->_defaultsColumns, $this->raw[$tableIndex]);
				$this->raw[$tableIndex]["columns"][$columnIndex] = new ExtJSColumn($this->raw[$tableIndex]["columns"][$columnIndex]);
				$columnIndex++;
			}
			$tableIndex++;
		}
	}
	
	public function getFileName($fileName, $templatePath) {
		$tmpl = str_replace(TEMPLATES,'',strstr($templatePath, TEMPLATES));
		$m = new Mustache_Engine;
		$path = $m->render($tmpl, array(
			"fileName"	=> $fileName
		));
		$info = pathinfo($path);
		$meta = substr($info["basename"], 0,3);
		
		if(in_array($meta ,$this->typeMapping)) {
			return array(
				"typeMapping" => str_replace(array("[","]") , array("",""), $meta),
				"fileNamePath" => str_replace($meta, '',str_replace($info['extension'],$this->_defaultsColumns["extension"], $path))
			);
		} else {
			return str_replace($info['extension'],$this->_defaultsColumns["extension"], $path);
		}

	}
}
?>