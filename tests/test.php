<?php 

require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload

// Create a new UUID
echo \Rhonda\UUID::create();
echo "</br>";

$uuid = new \Rhonda\UUID();
echo $uuid->create();
echo "</br>";


// Retrieve a provided request body
echo json_encode(\Rhonda\RequestBody::get());
echo "</br>";

$request_body = new \Rhonda\RequestBody();
echo json_encode($request_body->get());
echo "</br>";


// Format an exception the error log and for return
try{
  throw new Exception("Demo Error Exception");
}catch(\Exception $e){
  echo \Rhonda\Error::handle($e);
}
echo "</br>";

try{
  throw new Exception("Demo Error Exception");
}catch(\Exception $e){
  $error = new \Rhonda\Error();
  echo $error->handle($e);
}
echo "</br>";


// Load an object into memory for later retrieval
$object = new stdClass();
$object->thing_1 = 'something one';
$object->thing_2 = 'something two';
\Rhonda\Config::load_object('test_one', $object);

// Retrieve a configuration object from memory
echo json_encode(\Rhonda\Config::get('test_one'));
echo "</br>";

$config = new \Rhonda\Config();
$config->load_object('test_two', $object);

echo json_encode($config->get('test_two'));
echo "</br>";


// Make a request to an external address with custom headers and a request body
try{
  $headers = array("Domain"=>"domain_1", "Authorization"=>"sometoken");
  $data = (object) array("handle"=>"demo_1", "password"=>"asdf");
  $api = new \Rhonda\APIGateway('POST','http://elguapo.eventlink.local/authenticateasdf/',$data, $headers);
  $data = $api->run();
  echo $data;
}catch(\Exception $e){
  $error = new \Rhonda\Error();
  echo $error->handle($e);
}


echo "</br>";


// Verify email string structure
try{
  // PASS
  $string = 'test@test.com';
  \Rhonda\Strings:: validate_or_error('email',$string);

  // FAIL
  $string = 'test@test';
  \Rhonda\Strings:: validate_or_error('email',$string);

  // Catch will be invoked
}catch(\Exception $e){
  echo \Rhonda\Error:: handle($e);
}
echo "</br>";


// Normalize a string
$input = 'Some TEST-@#string#-yo-#$-$#';
echo \Rhonda\Strings:: normalize($input);
echo "</br>";