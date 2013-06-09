<?PHP
namespace Ext\button;

require_once(dirname(__FILE__).'/../Component.php');

use Ext\Component as Component;

class Button extends Component {

	public $allowDepress	=	NULL;
	public $arrowAlign 	=	NULL;
	public $arrowCls	=	NULL;
	public $baseCls	=	NULL;
	public $baseParams	=	NULL;
	public $clickEvent	=	NULL;
	public $cls	=	NULL;
	public $componentLayout	=	NULL;
	public $destroyMenu	=	NULL;
	public $disabled 	=	NULL;
	public $enableToggle	=	NULL;
	public $focusCls	=	NULL;
	public $frame	=	NULL;
	public $glyph	=	NULL;
	public $handleMouseEvents	=	NULL;
	public $handler	=	NULL;
	public $hidden	=	NULL;
	public $href	=	NULL;
	public $hrefTarget	=	NULL;
	public $icon	=	NULL;
	public $iconAlign	=	NULL;
	public $iconCls	=	NULL;
	public $menu	=	NULL;
	public $menuActiveCls	=	NULL;
	public $menuAlign	=	NULL;
	public $minWidth	=	NULL;
	public $overCls	=	NULL;
	public $overflowText	=	NULL;
	public $params	=	NULL;
	public $pressed	=	NULL;
	public $pressedCls	=	NULL;
	public $preventDefault	=	NULL;
	public $renderTpl	=	NULL;
	public $repeat	=	NULL;
	public $scale	=	NULL;
	public $scope	=	NULL;
	public $showEmptyMenu	=	NULL;
	public $shrinkWrap	=	NULL;
	public $tabIndex	=	NULL;
	public $text	=	NULL;
	public $textAlign	=	NULL;
	public $toggleGroup	=	NULL;
	public $toggleHandler	=	NULL;
	public $tooltip 	=	NULL;
	public $tooltipType	=	NULL;
	public $type	=	NULL;
	
	public function __construct(){
		call_user_func_array(array(
			'parent', 
			'__construct'
		), func_get_args());
	}
}


?>