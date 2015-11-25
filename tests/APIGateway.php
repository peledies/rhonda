<?php

echo "<h3>\Rhonda\APIGateway</h3>";

// Make a request to an external address with custom headers and a request body
try{
  $headers = array("Domain"=>"domain_1", "Authorization"=>"sometoken");
  $data = (object) array("handle"=>"demo_1", "password"=>"asdf");
  $api = new \Rhonda\APIGateway('POST','http://elguapo.eventlink.local/authenticate/',$data, $headers);
  $data = $api->run();
  echo "<pre>";
  print_r($data);
  echo "</pre>";
}catch(\Exception $e){
  $error = new \Rhonda\Error();
  echo $error->handle($e);
}
