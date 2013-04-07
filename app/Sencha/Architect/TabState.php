<?PHP
namespace Sencha\Architect;

require_once(dirname(__FILE__).'/State.php');

use Sencha\Architect\State as State;

class TabState extends State {

	/* Config */
	public $openTabs 			= 	array();
	
	public function __construct(){
		parent::__construct();
		unset($this->topInstance);
	}
	
}

?>