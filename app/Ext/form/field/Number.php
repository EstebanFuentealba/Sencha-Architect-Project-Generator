<?PHP
namespace Ext\form\field;

require_once(dirname(__FILE__).'/Spinner.php');

use Ext\form\field\Spinner as Spinner;

class Number extends Spinner {
	
	public $allowDecimals	=	NULL;
	public $autoStripChars	=	NULL;
	public $baseChars	=	NULL;
	public $decimalPrecision	=	NULL;
	public $decimalSeparator	=	NULL;
	public $maxText	=	NULL;
	public $maxValue	=	NULL;
	public $minText	=	NULL;
	public $minValue	=	NULL;
	public $nanText	=	NULL;
	public $negativeText	=	NULL;
	public $step	=	NULL;
	public $submitLocaleSeparator	=	NULL;
	
	public function __construct(){
		parent::__construct();
	}
	
	
}


?>