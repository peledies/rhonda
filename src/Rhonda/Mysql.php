<?php
namespace Rhonda;

/**
* Class to handle Mysql conveniences
*
* @category  Class
* @version   0.0.1
* @since     2015-11-09
* @author    Deac Karns <deac@sdicg.com>
*/
class Mysql
{
  /**
  * Requires a database config file or object to be loaded and the mysqli extension for PHP to be installed</br>
  *
  * Escape a String
  * @example
  * <code>
  *   $string = "that's all folks";
  *   $string = \Rhonda\Mysql::real_escape($string);
  * </code>
  *
  * Escape an Object
  * @example
  * <code>
  *   $object = new \stdClass();
  *   $object->thing = "it's for real";
  *   $object = \Rhonda\Mysql::real_escape($object);
  * </code>
  *
  * Escape an Array
  * @example
  * <code>
  * $array = array(
  *    "ray"=>"it's escaping arrays"
  *  , "ray2"=>"escape's this one too"
  * );
  * $array = \Rhonda\Mysql::real_escape($ray);
  *
  * @return Type - Mysql escaped resource that was operated on
  *
  * @since   2015-11-20
  * @author  Deac Karns <deac@sdicg.com> 
  **/
  public static function real_escape($thing){

    // check that a configuration object exists for DB
    try{
      $db = \Rhonda\Config::get('DB')->connections->local;
    }catch(\Exception $e){
      echo \Rhonda\Error:: handle($e);
    }

    $mysqli = new \mysqli($db->host
      , $db->user
      , $db->password
      , $db->database
      , $db->port
    );
    $mysqli->set_charset("utf8");
    
    if ($mysqli->connect_errno) {
      echo \Rhonda\Error:: handle($mysqli->connect_error);
    }

    // test the thing that is coming in
    switch (gettype($thing)) {
      case 'string':
        $escaped = $mysqli->real_escape_string($thing);
        break;

      case 'object':
        $escaped = self:: escape_collection($thing,$mysqli);
        break;

      case 'array':
        $escaped = self:: escape_collection($thing,$mysqli);
        break;
      default:
        $escaped = $thing;
        break;
    }

    return $escaped;
  }

  private static function escape_collection($collection, $mysqli){
    if(is_object($collection)){
      $arr = new \stdClass();
    }else{
      $arr = array();
    }
    foreach ($collection as $key => $val) {
      $val = (is_array($val) || is_object($val)) ? self:: escape_collection($val) : $mysqli->real_escape_string($val);
      if(is_object($collection)){
        $arr->$key = $val;
      }else{
        $arr[$key] = $val;
      }
    }
    return $arr;
  }

  public static function bool_to_string($value){
    return (\Rhonda\Boolean::evaluate($value))? '1':'0';
  }
}