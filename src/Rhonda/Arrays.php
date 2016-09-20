<?php
namespace Rhonda;

/**
* Class to handle Array verification and modification tasks
*
* @category  Class
* @version   0.0.1
* @since     2016-09-20
* @author    Wesley Dekkers <wesley@sdicg.com>
*/
class Arrays
{
  /**
   * Checks if there is an empty property in an array or object
   *
   * @param **Array** / **Object**
   *
   * @example
   * <code>
   *   \Rhonda\Array:: empty_property_check(**Array**);
   * </code>
   *
   * @return  Boolean
   *
   * @since   2016-09-20
   * @author  Wesley Dekkers <wesley@sdicg.com>
   **/
  public static function empty_property_check($array, $exception = TRUE) {
    if(!is_array($array) && !is_object($array) && $exception){
      throw new \Exception("Not a valid Array or Object given", 400);
    }
    $result = TRUE;
    
    foreach ($array as $key => $value) {
      if(empty($value)){
        $result = FALSE;
        break;
      }
    }

    return $result;
  }
}