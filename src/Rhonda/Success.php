<?php
namespace Rhonda;

/**
* Class to handle Success message building
*
* @category  Class
* @version   0.0.1
* @since     2015-11-09
* @author    Deac Karns <deac@sdicg.com>
*/
class Success
{
    /**
    * Create a uniform success message string
    *
    * @example
    * <code>
    *   \Rhonda\Success::create();
    * </code>
    *
    * Default success message
    * @example
    * <code>
    *   $message = new \Rhonda\Success();
    *   $message->create();
    * </code>
    *
    * Example with custom message
    * @example
    * <code>
    *   $message = new \Rhonda\Success();
    *   $message->create("foo","bar");
    * </code>
    *
    * @return String - Success message string
    *
    * @since   2015-11-09
    * @author  Deac Karns <deac@sdicg.com> 
    **/
    public static function create($key=NULL,$value=TRUE)
    if(empty($key)){
      $key="success";
    }
    return json_encode(array($key => $value));
  }
}