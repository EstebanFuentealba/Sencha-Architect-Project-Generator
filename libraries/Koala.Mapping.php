<?PHP
require_once(dirname(__FILE__).'/Koala.Mapping.MySQL.php');
class KoalaMapping extends KoalaMappingMySQL  {
	
	function __construct(){}
	
	/*
		Obtiene la estructura de una tabla determinada
		@access public
		@param	string	$table_name Nombre de una tabla
		@return	DBTable	$table		Tabla
		
	*/
	public static function getTable($tableName) {
		$table = array(
			"tableName" => $tableName,
			"columns" => array(),
			"columnsTotal"	=> 0,
			"constraints" => array()
		);
		$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE); 
		$db->connect(); 
			$results = $db->fetch_all_array(sprintf(self::$queryDescribe,$tableName));
		$db->close();
		$table["columnsTotal"] = count($results);
		foreach($results as $row) {
			$column = self::getColumn($row);
			preg_match_all("#(.[a-zA-Z]+)\((.*)\)#", $column["Type"], $matches);
			
			$columnType = array(
				'columnType' => $column["Type"],
				'columnMaxSize' => null
			);
			
			if ((count($matches) == 3) || (count($matches) == 2)) {
				$key = (empty($matches[1][0])) ? $column["Type"] : $matches[1][0];
				$columnType = array(
					'columnType' => $key,
					'columnMaxSize' => ((count($matches) == 3 && !empty($matches[2][0])) ? $matches[2][0] : null),
					'columnValues'	=> false
				);
				if(!empty($matches[2][0]) && !is_numeric($matches[2][0]) ){
					$options = explode(",",str_replace("'","",$matches[2][0]));
					$columnType["columnValues"] = $options;
				}
			}
			$table["columns"][$column["Field"]] = array(
				"columnName" => $column["Field"],
				"type" => $columnType["columnType"],
				"maxSize" => $columnType["columnMaxSize"],
				"nullCol" => ($column["Null"] != 'NO'),
				"isForeignKey" =>  ($column["Key"] == "MUL"),
				"isPrimaryKey" => ($column["Key"] == "PRI"),
				"default" => $column["Default"],
				"extra" => $column["Extra"],
				"columnValues"	=> $columnType["columnValues"]
			);
		}
		
		$table["constraints"] = self::getConstraints($table["tableName"]);
		return $table;
	}
	
	/* 
		Obtiene las "CONSTRAINTS" de una tabla determinada 
		@access public
		@param	string	$table_name 		Nombre de una tabla
		@return	array	$constraints		constraints de la tabla
			
	*/
	public static function getConstraints($tableName){
		$constraints = array();
		$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE); 
		$db->connect(); 
			$results = $db->fetch_all_array(sprintf(self::$queryConstraints,$tableName,DB_DATABASE));
		$db->close();
		if(count($results)>0){
			$constraints = parent::getConstraints($results);
		}
		return $constraints;
	}
	
	/*
		Obtiene todas las tablas
		@access public
		@return	array	$db_tables		arreglo con los nombres de las tablas que hay en la base de datos
	*/
	public static function getTables() {
		$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE); 
		$db->connect();
		
			$results = $db->fetch_all_array(self::$queryShowTables);
		$db->close();
		$tablesRet = array();
		$tables =  parent::getAllTables($results,DB_DATABASE);
		foreach($tables as $tableName){
			$tablesRet[$tableName] = self::getTable($tableName);
		}
		return $tablesRet;
    }
}
?>