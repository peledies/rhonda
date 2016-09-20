<?php

echo "<h3>\Rhonda\Arrays</h3>";

// Verify email string structure
try{
  // PASS NON EMPTY CHECK
  $array = array("non_empty_property");
  if(\Rhonda\Arrays:: empty_property_check($array)){
  	echo "We do not have any empty properties SUCCES!";
  }else{
  	echo "Something went wrong";
  }
  
  // PASS EMPTY CHECK
  $array = array("");
  if(!\Rhonda\Arrays:: empty_property_check($array)){
  	echo "We discover empty properties SUCCES!";
  }else{
  	echo "Something went wrong";
  }

  // Catch will be invoked
}catch(\Exception $e){
  echo \Rhonda\Error:: handle($e);
}
