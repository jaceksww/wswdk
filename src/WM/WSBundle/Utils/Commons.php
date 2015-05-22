<?php
namespace WM\WSBundle\Utils;

class Commons
{
    function make_uri($str,$html='.html'){
		
		return str_replace(array('"','\'',' ','(',')','_','Ń','Ę','Ą','Ó','Ł','Ś','Ż','ą','ć','ę','ń','ó','ś','ł','ż','ź',',','.','!','?'), array('','','-','-','-','-','N','E','A','O','L','S','Z','a','c','e','n','o','s','l','z','z','','','','',''),strtolower(trim($str))).$html;
	}
    
    function url_title($str, $separator = 'dash', $lowercase = FALSE)
	{
		if ($separator == 'dash')
		{
			$search		= '_';
			$replace	= '-';
		}
		else
		{
			$search		= '-';
			$replace	= '_';
		}

		$trans = array(
						'&\#\d+?;'				=> '',
						'&\S+?;'				=> '',
						'\s+'					=> $replace,
						'[^a-z0-9\-\._]'		=> '',
						$replace.'+'			=> $replace,
						$replace.'$'			=> $replace,
						'^'.$replace			=> $replace,
						'\.+$'					=> ''
					);

		$str = strip_tags($str);

		foreach ($trans as $key => $val)
		{
			$str = preg_replace("#".$key."#i", $val, $str);
		}

		if ($lowercase === TRUE)
		{
			$str = strtolower($str);
		}

		return trim(stripslashes($str));
	}
}