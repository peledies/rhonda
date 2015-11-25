<?php

echo "<h3>\Rhonda\Strings</h3>";

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