<?PHP
namespace Sencha;

require_once(dirname(__FILE__).'/../Ext/Base.php');

use Ext\Base as Base;

class XDS extends Base {
	
	public $name			= "project_xds";
    public $settings		= NULL;
    public $xdsVersion		= "2.2.0";
    public $xdsBuild		= 908;
    public $schemaVersion	= 1;
    public $upgradeVersion	= 210000000499;
	public $framework		= "ext42";
	
	
	public function __construct(){
		parent::__construct();
		$this->__fileName = 'project_xds.xds';
		unset($this->__designerId);
	}
	
}

?>