<?php
// src/WM/WSBundle/Utils/Arrays.php
namespace WM\WSBundle\Utils;

class Arrays
{
     public function utf8_encode_deep(&$input) {
	if (is_string($input)) {
		
		$input = $this->fixCoding($input);
		$input = $this->parseTags($input);
		
	} else if (is_array($input)) {
		foreach ($input as &$value) {
			$this->utf8_encode_deep($value);
		}
		
		unset($value);
	} else if (is_object($input)) {
		$vars = array_keys(get_object_vars($input));
		
		foreach ($vars as $var) {
			$this->utf8_encode_deep($input->$var);
		}
	}
    }
	
	function parseTags($input){
		  $re =      "/\*\*(.*)\*\*([ .,;])/i";
		  $subst = '<b>$1</b>$2';
		  $input = preg_replace($re, $subst, $input);
		  
		  $re =      "/\#\#\#(.*)\n/i";
		  $subst = '<h3>$1</h3>$2';
		  $input = preg_replace($re, $subst, $input);
		  $re =      "/\#\#(.*)\n/i";
		  $subst = '<h2>$1</h2>$2';
		  $input = preg_replace($re, $subst, $input);
		  $re =      "/\#(.*)\n/i";
		  $subst = '<h1>$1</h1>$2';
		  $input = preg_replace($re, $subst, $input);
		  return $input;
	}
	function fixCoding($input){
		$input =  utf8_encode($input);
		$search = array('±','ê','¶','æ','³', '¿','ñ','¼','¯','£');
		$replace = array('ą','ę','ś','ć','ł', 'ż','ń','ź','Ż','Ł');
		$input = str_replace($search, $replace,$input);
		$search = array('Å','Ä');
		$replace = array('ś','ć');
		$input = str_replace($search, $replace,$input);
		return $input;
	}

}