<?PHP
class PHPCodeGenerator {

	public $atttributes = array();
	
	public function __construct() {
		global $tables;
		global $tableConfig;
		
		Mustache_Autoloader::register();
		$m = new Mustache_Engine;
		
		@mkdir(dirname(__FILE__).'/../../../'.PROJECT_PATH.'/libraries/',0755, true);
		@file_put_contents(
			dirname(__FILE__).'/../../../'.PROJECT_PATH.'/libraries/Database.class.php', 
			file_get_contents(dirname(__FILE__).'/../../../libraries/Database.class.php')
		);
		
		$readPHPConfig = file_get_contents(dirname(__FILE__).'/../templates/config.php.template');
		
		file_put_contents(
			dirname(__FILE__).'/../../../'.PROJECT_PATH.'/config.php', 
			"<?PHP\r\n\r\n".$m->render($readPHPConfig,array(
				'databaseServer'	=> DB_SERVER,
				'databaseUser'		=> DB_USER,
				'databasePassword'	=> DB_PASS,
				'databaseName'		=> DB_DATABASE
			))."\r\n\r\n?>"
		);
		
		
		foreach($tables as $tableName => $table){
		
			$arr 		= array();
			$arrAdd 	= array();
			
			
			$arr['table']["tableName"] = $tableName;
			$arr['references']["columns"] = array();
			$index = 0;
			
			foreach($table["columns"] as $columnName => $col){
				if(array_key_exists($columnName, $table['constraints'])){
					$references = array(
						'localColumnName' 		=> $table['constraints'][$columnName]['localColumn'],
						'tableName'				=> $table['constraints'][$columnName]['foreignTable'],
						'referenceColumnName' 	=> $table['constraints'][$columnName]['foreignColumn']
					);
					foreach($tables[$table['constraints'][$columnName]['foreignTable']]['columns'] as $foreignColumn){ 
						if($table['constraints'][$columnName]['foreignColumn'] != $foreignColumn['columnName']){
							$arr["references"]['columns'][] = array(
								'columnName'	=> $foreignColumn['columnName'],
								'tableName'		=> $table['constraints'][$columnName]['foreignTable']
							);
						}
					}
					$arr["references"]['tables'][] = $references;
					
					$arr["table"]["columns"][] = array(
						'columnName'		=> $columnName,
						'isLast'			=> ($index == (count($table["columns"])-1)),
						'isPrimary'			=> $col['isPrimaryKey'],
						'isAutoIncrement'	=> ($col['extra'] == 'auto_increment')
					);
				} else {
					if($col['isPrimaryKey']) {
						$arr["table"]["primaryKey"] 				= $columnName;
						$arr["table"]["primaryKeyIsAutoIncrement"] 	= ($col['extra'] == 'auto_increment');
						$arr['table']["order"][] = array(
							'by'	=> $columnName
						);
					} else{
						if(!$col['nullCol']){
							#TODO
						} else {
							#TODO
						}
					}
					if($col['type'] == 'int') {
						#TODO
					} else if($col['type'] == 'text') {
						#TODO
					} else if($col['type'] == 'enum') {
						#TODO
					} else if($col['type'] == 'timestamp') {
						#TODO
						if(isset($col['default'])){
							
						}
					} else {
						#TODO
					}
					#echo '<pre>';
					#print_r($col);
					#echo '</pre>';
					$arr["table"]["columns"][] = array(
						'columnName'		=> $columnName,
						'isLast'			=> ($index == (count($table["columns"])-1)),
						'isPrimary'			=> $col['isPrimaryKey'],
						'isAutoIncrement'	=> ($col['extra'] == 'auto_increment')
					);
				}
				$index++;
			}
			
			$index = 0;
			foreach($arr['table']["order"] as $order){
				$arr['table']["order"][$index]['isLast'] = ($index == (count($arr['table']["order"])-1));
				$index++;
			}
			
			$index = 0;
			foreach($arr['references']["columns"] as $tbl){
				if($index == 0) {
					$arr['references']["columns"][$index]['isFirst'] = true;
				}
				$arr['references']["columns"][$index]['isLast'] = ($index == (count($arr['references']["columns"])-1));
				$index++;
			}
			
			$readPHP 	= file_get_contents(dirname(__FILE__).'/../templates/read.php.template');
			$addPHP 	= file_get_contents(dirname(__FILE__).'/../templates/add.php.template');
			$updatePHP 	= file_get_contents(dirname(__FILE__).'/../templates/update.php.template');
			$removePHP 	= file_get_contents(dirname(__FILE__).'/../templates/remove.php.template');
			
			$PHPClassName = Utils::getUnionName($tableName, $tableConfig);
			$fileName = dirname(__FILE__).'/../../../'.PROJECT_PATH.'/mantenedor/'.$PHPClassName;
			@mkdir($fileName, 0755, true);
			
			
			@file_put_contents($fileName.'/read.php', "<?PHP\r\n\r\n".$m->render($readPHP,$arr)."\r\n\r\n?>");
			@file_put_contents($fileName.'/add.php', "<?PHP\r\n\r\n".$m->render($addPHP,$arr)."\r\n\r\n?>");
			@file_put_contents($fileName.'/update.php', "<?PHP\r\n\r\n".$m->render($updatePHP,$arr)."\r\n\r\n?>");
			@file_put_contents($fileName.'/remove.php', "<?PHP\r\n\r\n".$m->render($removePHP,$arr)."\r\n\r\n?>");
		}
		
		
	
	}
	public function save(){
		$readPHP = file_get_contents(dirname(__FILE__).'/../templates/read.php.template');
		
		$m = new Mustache_Engine;
		echo '<pre>';
		echo $m->render($readPHP, array(
			'table'	=> array(
				'columns' => array(
					array(
						'columnName' => 'vid'
					),
					array(
						'columnName' => 'title'
					),
					array(
						'columnName' 	=> 'description',
					),
					array(
						'columnName' 	=> 'created_at',
						'isLast'		=> true
					)
				),
				'tableName'	=> 'e3_video',
				'order'		=> array(
					array(
						'by'			=> 'vid',
						'isLast'		=> true
					)
				)
			),
			'references'	=> array(
				'columns'				=> array(
					array(
						'columnName'	=> 'babeName',
						'isLast'		=> true,
						'tableName'		=> 'e3_babe'
					)
				),
				'tables' => array(
					'localColumnName' 		=> 'vid',
					'tableName'				=> 'e3_babe',
					'index'					=> 1,
					'referenceColumnName' 	=> 'vid'
				)
			)
		));
		echo '</pre>';
	}
	
	public function add(){}
	public function remove(){}
	public function update(){}
	public function get(){}
	
}



?>