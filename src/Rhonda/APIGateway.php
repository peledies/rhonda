<?php
namespace Rhonda;

/**
 * Class to handle APIGateway related tasks
 *
 * @category  Class
 * @version   0.0.1
 * @since     2015-11-06
 * @author    Deac Karns <deac@sdicg.com>
 */
class APIGateway{

  /**
   * Class constructor for api connection tool. The constructor will forward all existing headers.
   *
   * @param String - GET,POST,PUT,DELETE
   * @param String - API route to be called
   * @param Object - Data to be sent along with the request  - (optional)
   * @param Array  - Custom additional headers               - (optional)
   *
   * @example
   * <code>
   *  $post_body = (object) array("name"=>"John", "pass"=>"doe");
   *  $headers = array("Domain"=>"some string", "Authorization"=>"some string");
   *  $api = new \Rhonda\APIGateway('GET','http://example.com', $post_body, $headers);
   *  $result = $api->run();
   * </code>
   *
   * @since   2015-11-05
   * @author  Deac Karns <deac@sdicg.com>
   **/
  function __construct($verb, $url, $data=NULL, $additional_headers=array()) {
    $this->verb = $verb;
    $this->url = $url;
    $this->data = $data;

    // Look for existing headers and forward them along as well. Existing headers will not be overwritten.
    $headers = array_merge($additional_headers, \Rhonda\Headers:: getallheaders());
    unset($headers['Host']);
    unset($headers['Content-Length']);

    $this->headers = $headers;

    $this->makeContext();
  }

  /**
   * Makes an HTTP request to the provided URL
   *
   * @param   Boolean - should this throw an exception? (Default = TRUE)
   *
   * @return  **Object** - 
   * Example response object
   * <code>
   * {
   *  status: "http_response_header",
   *  route: "STRING",
   *  errors: "ARRAY/OBJECT/STRING",
   *  data: "ARRAY/OBJECT/STRING"
   * }
   * </code>
   *
   * @since   2015-11-05
   * @author  Deac Karns <deac@sdicg.com>
   * @author  Wesley Dekkers <wesley@sdicg.com>
   */
  public function run($throw_exception=TRUE){
    $contents = json_decode(file_get_contents($this->url, false, $this->context));
    
    $result = new \stdClass();
    $result->status = $http_response_header[0];
    $result->route = $this->url;
    $result->errors = "";
    $result->success = TRUE;

    if(!strpos($http_response_header[0], '200')){
      if(is_object($contents) && !empty($contents->errors)){
        foreach ($contents->errors as $error) {
          \Rhonda\Error:: add_summary_item($error);
        }
      }else{
        \Rhonda\Error:: add_summary_item(implode(" - ", $http_response_header));
      }

      $result->errors = \Rhonda\Error:: summary();
      $result->success = FALSE;

      // When hard error End call here
      if($throw_exception){
        throw new \Exception("Rhonda API Gateway detected an error");
      }
    }
      
    $result->data = $contents->data;
    
    return $result;
  }

  /**
   * Creates a resource containing HTTP request information
   *
   * @return  Resource - Contains HTTP request information based on the provided parameters
   *
   * @since   2015-11-06
   * @author  Deac Karns <deac@sdicg.com>
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