<?PHP
namespace Ext\resource;

require_once(dirname(__FILE__).'/../Base.php');

use Ext\Base as Base;

class LibraryResource extends Base {

	
	public function __construct(){
		parent::__construct();
		$this->__type 		= 'libraryresource';
		$this->__fileName	= 'Library';
	}
	
}

?>