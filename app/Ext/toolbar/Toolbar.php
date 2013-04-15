<?PHP
namespace Ext\toolbar;

require_once(dirname(__FILE__).'/../container/Container.php');

use Ext\container\Container as Container;

class Toolbar extends Container {

	public $baseCls			=	NULL;
	public $defaultType		=	NULL;
	public $enableOverflow	=	NULL;
	public $layout			=	NULL;
	public $menuTriggerCls	=	NULL;
	public $vertical		=	NULL;
	
	public function __construct(){
		parent::__construct();
		$this->dock	= 'top';
	}
}


?>