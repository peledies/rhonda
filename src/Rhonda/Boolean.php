<?php
namespace Rhonda;

/**
* Class to handle Boolean conveniences
*
* @category  Class
* @version   0.0.1
* @since     2016-03-02
* @author    Wesley Dekkers <wesley@sdicg.com>
*/
class Boolean
{
  
  /**
  * Read input and set value to boolean
  *
  * @param Parameter - String or boolean
  *
  * @example
  * <code>
  * Useage Example
  * </code>
  *
  * Return an Boolean
  * @example
  * <code>
  *   $string = "true";
  *   $boolean = \Rhonda\Boolean::real_escape($string);
  * </code>
  *
  * @return BOOL - 1 or 0 (true or false)
  *
  * @since   2016-03-02
  * @author  Wesley Dekkers <wesley@sdicg.com> 
  **/
  public static function evaluate($input) {
    return (filter_var($input, FILTER_VALIDATE_BOOLEAN))? TRUE:FALSE;
  } 
}