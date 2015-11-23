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


// Get all request headers
print_r( \Rhonda\Headers:: getallheaders() );

// Mysql escape 
$object = json_decode('{
  "connections": {
    "local": {
      "host": "192.168.99.100"
    , "database": "core_elguapo"
    , "port": "3306"
    , "user": "root"
    , "password": "SECRET"
    }
  }
}');

\Rhonda\Config::load_object('DB', $object);
echo \Rhonda\Mysql:: real_escape("that's all folks");

$object = new \stdClass();
$object->obj = "it's fo sho";
$object->obj2 = "escape's this one too";

$array = array("ray"=>"it's escaping arrays", "ray2"=>"escape's this one too");

echo "<pre>".print_r(\Rhonda\Mysql:: real_escape($object),true)."</pre>";
echo "<pre>".print_r(\Rhonda\Mysql:: real_escape($array),true)."</pre>";
