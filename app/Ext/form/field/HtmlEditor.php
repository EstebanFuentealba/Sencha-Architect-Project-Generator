<?PHP
namespace Ext\form\field;

require_once(dirname(__FILE__).'/../FieldContainer.php');

use Ext\form\FieldContainer as FieldContainer;

class HtmlEditor extends FieldContainer {
	
	public $afterIFrameTpl	=	NULL;
	public $afterTextAreaTpl	=	NULL;
	public $beforeIFrameTpl	=	NULL;
	public $beforeTextAreaTpl	=	NULL;
	public $componentLayout	=	NULL;
	public $createLinkText	=	NULL;
	public $defaultButtonUI	=	NULL;
	public $defaultLinkValue	=	NULL;
	public $defaultValue	=	NULL;
	public $enableAlignments	=	NULL;
	public $enableColors	=	NULL;
	public $enableFont	=	NULL;
	public $enableFontSize	=	NULL;
	public $enableFormat	=	NULL;
	public $enableLinks	=	NULL;
	public $enableLists	=	NULL;
	public $enableSourceEdit	=	NULL;
	public $fieldBodyCls	=	NULL;
	public $fontFamilies	=	NULL;
	public $iframeAttrTpl	=	NULL;
	
	public function __construct(){
		call_user_func_array(array(
			'parent', 
			'__construct'
		), func_get_args());
	}
	
	
}


?>