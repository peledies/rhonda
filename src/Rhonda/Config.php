<?php
namespace Rhonda;

class Config {
  static private $config;

  public function load_file($key, $location){
    self::$config->$key = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'].$location));
  }

  public function load_object($key, $object){
      @self::$config->$key = $object;
  }

  public function get($key) {
    if(property_exists(self::$config, $key)){
      $result = self::$config->$key; 
    }else{
      $result = null;
    }
    return $result;  
  }

}
