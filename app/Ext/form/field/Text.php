<?PHP
namespace Ext\form\field;

require_once(dirname(__FILE__).'/Base.php');

use Ext\form\field\Base as Base;

class Text extends Base {

	public $allowBlank	=	NULL;
	public $allowOnlyWhitespace	=	NULL;
	public $blankText	=	NULL;
	public $disableKeyFilter	=	NULL;
	public $emptyCls	=	NULL;
	public $emptyText	=	NULL;
	public $enableKeyEvents	=	NULL;
	public $enforceMaxLength	=	NULL;
	public $grow	=	NULL;
	public $growAppend	=	NULL;
	public $growMax	=	NULL;
	public $growMin	=	NULL;
	public $maskRe	=	NULL;
	public $maxLength	=	NULL;
	public $maxLengthText	=	NULL;
	public $minLength	=	NULL;
	public $minLengthText	=	NULL;
	public $regex	=	NULL;
	public $regexText	=	NULL;
	public $requiredCls	=	NULL;
	public $selectOnFocus	=	NULL;
	public $size	=	NULL;
	public $stripCharsRe	=	NULL;
	public $validateBlank	=	NULL;
	public $validator	=	NULL;
	public $vtype	=	NULL;
	public $vtypeText	=	NULL;
	
	public function __construct(){
		parent::__construct();
	}
	
	
}


?>