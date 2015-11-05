<?php
namespace Rhonda;

class APIGateway{

  /**
  * Class constructor for api connection tool
  *
  * @param String - GET,POST,PUT,DELETE
  * @param String - API route to be called
  * @param Object - Data to be sent along with the request
  * @param String - API to connect to (pinwheel, galaxy)
  *
  * @example
  * <code>
  *  $headers = array("Domain"=>"domain_1", "Authorization"=>"sometoken");
  *  $api = new \Rhonda\APIGateway('GET','user/user_201412041437240x85341200x8460742',null,'users','domain_id','auth_token');
  *  $data = $api->run();
  * </code>
  *
  * @return Return
  *
  * @since   2015-09-22
  * @author  Deac Karns <deac@sdicg.com> 
  **/
  function __construct($verb, $url, $data=NULL, $headers=NULL) {
    $this->verb = $verb;
    $this->url = $url;
    $this->data = $data;
    $this->headers = $headers;

    $this->makeContext();
  }

  function __destruct() {
     //echo "kaboom!";
  }

  /**
    * Makes an HTTP request to the supplied pinwheel service
    *
    * @return  JSON - The response returned by the service
    *
    * @since   2015-09-22
    * @author  Deac Karns <deac@sdicg.com>
    */ 
  public function run(){
    $contents = file_get_contents($this->url, false, $this->context);
    if(!strpos($http_response_header[0], '200')){
      throw new \Exception(json_decode($contents)->message);
    }

    return $contents;
  }

  /**
    * Creates a resource containing HTTP request information 
    *
    * @return  Resource - Contains HTTP request information based on the supplied parameters
    *
    * @since   2015-09-22
    * @author  Deac Karns <deac@sdicg.com>
    * @todo    only use domain and auth token if they are provided
    */ 
  private function makeContext(){
    // make headers string
    $headers = NULL;
    foreach ($this->headers as $key => $value) {
      $headers .= $key . ": " . $value . "\r\n";
    }

    $data = json_encode($this->data);
    $this->context = stream_context_create(array (
      'http' => array (
        'ignore_errors'=> TRUE,
        'method' => $this->verb,
        'header'=> "Content-type: application/json\r\n"
        . "Content-Length: " . strlen($data) . "\r\n"
        . $headers,
        'content' => $data
      )
    ));
  }

}