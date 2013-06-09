<?PHP
namespace Ext\grid\plugin;

require_once(dirname(__FILE__).'/../../AbstractPlugin.php');

use Ext\AbstractPlugin as AbstractPlugin;

class DragDrop extends AbstractPlugin {

	public $containerScroll	=	NULL;
	public $ddGroup			=	NULL;
	public $dragGroup		=	NULL;
	public $dragText		=	NULL;
	public $dropGroup		=	NULL;
	public $enableDrag		=	NULL;
	public $enableDrop		=	NULL;
	public $pluginId		=	NULL;
	
	public function __construct(){
		call_user_func_array(array(
			'parent', 
			'__construct'
		), func_get_args());
	}
	
	public function toMetaDataArray() {
		$meta = parent::toMetaDataArray();
		$meta["reference"]["name"] = 'plugins';
		$meta["reference"]["type"] = 'array';
		$meta["codeClass"] = $this->__type;
		return $meta;
	}
	
}


?>