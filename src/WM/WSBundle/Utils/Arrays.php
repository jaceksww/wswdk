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
	 
	function bbcode($str = '', $max_images = 0)
	{
		// convert to html entities
		$str = htmlentities($str, NULL, 'UTF-8');

		//$str = $this->auto_link($str);
	
		// Max image size eh? Better shrink that pic!
		//if($max_images > 0):
		//	$str_max = "style=\"max-width:".$max_images."px; width: [removed]this.width > ".$max_images." ? ".$max_images.": true);\"";
		//endif;
	
		$find = array(
		"'\n'i",
		"'\[b\](.*?)\[/b\]'is",
		"'\[i\](.*?)\[/i\]'is",
		"'\[u\](.*?)\[/u\]'is",
		"'\[s\](.*?)\[/s\]'is",
		"'\[img\](.*?)\[/img\]'i",
		"'\[url\](.*?)\[/url\]'i",
		"'\[url=(.*?)\](.*?)\[/url\]'i",
		"'\[link\](.*?)\[/link\]'i",
		"'\[link=(.*?)\](.*?)\[/link\]'i",
		"'\[size=small\](.*?)\[/size\]'is",	
		"'\[size=normal\](.*?)\[/size\]'is",
		"'\[size=medium\](.*?)\[/size\]'is",
		"'\[size=big\](.*?)\[/size\]'is",
		"'\[quote\](.*?)\[/quote\]'is",
		"'\[code\](.*?)\[/code\]'is"	
		);
	
		$replace = array(
		'<br />',
		'<strong>\\1</strong>',
		'<em>\\1</em>',
		'<u>\\1</u>',
		'<s>\\1</s>',
		'<img src="\\1" alt="" />',
		'<a href="\\1">\\1</a>',
		'<a href="\\1">\\2</a>',
		'<a href="\\1">\\1</a>',
		'<a href="\\1">\\2</a>',
		'<span style="font-size:0.9em;">\\1</span>',	
		'<span style="font-size:1em;">\\1</span>',
		'<span style="font-size:1.2em;">\\1</span>',
		'<span style="font-size:1.4em;">\\1</span>',
		'</p><blockquote>\\1</blockquote><p>',	
		'<pre><code>\\1</pre></code>'				
		);
	
	
		$str = preg_replace($find, $replace, $str);

		return $str;

	}
    function auto_link($str, $type = 'both', $popup = FALSE)
	{
		if ($type != 'email')
		{
			if (preg_match_all("#(^|\s|\()((http(s?)://)|(www\.))(\w+[^\s\)\<]+)#i", $str, $matches))
			{
				$pop = ($popup == TRUE) ? " target=\"_blank\" " : "";

				for ($i = 0; $i < count($matches['0']); $i++)
				{
					$period = '';
					if (preg_match("|\.$|", $matches['6'][$i]))
					{
						$period = '.';
						$matches['6'][$i] = substr($matches['6'][$i], 0, -1);
					}

					$str = str_replace($matches['0'][$i],
										$matches['1'][$i].'<a href="http'.
										$matches['4'][$i].'://'.
										$matches['5'][$i].
										$matches['6'][$i].'"'.$pop.'>http'.
										$matches['4'][$i].'://'.
										$matches['5'][$i].
										$matches['6'][$i].'</a>'.
										$period, $str);
				}
			}
		}

		if ($type != 'url')
		{
			if (preg_match_all("/([a-zA-Z0-9_\.\-\+]+)@([a-zA-Z0-9\-]+)\.([a-zA-Z0-9\-\.]*)/i", $str, $matches))
			{
				for ($i = 0; $i < count($matches['0']); $i++)
				{
					$period = '';
					if (preg_match("|\.$|", $matches['3'][$i]))
					{
						$period = '.';
						$matches['3'][$i] = substr($matches['3'][$i], 0, -1);
					}

					$str = str_replace($matches['0'][$i], safe_mailto($matches['1'][$i].'@'.$matches['2'][$i].'.'.$matches['3'][$i]).$period, $str);
				}
			}
		}

		return $str;
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
		$replace = array('ą','ę','ś','ć','ł', 'ż','ń','ź','Ż','Ł',);
		$input = str_replace($search, $replace,$input);
		$search = array('Ä','Ä','Å','Ä','Å', 'Åź','Å','Åº','Å»','Å','Ãł','Å','Ä','Ä','Ä','Å','Å¹','Ã');
		$replace = array('ą','ę','ś','ć','ł', 'ż','ń','ź','Ż','Ł','ó','Ś','Ą','Ę','Ć','Ń','Ź', 'Ó');
		$input = str_replace($search, $replace,$input);
		return $input;
	}

}
