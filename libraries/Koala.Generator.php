<?PHP
class KoalaGenerator {
	
	public $tables;
	public $raw = array();
	public $templates = array();
	public $typeMapping = array(
		"[m]" /* Multi File */ ,
		"[s]" /* Single File */
	);
	
	function __construct(){
		Mustache_Autoloader::register();
		$this->tables = KoalaMapping::getTables();
		foreach($this->tables as $tableName){
			/* obtengo la información (estructura) de cada tabla*/
			$this->raw[] = KoalaMapping::getTable($tableName);
		}
		$this->templates = $this->loadTemplates(dirname(__FILE__)."/../".TEMPLATES);
	}
	public function loadTemplates($directory,$exempt = array('.','..'),&$files = array()) { 
        
		$handle = opendir($directory); 
        while(false !== ($resource = readdir($handle))) { 
            if(!in_array(strtolower($resource),$exempt)) {
                if(is_dir($directory.$resource)) {
                    array_merge($files, self::loadTemplates($directory.$resource.'/',$exempt,$files)); 
                } else {
					$info = pathinfo( $directory.$resource);
					//if($info['extension'] == "mustache") {
						$files[] = $directory.$resource; 
					//}
				}
            }
			
        } 
        closedir($handle); 
        return $files; 
    }
	public static function newGUID(){
		return str_replace(array('{','}'),'',com_create_guid());
	}
}

?>