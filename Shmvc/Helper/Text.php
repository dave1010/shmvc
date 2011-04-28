<?php
namespace Shmvc\Helper;

class Text {

	/**
	 * Call htmlspecialchars so data doesn't mess up a browser viewing a UTF-8 page
	 * UTF-8 can handle lots of characters without using named / numeric character references
	 * @param mixed $input
	 * @return mixed
	 * @assert ('abc') == 'abc'
	 * @assert ('a>b') == 'a&gt;b'
	 * @assert ('a&b') == 'a&amp;b'
	 * @assert ("a'b") == "a'b"
	 * @assert ('a"b') == 'a&quot;b'
	 * @assert (array('aéb','a©b','a™b')) == array('aéb','a©b','a™b')
	 * @assert ('Iñtërnâtiônàlizætiøn') == 'Iñtërnâtiônàlizætiøn'
	 */
	public static function escape($input) {
		if (is_array($input)) {
			foreach ($input as &$v) {
				$v = call_user_func(__METHOD__, $v);
			}
			return $input;
		} else {
			return htmlspecialchars($input);
		}
	}

}
