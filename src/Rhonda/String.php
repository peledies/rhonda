<?php
namespace Rhonda;

/**
* Class to handle String verification and modification tasks
*
* @category  Class
* @version   0.0.1
* @since     2015-11-10
* @author    Deac Karns <deac@sdicg.com>
*/
class String
{
  /**
  * Validate a string as a valid 'type' string
  * 
  * @example
  * <code>
  *   \Rhonda\String:: validate('email', 'test@test.com'));
  * </code>
  *
  * @example
  * <code>
  *   $tmp = new \Rhonda\String();
  *   $tmp->validate('email', 'test@test.com');
  * </code>
  * @return Boolean - True / False
  *
  * @since   2015-11-10
  * @author  Deac Karns <deac@sdicg.com>
  * @author  Wesley Dekkers <wesley@sdicg.com>
  **/
  public static function validate($type ,$string)
  {
    switch ($type){
      case 'email':
        $result = (filter_var($string, FILTER_VALIDATE_EMAIL));
        break;

      case 'username':
        $result = (preg_match("/[^a-z0-9\.\-\_]/", $string));
        break;

      default:
        throw new \Exception("Invalid Type Inquiry");
    }
    
    return $result;
  }

  /**
  * Validate a string as a valid 'type' string. Throws an exception if false
  * 
  * @example
  * <code>
  *   \Rhonda\String:: validate_or_error('email', 'test@test.com'));
  * </code>
  *
  * @example
  * <code>
  *   $tmp = new \Rhonda\String();
  *   $tmp->validate_or_error('email', 'test@test.com');
  * </code>
  * @return Boolean - True or throws an exception
  *
  * @since   2015-11-10
  * @author  Deac Karns <deac@sdicg.com> 
  **/
  public static function validate_or_error($type, $string){

    if(self::validate($type, $string)){
      return true;
    }else{
      throw new \Exception("Invalid ".$type." Format");
    }
  }

  /**
  * Normalize a string to an all lowercase snake_cased string
  * 
  * @example
  * <code>
  *   \Rhonda\String:: normalize('Some TEST-@#string#-yo-#$-$#');
  *
  *   // Returns
  *   some_test_string_yo
  * </code>
  *
  * @return String - normalized string
  *
  * @since   2015-11-10
  * @author  Deac Karns <deac@sdicg.com> 
  **/
  public static function normalize($string){
    // convert the string to lowercase
    $string = strtolower($string);

    // change spaces and dashes to underscores
    $string = preg_replace("/\s|-/", "_", $string);

    // remove any nonword characters
    $string = preg_replace("/\W/", "", $string);

    // trim trailing underscores if they exist
    $string = rtrim($string, "_");
    return $string;
  }
}