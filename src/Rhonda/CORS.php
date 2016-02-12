<?php
namespace Rhonda;

/**
* Class to handle CORS headers
*
* @category  Class
* @version   0.0.1
* @since     2016-02-09
* @author    Wesley Dekkers <wesley@sdicg.com>
*/
class CORS
{
  /**
  * Allow CORS request 
  * DO NOT forget to add a OPTIONS route to your router else CORS will still deny your request
  *
  * @example
  * <code>
  *   \Rhonda\CORS::allow_headers();
  * </code>
  *
  * @example
  * <code>
  *   $cors = new \Rhonda\CORS();
  *   $cors->allow_headers();
  * </code>
  *
  * @return void
  *
  * @since   2016-02-09
  * @author  Wesley Dekkers <wesley@sdicg.com>
  **/
  public static function allow_headers()
  {
    $allow_headers = \Rhonda\Headers::getallheaders()['Access-Control-Request-Headers'];
    
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST, PUT, DELETE, GET, OPTIONS");
    if(!empty($allow_headers)){ header("Access-Control-Allow-Headers: $allow_headers"); }
    header("Access-Control-Max-Age: 1728000");
  }
}