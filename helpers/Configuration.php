<?php
namespace Ti\Mss\Helpers;
define('ROOT', 'http://localhost:9002/public');

class Configuration
{
     
    public static function redirection($path){
       return header("Location: " ."/".$path);
    }
    
}