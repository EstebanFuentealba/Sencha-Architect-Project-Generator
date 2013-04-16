<?PHP

class Utils {

	public static function rrmdir($dir) {
		if (is_dir($dir)) {
			$objects = @scandir($dir);
			foreach ($objects as $object) {
				if ($object != "." && $object != "..") {
					if (filetype($dir."/".$object) == "dir") Utils::rrmdir($dir."/".$object); else @unlink($dir."/".$object);
				}
			}
			@reset($objects);
			@rmdir($dir);
		}
	}
	public static function getUCName($name) {
        return ucwords(self::getLowerName($name));
    }

    public static function getLowerName($name) {
        return strtolower($name);
    }

    public static function getPluralName($name) {
        return self::getUnionName($name, true);
    }

    public static function getUnionName($name,$tableConfig	= array(
		'prefix'	=> '',
		'suffix'	=> ''
	), $plural=false) {
		$text = self::getLowerName($name);
		if(self::startsWith($text, $tableConfig['prefix'])){
			$text = substr($text , strlen($tableConfig['prefix']) );
		}
		if(self::endsWith($text, $tableConfig['suffix'])){
			$text = substr($text ,0, strlen($text) - strlen($tableConfig['suffix']) );
		}
        $ex = @explode("_", $text );
        if (count($ex) > 0) {
            $d = "";
            $x = 0;
            foreach ($ex as $palabra) {
                if ($x == 0) {
                    $d .= $palabra;
                    if ($plural) {
                        $d .= "s";
                    }
                } else {
                    $d .= ucwords($palabra);
                    if ($plural) {
                        $d .= "s";
                    }
                }
                $x++;
            }
            return ucwords($d);
        }
		
        return self::GetLowerName($name) . "s";
    }
	public static function startsWith($haystack, $needle) {
		return !strncmp($haystack, $needle, strlen($needle));
	}

	public static function endsWith($haystack, $needle) {
		$length = strlen($needle);
		if ($length == 0) {
			return true;
		}

		return (substr($haystack, -$length) === $needle);
	}
}
?>