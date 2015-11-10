<?php
namespace Rhonda;

/**
* Class to handle error related tasks
*
* @category  Class
* @version   0.0.1
* @since     2015-11-06
* @author    Deac Karns <deac@sdicg.com>
*/
class Error
{
    /**
    * Format exceptions for return as an objcet and pretty formating in
    * the error log with a complete stack trace
    *
    * @param Resource - Exception resource
    * @param Integer - Custom http response code
    * 
    * @example
    * <code>
    *   try{
    *     throw new Exception("Demo Error Exception");
    *   }catch(\Exception $e){
    *     echo \Rhonda\Error::handle($e);
    *   }
    * </code>
    *
    * @example
    * <code>
    *   try{
    *     throw new Exception("Demo Error Exception");
    *   }catch(\Exception $e){
    *     $error = new \Rhonda\Error();
    *     echo $error->handle($e);
    *   }
    * </code>
    *
    * @return Return
    *
    * @since   2014-24-11
    * @author  Deac Karns <deac@sdicg.com> 
    **/
    public static function handle($e, $status = 400)
    {
      error_log($e->getMessage()."\n------\n".$e->getTraceAsString()."\n------\n");
      http_response_code($status);
      return json_encode(array("code"=>$status, "message"=>$e->getMessage()));
    }
}