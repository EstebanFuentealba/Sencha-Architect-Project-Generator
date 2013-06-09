<?PHP
namespace Sencha;

require_once(dirname(__FILE__).'/../Ext/Base.php');

use Ext\Base as Base;

class XDS extends Base {
	
	public $name				= "project_xds";
    public $settings			= NULL;
    public $xdsVersion			= "2.2.2";
    public $xdsBuild			= 991;
    public $schemaVersion		= 1;
    public $upgradeVersion		= 210000000503;
	public $framework			= "ext42";
	public $topInstanceFileMap	= array();
	public $viewOrderMap		= NULL;
	public function __construct(){
		call_user_func_array(array(
			'parent', 
			'__construct'
		), func_get_args());
		$this->__fileName = 'project_xds.xds';
		unset($this->__designerId);
		unset($this->__object);
		unset($this->__functions);
		unset($this->__events);
	}
	public function toMetaDataArray() {
		$meta = array();
		foreach($this as $key => $value) {
			if(!is_null($value)){
				/* NO private attributes */
				if(!preg_match("/^__(.*)$/", $key)){
					if(is_object($value)) {
						$meta[$key] = $value->toArray();
					} else { 
						$meta[$key] = $value;
					}
				}
			}
		}
		return $meta;
	}
	public function toArray() {
		return array(
			'paths'	=> $this->paths,
			'className'	=> $this->__className
		);
	}
}

?>