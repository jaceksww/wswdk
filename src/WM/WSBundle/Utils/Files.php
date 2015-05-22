<?php
namespace WM\WSBundle\Utils;

class Files
{
    function base64_to_jpeg($base64_string, $output_file) {
        $img = imagecreatefromstring(base64_decode($base64_string)); 
        if($img != false) 
        { 
           imagejpeg($img, $output_file); 
        }  
        return $img; 
    }
}