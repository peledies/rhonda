<?php
namespace Rhonda;

/**
 * Class to handle Service Chain related tasks
 *
 * @category  Class
 * @version   0.0.1
 * @since     2015-12-17
 * @author    Deac Karns <deac@sdicg.com>
 */
class ServiceChain
{
  static private $chain;
  /**
   * Registers a service to be used with the service chain
   *
   * @return  Void
   *
   * @since   2015-12-17
   * @author  Deac Karns <deac@sdicg.com>
   */
  public function register($name=NULL)
  {
    $headers = \Rhonda\Headers:: getallheaders();
    $config = \Rhonda\Config:: get('system');

    if(empty($name) && !empty($config)){
      // see if service is set in the config
      if(!empty($config->host)){
        $service = $config->host;
      }
    }else if(!empty($name)){
      $service = $name;
    }else{
      $service = "Generic-Service";
    }

    $chain = (isset($headers['Service-Chain'])) ? json_decode($headers['Service-Chain']) : array();
    if (count($chain) < 1) {
      // Add the referrer to the chain if it exists
      if(isset($_SERVER['HTTP_REFERER']) && !is_null($_SERVER['HTTP_REFERER'])){
        $ref = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST);
      }else if(!empty($_SERVER['HTTP_HOST'])){
        $ref = parse_url($_SERVER['HTTP_HOST'], PHP_URL_HOST);
      }else{
        $ref = "External-Request";
      }

      $chain[] = $ref;
    }
    $chain[] = $service;
    self::$chain = json_encode($chain);
    $_SERVER['HTTP_SERVICE_CHAIN'] = self::$chain;
  }
  /**
   * Report the existing service chain state to the error log. also
   * returns the Service-chain as a string
   *
   * @param   Boolean - If TRUE an array will be returned
   *
   * @return  String (default) or Array of the service chain
   *
   * @since   2015-12-17
   * @author  Deac Karns <deac@sdicg.com>
   */
  public function report($array=FALSE)
  {
    $chain = (isset(self::$chain)) ? json_decode(self::$chain) : array();

    self::$chain = json_encode($chain);

    $chain_string = join(' => ', array_filter($chain));
    error_log("\n----- Service Chain -----\n" . $chain_string . "\n-------------------------");

    return ($array)? $chain : $chain_string;
  }

}