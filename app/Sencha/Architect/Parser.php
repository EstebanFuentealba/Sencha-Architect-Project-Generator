<?PHP
namespace Sencha\Architect;

class Parser {

	public function __construct(){

	}
	
	public function toSenchaArchitectJSON($array = array()){
		if(count($array) == 0) {
			/*$array = self::toArray();*/
		}
		$arrayReturn = array();
		foreach($array as $key => $value){
			if(is_array($value)){
				if($key === '__reference'){
					$arrayReturn['reference'] = $value;
				} else {
					if(!array_key_exists('cn',  $arrayReturn)){
						if($key == 'models' || $key == 'stores'){
							/* array config */
							$arrayReturn["userConfig"][$key] = $value;
						} else {
							$arrayReturn["cn"] = self::toSenchaArchitectJSON($value);
						}
					} else {
						$arrayReturn["cn"] = array_merge($arrayReturn["cn"], self::toSenchaArchitectJSON($value));
					}
				}
			} else {
				if(!is_null($value)){
					if(is_object($value)){
						$value->__type	= str_replace('\\','.',get_class($value));
						if(!is_numeric($key)){
							$arrayReturn["type"]	= str_replace('\\','.',get_class($value));
							$arrayReturn["cn"] = self::toSenchaArchitectJSON((array)$value);
						} else {
							$arrayReturn[$key] = self::toSenchaArchitectJSON((array)$value);
						}
					} else {
						if(!array_key_exists('codeClass',  $arrayReturn)){
							$arrayReturn["codeClass"]		= 'null';
						}
						if($key == '__type'){
							/* attributes sencha architect object */
							$arrayReturn['type'] = $value;
						} else if($key == '__designerId'){
							$arrayReturn['designerId'] = $value;
						} else {
							if($key == 'userClassName' || $key == 'userAlias'){
								$arrayReturn["userConfig"]['designer|'.$key] = $value;
							} if($key == '__fileName'){
								/* TODO */
							} else {
								$arrayReturn["userConfig"][$key] = $value;
							}
						}
					}
				}
			}
		}
		return $arrayReturn;
	}
	
}


?>