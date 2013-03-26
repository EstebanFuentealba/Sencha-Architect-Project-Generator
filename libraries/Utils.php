<?PHP

class Utils {
	public static function getUCName($name) {
        return ucwords(self::getLowerName($name));
    }

    public static function getLowerName($name) {
        return strtolower($name);
    }

    public function getPluralName($name) {
        return self::getUnionName($name, true);
    }

    public function getUnionName($name, $plural=false) {
        $ex = @explode("_", self::getLowerName($name));
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
            return $d;
        }
        return self::GetLowerName($name) . "s";
    }
}
?>