<?php
namespace Rhonda;

/**
* Class to handle request body tasks
*
* @category  Class
* @version   0.0.1
* @since     2015-11-06
* @author    Deac Karns <deac@sdicg.com>
*/
class RequestBody
{
    /**
    * Get the provided request body
    * 
    * @example
    * <code>
    *   \Rhonda\RequestBody::get());
    * </code>
    *
    * @example
    * <code>
    *   $body = new \Rhonda\RequestBody();
    *   $request_body->get();
    * </code>
    * @return Object - Object containing the request body
    *
    * @since   2015-11-06
    * @author  Deac Karns <deac@sdicg.com> 
    **/   
    public static function get()
    {
      return json_decode(file_get_contents('php://input'));
    }
}