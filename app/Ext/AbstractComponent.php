<?PHP
namespace Ext;

require_once(dirname(__FILE__).'/Base.php');
require_once(dirname(__FILE__).'/state/Stateful.php');
require_once(dirname(__FILE__).'/util/Animate.php');
require_once(dirname(__FILE__).'/util/ElementContainer.php');
require_once(dirname(__FILE__).'/util/Observable.php');
require_once(dirname(__FILE__).'/util/Positionable.php');
require_once(dirname(__FILE__).'/util/Renderable.php');

use Ext\Base as Base;
use Ext\util\Animate as Animate;
use Ext\util\ElementContainer as ElementContainer;
use Ext\util\Observable as Observable;
use Ext\util\Positionable as Positionable;
use Ext\util\Renderable as Renderable;
use Ext\state\Stateful as Stateful;

abstract class AbstractComponent 
	extends Base 
	implements Stateful, Animate , ElementContainer, Positionable, Renderable {

	public $autoEl	= NULL;
	public $autoRender= NULL;
	public $autoShow= NULL;
	public $baseCls= NULL;
	public $border = NULL;
	public $childEls = NULL;
	public $cls = NULL;
	public $componentCls= NULL;
	public $componentLayout = NULL;
	public $contentEl= NULL;
	public $data= NULL;
	public $disabled= NULL;
	public $disabledCls= NULL;
	public $draggable= NULL;
	public $floating= NULL;
	public $frame = NULL;
	public $height = NULL;
	public $hidden = NULL;
	public $hideMode = NULL;
	public $html = NULL;
	public $id= NULL;
	public $itemId = NULL;
	public $loader = NULL;
	public $margin = NULL;
	public $maxHeight = NULL;
	public $maxWidth = NULL;
	public $minHeight= NULL;
	public $minWidth= NULL;
	public $overCls = NULL;
	public $padding = NULL;
	public $plugins 		= array();
	public $renderData= NULL;
	public $renderSelectors= NULL;
	public $renderTo= NULL;
	public $renderTpl= NULL;
	public $rtl= NULL;
	public $shrinkWrap= NULL;
	public $style= NULL;
	public $tpl = NULL;
	public $tplWriteMode = NULL;
	public $ui = NULL;
	public $width = NULL;
	public $xtype= NULL;
	
	public function __construct(){
		call_user_func_array(array(
			'parent', 
			'__construct'
		), func_get_args());
	}
	
	public function toMetaDataArray() {
		$meta = parent::toMetaDataArray();
		if(is_array($this->plugins)) {
			foreach($this->plugins as $plugin) {
				$meta['cn'][] = $plugin->toMetaDataArray();
			}
		}
		return $meta;
	}

}

?>