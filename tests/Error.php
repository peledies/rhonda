<?php

echo "<h3>\Rhonda\Error</h3>";

// Format an exception the error log and for return
try{
  throw new Exception("Demo Error Exception 1");
}catch(\Exception $e){
  echo \Rhonda\Error::handle($e);
}
echo "</br>";

try{
  throw new Exception("Demo Error Exception 2");
}catch(\Exception $e){
  $error = new \Rhonda\Error();
  echo $error->handle($e);
}
echo "</br>";

try{
  throw new Exception("Demo Error Exception 3", 404);
}catch(\Exception $e){
  $error = new \Rhonda\Error();
  echo $error->handle($e);
}
echo "</br>";

try{
  throw new Exception("Demo Error Exception 4");
}catch(\Exception $e){
  $error = new \Rhonda\Error();
  echo $error->handle($e, 402);
}

\Rhonda\Error:: deprecation_warning("message", "http://alternate/route");
echo "</br>";

$error = new \stdClass();
$error->code = 444;
$error->message = "test message";

\Rhonda\Error:: add_summary_item($error);
\Rhonda\Error:: add_summary_item($error);

echo "<pre>";
print_r(\Rhonda\Error:: summary());
echo "</pre>";
echo "</br>";