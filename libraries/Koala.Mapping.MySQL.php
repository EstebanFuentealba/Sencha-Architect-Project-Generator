<?PHP
class KoalaMappingMySQL {
	public static $version = "5.5.x";
	/* 	@params:
			%1 = tableName */
	public static $queryDescribe = <<<EOT
	DESC %1\$s; 
EOT;
	public static $queryShowTables = "SHOW TABLES";
	/*	@params
			%1 = tableName
			%2 = dataBase	*/
	public static $queryConstraints = <<<EOT
	SELECT 	K.constraint_name,
			K.table_name 	AS 'local_table',
			K.column_name 	AS 'local_column',
			K.referenced_table_name		AS	'foreign_table',
            K.referenced_column_name	AS	'foreign_column',
            RC.update_rule,
            RC.delete_rule,
            RC.unique_constraint_name 
    FROM 	information_schema.referential_constraints RC 
    INNER JOIN information_schema.key_column_usage K 
    ON K.constraint_name = RC.constraint_name 
    WHERE 	K.table_name = '%1\$s' 
    AND	RC.constraint_schema='%2\$s';
EOT;

	public static function getAllTables($results,$database) {
		$r=array();
		$s="Tables_in_".$database;
		foreach($results as $row) {
			$r[] = $row[$s];
		}
		return $r;
	}
	
	public static function getColumn($row_data) {
		return $row_data;
	}
	
	public static function getConstraints($results) {
		$r = array();
		foreach($results as $row) {
			$r[] = array(
				"constraintName"=> $row["constraint_name"],
				"localColumn" => $row["local_column"],
				"foreignColumn" => $row["foreign_column"],
				"foreignTable" => $row["foreign_table"],
				"onDeleteCascade" => $row["update_rule"],
				"onUpdateCascade" => $row["delete_rule"]
			);
		}
		return $r;
	}

}

?>