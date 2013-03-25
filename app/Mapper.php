<?PHP
class Mapper extends KoalaGenerator {
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
		return str_replace($info['extension'],$this->_defaultsColumns["extension"], $path);
	}
}
?>