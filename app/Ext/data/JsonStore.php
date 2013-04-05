<?PHP
namespace Ext\data;

require_once(dirname(__FILE__).'/Store.php');

use Ext\data\Store as Store;

class JsonStore extends Store {

	public function __construct(){
		parent::__construct();
		$this->__type = 'jsonstore';
	}
}

?>