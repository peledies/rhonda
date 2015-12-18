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
  public function register()
  {
    $headers = \Rhonda\Headers:: getallheaders();
    $config = \Rhonda\Config:: get('system');

    if(!empty($config)){
      // see if service is set in the config
      if(!empty($config->host)){
        $service = $config->host;
      }
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

  public function report()
  {
    $chain = (isset(self::$chain)) ? json_decode(self::$chain) : array();

    self::$chain = json_encode($chain);

    $chain_string = join(' => ', array_filter($chain));
    error_log("\n----- Service Chain -----\n" . $chain_string . "\n-------------------------");
    return $chain_string;
  }

  public function add_to_headers($headers){
    //error_log(print_r(self::$chain, TRUE));
    $headers['Service-Chain'] = json_encode(self::$chain);

    return $headers;
  }
}