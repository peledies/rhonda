<?php
namespace Rhonda;
/**
 * Package the response data in an object possibly with defined errors and correct headers
 *
 * @category  Class
 * @version   0.0.1
 * @uses      \Rhonda\Error
 * @since     2016-07-29
 * @author    Deac Karns <deac@sdicg.com>
 * @author 		Wesley Dekkers
 */

class Response {

  /**
  * Description Of Module
  *
  * In order an error to be populated it uses \Rhonda\Error::add_summary_item(); and \Rhonda\Error::summary();
  *
  * @param Parameter - The result you want to return
  *
  * @example
  * <code>
  * \Rhonda\Response:: package($result);
  * </code>
  *
  * @return Return - **Object**
  * {
  *   "errors": ARRAY of error OBJECTS,
  *   "data": STRING/OBJECT/ARRAY
  * }
  *
  * @since   2016-07-29
  * @author  Deac Karns <deac@sdicg.com> 
  * @author  Wesley Dekkers <wesley@sdicg.com> 
  **/
	public static function package($data){
		$result = new \stdClass();
    $result->errors = \Rhonda\Error::summary();
    $result->data = $data;

    // When error not empty and data not empty change headers 206
    if(!empty($result->errors) && !empty($data)){
    	header("HTTP/1.1 209 Partial Success");
    }
    // when error not empty and data empty return 400
    if(!empty($result->errors) && empty($data)){
    	header("HTTP/1.1 400 Bad Request");
    }

    return $result;
  }
}