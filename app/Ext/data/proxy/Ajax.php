<?PHP
namespace Ext\data\proxy;

require_once(dirname(__FILE__).'/Server.php');
require_once(dirname(__FILE__).'/../../util/Observable.php');

use Ext\data\proxy\Server as Server;
use Ext\util\Observable as Observable;

class Ajax extends Server implements Observable {

	public $binary		= NULL;
	public $headers 	= NULL;
	
	public function __construct(){
		parent::__construct();
	}
}

?>