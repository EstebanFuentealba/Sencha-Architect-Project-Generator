<?PHP
namespace Ext\form\field;

require_once(dirname(__FILE__).'/Picker.php');

use Ext\form\field\Picker as Picker;

class ComboBox extends Picker {
	
	public $allQuery	=	NULL;
	public $autoSelect	=	NULL;
	public $componentLayout	=	NULL;
	public $defaultListConfig	=	NULL;
	public $delimiter	=	NULL;
	public $displayField	=	NULL;
	public $enableRegEx	=	NULL;
	public $fieldSubTpl	=	NULL;
	public $forceSelection 	=	NULL;
	public $growToLongestValue	=	NULL;
	public $hiddenName	=	NULL;
	public $listConfig	=	NULL;
	public $minChars 	=	NULL;
	public $multiSelect	=	NULL;
	public $pageSize	=	NULL;
	public $queryCaching	=	NULL;
	public $queryDelay	=	NULL;
	public $queryMode	=	NULL;
	public $queryParam	=	NULL;
	public $selectOnTab	=	NULL;
	public $store		=	NULL;
	public $transform	=	NULL;
	public $triggerAction	=	NULL;
	public $triggerCls	=	NULL;
	public $typeAhead	=	NULL;
	public $typeAheadDelay	=	NULL;
	public $valueField	=	NULL;
	public $valueNotFoundText 	=	NULL;
	
	public function __construct(){
		call_user_func_array(array(
			'parent', 
			'__construct'
		), func_get_args());
	}
	
	
}


?>