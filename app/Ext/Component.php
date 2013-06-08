<?PHP
namespace Ext;

require_once(dirname(__FILE__).'/AbstractComponent.php');

use Ext\AbstractComponent as AbstractComponent;

class Component extends AbstractComponent {
	public $autoScroll	=	NULL;
	public $columnWidth	=	NULL;
	public $constrainTo	=	NULL;
	public $constraintInsets	=	NULL;
	public $defaultAlign	=	NULL;
	public $draggable	=	NULL;
	public $floating	=	NULL;
	public $formBind	=	NULL;
	public $overflowX	=	NULL;
	public $overflowY	=	NULL;
	public $region	=	NULL;
	public $resizable	=	NULL;
	public $resizeHandles	=	NULL;
	public $toFrontOnShow	=	NULL;
	
	public function __construct(){
		parent::__construct();
	}
	
	public function toMetaDataArray() {
		$meta = parent::toMetaDataArray();
		if(!is_null($this->region)){
			$meta["userConfig"]["layout|region"] = $this->region;
			unset($meta["userConfig"]["region"]);
		}
		return $meta;
	}
}

?>