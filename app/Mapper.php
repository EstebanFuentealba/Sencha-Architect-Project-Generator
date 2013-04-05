<?PHP
class Mapper extends KoalaGenerator {
	
	public $extColumns = array();
	
	function __construct() {
		parent::__construct();
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