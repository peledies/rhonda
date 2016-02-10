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
    * Empty POST body exception can be bypassed by passing a TRUE argument
    *
    *
    * @example
    * Bypass empty POST body exception
    * <code>
    *   \Rhonda\RequestBody::get(TRUE));
    * </code>
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
    * @todo    Check for form data and package it up if its present
    **/
    public static function get($bypass_exception=FALSE)
    {
      $body = file_get_contents('php://input');

      // check if empty post body
      if(empty($body) && !$bypass_exception){
        throw new \Exception("Can not operate on an empty Raw POST Body");
      }elseif(empty($body) && $bypass_exception){
        $json = false;
      }else{
        $json = json_decode($body);
        if (json_last_error() !== JSON_ERROR_NONE) {
          throw new \Exception("Malformed JSON in POST Body: ".json_last_error_msg());
        }
      }

      return $json;
    }
}