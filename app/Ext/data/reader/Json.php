<?PHP
namespace Ext\data\reader;

require_once(dirname(__FILE__).'/Reader.php');
require_once(dirname(__FILE__).'/../../util/Observable.php');

use Ext\data\reader\Reader as Reader;
use Ext\util\Observable as Observable;

class Json extends Reader implements Observable {

	public $metaProperty		= NULL;
	public $record 				= NULL;
	public $root				= NULL;
	public $useSimpleAccessors	= NULL;
	
	public function __construct(){
		call_user_func_array(array(
			'parent', 
			'__construct'
		), func_get_args());
		
	}
}

?>