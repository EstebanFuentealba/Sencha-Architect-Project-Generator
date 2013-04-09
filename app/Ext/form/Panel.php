<?PHP
namespace Ext\form;

require_once(dirname(__FILE__).'/../panel/Panel.php');

use Ext\panel\Panel as Pnl;

class Panel extends Pnl {

	public $layout			= NULL;
	public $pollForChanges	= NULL;
	public $pollInterval	= NULL;
	
	public function __construct(){
		parent::__construct();
	}
	
	
}


?>