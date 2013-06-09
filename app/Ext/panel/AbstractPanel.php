<?PHP
namespace Ext\panel;

require_once(dirname(__FILE__).'/../container/Container.php');

use Ext\container\Container as Container;

abstract class AbstractPanel extends Container {
	
	public $baseCls	= NULL;
	public $bodyBorder	= NULL;
	public $bodyCls	= NULL;
	public $bodyPadding	= NULL;
	public $bodyStyle	= NULL;
	public $border 	= NULL;
	public $componentLayout	= NULL;
	public $dockedItems	= NULL;
	public $renderTpl 	= NULL;
	public $shrinkWrapDock	= NULL;

	public function __construct(){
		call_user_func_array(array(
			'parent', 
			'__construct'
		), func_get_args());
	}
}

?>