<?PHP
class Mapper extends KoalaGenerator {
	public $_defaultConfig = array(
		'package'		=> 'MyApp',
		'defaultView' 	=> 'TestView',
		'projectName'	=> 'myproject' /*  [a-zA-Z0-9_] */
	);
	public $extColumns = array();
	
	function __construct() {
		parent::__construct();
		
		$this->_defaultConfig['guid'] = KoalaGenerator::newGUID();
		$this->_defaultConfig['libraryGUID'] = KoalaGenerator::newGUID();
		
		$tableIndex = 0;
		foreach($this->raw as $tableName => $table){
			$columnIndex = 0;
			$this->raw[$tableIndex]["tableIdx"] 		= $tableIndex+1;
			$this->raw[$tableIndex]["isLessThanTotal"]	= (count($this->raw) > $tableIndex+1);
			//$this->raw[$tableIndex]["designerId"] = KoalaGenerator::newGUID();
			$this->raw[$tableIndex]["className"] = Utils::getUnionName($table['tableName'],false);
			foreach($table["columns"] as $column) {
				/* Add column Info */
				$this->raw[$tableIndex]["columns"][$columnIndex]["columnIdx"] 		= $columnIndex+1;
				$this->raw[$tableIndex]["columns"][$columnIndex]["designerId"] 		= KoalaGenerator::newGUID();
				$this->raw[$tableIndex]["columns"][$columnIndex]["isLessThanTotal"]	= ($table["columnsTotal"] > $columnIndex+1);
				//$this->raw[$tableIndex]["columns"][$columnIndex]["designerId"] 		= KoalaGenerator::newGUID();
				
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
				"fileNamePath" => str_replace($meta, '',$path)
			);
		} else {
			return  $path;
		}

	}
}
?>