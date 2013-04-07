<?PHP
namespace Sencha\Architect;

class Parser {

	public function __construct(){

	}
	public function toSenchaArchitectJSON($array = array(), $onlyArray = false, $onlyIdsAndCn = false){
		if(count($array) == 0) {
			/*$array = self::toArray();*/
		}
		$arrayReturn = array();
		
		
		
		
		if($onlyArray) {
			$hiddenField = array(
				'__reference',
				'__fileName',
				'__functions',
				'__events'
			);
			foreach($array as $key => $value) {
				#print_r($value).'<br />';
				if(in_array($key, $hiddenField)) { break; }
				if(is_array($value)){
					#echo '[array] '.$key.'<br />';
					$arrayReturn[$key] = $value;
				} else {
					if(!is_null($value)){
						if(is_object($value)){
							#echo '[object] '.$key.'<br />';
							$arrayReturn[$key] = self::toSenchaArchitectJSON($value->toArray(), true);
						} else {
							#echo '[otro] '.$key.'<br />';
							$arrayReturn[$key] = $value;
						}
					}
				}
			}
			return $arrayReturn;
		} else {
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
		}
		return $arrayReturn;
	}
	
}


?>