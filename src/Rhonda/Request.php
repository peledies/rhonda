<?php
namespace Rhonda;

/**
* Class to handle request body and query string tasks.
* All data that comes through this class is mysql_real_escaped
*
* @category  Class
* @version   0.0.1
* @since     2016-05-06
* @author    Deac Karns <deac@sdicg.com>
* @author    Jim Harney <jim@sdicg.com>
*/
class Request
{
  static private $get;
  static private $post;

  public function get($props=NULL) {
    return (empty($props))? self::$get : self::$get[$props]; 
  }

  public function post() {
    return self::$post;  
  }

  private function log_diff($array_1, $array_2){
    $diff = array_diff($array_1, $array_2);
    if(count($diff) > 0){
      error_log('NOTICE: request packager modified input for sanitization purposes.');
      error_log(print_r($diff,true));
    }
  }

  private function is_json_object($object){
    return (count(get_object_vars($object)) > 0);
  }

  private function sanitize_get_array($dirty){
      $clone = array();

      foreach ($dirty as $key => $value) {
        $value_object = json_decode(urldecode($dirty[$key]));

        $clone[$key] = (self::is_json_object($value_object))? $value_object:$value;
      }

      // self::log_diff($clean_GET_clone, $expanded_GET_clone);

      return \Rhonda\Mysql::real_escape($clone);
  }

  function packager() {
    // sanitize and package GET query string
    if(isset($_GET)){
      self::$get = self::sanitize_get_array($_GET);
    }

    // sanitize and package POST Body string
    $post_body = \Rhonda\RequestBody::get(TRUE);
    if(!empty($post_body)){
      self::$post = \Rhonda\Mysql::real_escape($post_body);
    }
  }

  function PDO_packager() {
    if(isset($_GET)){
      self::$get = $_GET;
    }

    $post_body = \Rhonda\RequestBody::get(TRUE);
    if(!empty($post_body)){
      self::$post = $post_body;
    }
  }
}