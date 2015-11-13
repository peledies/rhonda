<?php
namespace Rhonda;

/**
* Class to handle Header related tasks
*
* @category  Class
* @version   0.0.1
* @since     2015-11-13
* @author    Deac Karns <deac@sdicg.com>
*/
class Headers{

  static public function getallheaders(){
    if (function_exists('getallheaders')) {
      // For Apache
      $headers = getallheaders();
    }else{
      // For Nginx
      $headers = ''; 
       foreach ($_SERVER as $name => $value) { 
           if (substr($name, 0, 5) == 'HTTP_') { 
               $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value; 
           } 
       } 
    }
    return $headers;
  }
}