<?PHP
namespace Ext\data\proxy;

require_once(dirname(__FILE__).'/Proxy.php');
require_once(dirname(__FILE__).'/../../util/Observable.php');

use Ext\data\proxy\Proxy as Proxy;
use Ext\util\Observable as Observable;

class Server extends Proxy implements Observable {

	public $api						= NULL;
	public $cacheString				= NULL;
	public $directionParam			= NULL;
	public $extraParams 			= NULL;
	public $filterParam				= NULL;
	public $groupDirectionParam		= NULL;
	public $groupParam				= NULL;
	public $idParam 				= NULL;
	public $limitParam				= NULL;
	public $noCache					= NULL;
	public $pageParam 				= NULL;
	public $simpleGroupMode			= NULL;
	public $simpleSortMode			= NULL;
	public $sortParam				= NULL;
	public $startParam 				= NULL;
	public $timeout					= NULL;
	public $url 					= NULL;
	
	public function __construct(){
		parent::__construct();
	}
}

?>