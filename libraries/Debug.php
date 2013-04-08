<?PHP

class Debug {
	
	#Debug::dump();
	public static function dump($text) {
		echo '<pre>';
		print_r( $text );
		echo '</pre>';
	}
	
}