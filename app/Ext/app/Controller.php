<?PHP
namespace Ext\app;

require_once(dirname(__FILE__).'/../Base.php');

use Ext\Base as Base;

class Controller extends Base  {

	public $id		= NULL;
	public $models	= array();
	public $refs 	= NULL;
	public $stores	= array();
	public $views	= array();
	
	public function __construct(){
		parent::__construct();
	}
	
}

?>