<?php 

require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload

echo \Rhonda\UUID::create();
echo "</br>";

$uuid = new \Rhonda\UUID();
echo $uuid->create();
echo "</br>";

echo json_encode(\Rhonda\RequestBody::get());
echo "</br>";

$request_body = new \Rhonda\RequestBody();
echo json_encode($request_body->get());
echo "</br>";

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

$object = new stdClass();
$object->thing_1 = 'something one';
$object->thing_2 = 'something two';
\Rhonda\Config::load_object('test_one', $object);

echo json_encode(\Rhonda\Config::get('test_one'));
echo "</br>";

$config = new \Rhonda\Config();
$config->load_object('test_two', $object);

echo json_encode($config->get('test_two'));
echo "</br>";

try{
  $headers = array("Domain"=>"domain_1", "Authorization"=>"sometoken");
  $data = (object) array("handle"=>"demo_1", "password"=>"asdf");
  $api = new \Rhonda\APIGateway('POST','http://elguapo.eventlink.local/authenticateasdf/',$data, $headers);
  $data = $api->run();
}catch(\Exception $e){
  $error = new \Rhonda\Error();
  echo $error->handle($e);
}

echo $data;
echo "</br>";

try{
  $SDI = new \Rhonda\SDI();
  $SDI->verify_permissions('calendar_list');
}catch(\Exception $e){
  $error = new \Rhonda\Error();
  echo $error->handle($e);
}
