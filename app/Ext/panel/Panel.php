<?PHP
namespace Ext\panel;

require_once(dirname(__FILE__).'/AbstractPanel.php');

use Ext\panel\AbstractPanel as AbstractPanel;

class Panel extends AbstractPanel {

	public $animCollapse = NULL;
	public $bbar = NULL;
	public $buttonAlign = NULL;
	public $buttons = NULL;
	public $closable= NULL;
	public $closeAction= NULL;
	public $collapseDirection = NULL;
	public $collapseFirst = NULL;
	public $collapseMode = NULL;
	public $collapsed = NULL;
	public $collapsedCls = NULL;
	public $collapsible= NULL;
	public $constrain = NULL;
	public $constrainHeader= NULL;
	public $dockedItems = array();
	public $fbar= NULL;
	public $floatable= NULL;
	public $frame= NULL;
	public $frameHeader= NULL;
	public $glyph= NULL;
	public $header = NULL;
	public $headerOverCls= NULL;
	public $headerPosition= NULL;
	public $hideCollapseTool= NULL;
	public $icon= NULL;
	public $iconCls= NULL;
	public $lbar= NULL;
	public $manageHeight= NULL;
	public $minButtonWidth= NULL;
	public $overlapHeader = NULL;
	public $placeholder = NULL;
	public $placeholderCollapseHideMode= NULL;
	public $rbar= NULL;
	public $simpleDrag = NULL;
	public $tbar = NULL;
	public $title = "My Panel";
	public $titleAlign = NULL;
	public $titleCollapse = NULL;
	public $tools	= NULL;
	
	public function __construct(){
		call_user_func_array(array(
			'parent', 
			'__construct'
		), func_get_args());
	}
	public function toMetaDataArray() {
		$meta = parent::toMetaDataArray();
		if(count($this->dockedItems)>0){
			foreach($this->dockedItems as $key => $item) {
				$meta['cn'][] = $item->toMetaDataArray();
			}
		}
		return $meta;
	}
	
}


?>