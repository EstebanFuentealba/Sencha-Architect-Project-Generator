<?PHP
namespace Ext\resource;

require_once(dirname(__FILE__).'/../Base.php');

use Ext\Base as Base;

class LibraryResource extends Base {

	public $debug 		= 	NULL;
	public $includeCss	=	NULL;
	public $includeJs	=	NULL;
	public $basePath	=	NULL;
	#http://cdn.sencha.com/ext/gpl/4.2.0/
	public $theme		= 	NULL; /* gray, classic, access, neptune */
	
	public function __construct(){
		$this->className	= 'Library';
		call_user_func_array(array(
			'parent', 
			'__construct'
		), func_get_args());
		$this->__type 		= 'libraryresource';
		$this->__fileName	= 'Library';
	}
	
}

?>