<?PHP
namespace Ext\data;
require_once(dirname(__FILE__).'/AbstractStore.php');
class TreeStore extends AbstractStore {
	
	public $clearOnLoad			=	NULL;
	public $clearRemovedOnLoad	=	NULL;
	public $defaultRootId		=	NULL;
	public $defaultRootProperty	=	NULL;
	public $defaultRootText		=	NULL;
	public $folderSort			=	NULL;
	public $nodeParam			=	NULL;
	public $root				=	array();
	
	
	public function __construct(){
		call_user_func_array(array(
			'parent', 
			'__construct'
		), func_get_args());
	}
	
	public function toMetaDataArray() {
		$meta = parent::toMetaDataArray();
		if(count($this->root)>0) {
			$meta['userConfig']['root'] = $this->root;
		}
		return $meta;
	}
	
}

?>