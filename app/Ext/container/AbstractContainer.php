<?PHP
namespace Ext\container;

require_once(dirname(__FILE__).'/../Component.php');
require_once(dirname(__FILE__).'/../util/Floating.php');

use Ext\Component as Component;
use Ext\util\Animate as Animate;
use Ext\util\ElementContainer as ElementContainer;
use Ext\util\Floating as Floating;
use Ext\util\Observable as Observable;
use Ext\util\Positionable as Positionable;
use Ext\util\Renderable as Renderable;
use Ext\state\Stateful as Stateful;

abstract class AbstractContainer 
	extends Component 
	implements Stateful, Animate , ElementContainer,Floating, Positionable, Renderable {
	
	public $activeItem	= NULL;
	public $autoDestroy	= NULL;
	public $baseCls	= NULL;
	public $bubbleEvents	= NULL;
	public $defaultType	= NULL;
	public $defaults 	= NULL;
	public $detachOnRemove	= NULL;
	public $items 	= array();
	public $layout 	= NULL;
	public $renderTpl	= NULL;
	public $suspendLayout 	= NULL;
	
	public function __construct(){
		call_user_func_array(array(
			'parent', 
			'__construct'
		), func_get_args());
	}
	public function toMetaDataArray() {
		$meta = parent::toMetaDataArray();
		foreach($this->items as $item) {
			$meta["cn"][] = $item->toMetaDataArray();
		}
		return $meta;
	}

}

?>