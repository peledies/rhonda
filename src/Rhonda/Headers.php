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
    $headers = '';
    foreach ($_SERVER as $name => $value) {
      if (substr($name, 0, 5) == 'HTTP_') {

        $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
      }
    }
    return $headers;
  }

  
  /**
  * Set response headers based on parameter
  *
  * @param Parameter - The response code
  *
  * @example
  * <code>
  * \Rhonda\Response:: set_header($result);
  * </code>
  *
  * @since   2016-08-01
  * @author  Deac Karns <deac@sdicg.com> 
  * @author  Wesley Dekkers <wesley@sdicg.com> 
  **/
  public static function set_response_code($code){
    switch ($code) {
      case 400:
        $header = "HTTP/1.1 400 Bad Request";
        break;
      
      case 404:
        $header = "HTTP/1.1 404 Not Found";
        break;

      case 209:
        $header = "HTTP/1.1 209 Partial Success";
        break;

      default:
        $header = "HTTP/1.1 200 Success";
        break;
    }

    header($header);
  }
}