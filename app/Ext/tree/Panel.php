<?PHP
namespace Ext\tree;

require_once(dirname(__FILE__).'/../panel/Table.php');

use Ext\panel\Table as Table;

class Panel extends Table {

	public $animate			= NULL;
	public $deferRowRender	= NULL;
	public $displayField	= NULL;
	public $folderSort		= NULL;
	public $hideHeaders		= NULL;
	public $lines			= NULL;
	public $root			= NULL;
	public $rootVisible 	= NULL;
	public $rowLines		= NULL;
	public $selType			= NULL;
	public $singleExpand	= NULL;
	public $store			= NULL;
	public $useArrows		= NULL;
	
	public function __construct(){
		call_user_func_array(array(
			'parent', 
			'__construct'
		), func_get_args());
		
		$this->__reference = array(
			"name"	=> "viewConfig",
			"type"	=> "object"
		);
	}
}


?>