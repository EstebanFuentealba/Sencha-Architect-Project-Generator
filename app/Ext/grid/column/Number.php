<?PHP
namespace Ext\grid\column;

require_once(dirname(__FILE__).'/Column.php');

use Ext\grid\column\Column as Column;

class Number extends Column {

	public $format	= NULL;
	
	public function __construct(){
		parent::__construct();
	}
}


?>