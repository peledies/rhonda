<?php
namespace Rhonda;

/**
* Class to handle Configuration file related tasks
*
* @category  Class
* @version   0.0.1
* @since     2015-11-06
* @author    Deac Karns <deac@sdicg.com>
*/
class Config {
  static private $config;

  /**
  * Load a JSON configuration file into memory
  *
  * @param String - Configuration key to be accessed later
  * @param String - Path to JSON file
  *
  * @example
  * <code>
  *   \\ File path is relative to the project root
  *   \Rhonda\Config::load_file('test', 'path/to/file.json');
  * </code>
  *
  * @example
  * <code>
  *   \\ File path is relative to the project root
  *   $config = new \Rhonda\Config();
  *   $config->load_file('test', 'path/to/file.json');
  * </code>
  *
  * @since   2015-11-06
  * @author  Deac Karns <deac@sdicg.com> 
  **/
  public function load_file($key, $location){
    $contents = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'].$location));
    @self::$config->$key = $contents;
  }

  /**
  * Load a configuration Object into memory
  *
  * @param String - Configuration key to be accessed later
  * @param Object - Object to be loaded into memory
  *
  * @example
  * <code>
  *   $object = new stdClass();
  *   $object->thing_1 = 'something one';
  *   $object->thing_2 = 'something two';
  *
  *   \Rhonda\Config::load_object('test', $object);
  * </code>
  *
  * @example
  * <code>
  *   $object = new stdClass();
  *   $object->thing_1 = 'something one';
  *   $object->thing_2 = 'something two';
  *
  *   $config = new \Rhonda\Config();
  *   $config->load_object('test', $object);
  * </code>
  *
  * @since   2015-11-06
  * @author  Deac Karns <deac@sdicg.com> 
  **/
  public function load_object($key, $object){
      @self::$config->$key = $object;
  }

  /**
  * Reference a configuration from memory
  *
  * @param String - Configuration key to be accessed
  *
  * @example
  * <code>
  *   \Rhonda\Config::get('test')
  * </code>
  *
  * @example
  * <code>
  *   $config = new \Rhonda\Config();
  *   $config->get('test');
  * </code>
  *
  * @since   2015-11-06
  * @author  Deac Karns <deac@sdicg.com> 
  **/
  public function get($key) {
    if(property_exists(self::$config, $key)){
      $result = self::$config->$key; 
    }else{
      $result = null;
    }
    return $result;  
  }

}
