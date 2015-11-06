<?php
namespace Rhonda;

class APIGateway{

  /**
  * Class constructor for api connection tool
  *
  * @param String - GET,POST,PUT,DELETE
  * @param String - API route to be called
  * @param Object - Data to be sent along with the request (optional)
  * @param String - Headers, additional headers (optional)
  *
  * @example
  * <code>
  *  $post_body = (object) array("name"=>"John", "pass"=>"doe");
  *  $headers = array("Domain"=>"some string", "Authorization"=>"some string");
  *  $api = new \Rhonda\APIGateway('GET','http://example.com', $post_body, $headers);
  *  $result = $api->run();
  * </code>
  *
  * @return Return
  *
  * @since   2015-11-05
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
    * Makes an HTTP request to the supplied URL
    *
    * @return  JSON - The response returned by the service
    *
    * @since   2015-11-05
    * @author  Deac Karns <deac@sdicg.com>
    */ 
  public function run(){
    $contents = file_get_contents($this->url, false, $this->context);
    if(!strpos($http_response_header[0], '200')){
      $contents = json_decode($contents);
      if(property_exists($contents, 'message')){
        $body = $contents->message;
      }else{
        $body = implode(" - ", $http_response_header);
      }
      throw new \Exception($body);
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