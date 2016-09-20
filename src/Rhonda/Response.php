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
 * @author    Wesley Dekkers
 */

class Response {

  /**
  * Package incoming data along with the error summary from \Ronda\Error::summary()
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
  *   "data": STRING/OBJECT/ARRAY,
  *   "request": {
  *     "url": "REQUEST URL",
  *     "method": "POST/PUT/DELETE/GET/PATCH.. etcetera"
  *   }
  * }
  *
  * @since   2016-07-29
  * @author  Deac Karns <deac@sdicg.com> 
  * @author  Wesley Dekkers <wesley@sdicg.com> 
  **/
  public static function package($data, $response_code=false){
    $result = new \stdClass();
    $result->errors = \Rhonda\Error::summary();
    $result->data = $data;

    $result->request = new \stdClass();
    $result->request->url = $_SERVER['REQUEST_SCHEME']
                            ."://"
                            .$_SERVER['HTTP_HOST']
                            .$_SERVER['REQUEST_URI'];
    $result->request->method = $_SERVER['REQUEST_METHOD'];

    // When error not empty and data not empty change headers 206
    if(!$response_code && !empty($result->errors) && !empty($data)){
      $response_code = 209;
    }
    // when error not empty and data empty return 400
    if(!$response_code && !empty($result->errors) && empty($data)){
      $response_code = 400;
    }

    \Rhonda\Headers:: set_response_code($response_code);

    return $result;
  }

}