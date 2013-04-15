<?PHP
namespace Ext\selection;

require_once(dirname(__FILE__).'/Model.php');

use Ext\selection\Model as Model;

class RowModel  extends Model {
	
	public $enableKeyNav				=	NULL;
	public $ignoreRightMouseSelection	=	NULL;
	
	public function __construct(){
		parent::__construct();
	}
	
}

?>