<?php

echo "<h3>\Rhonda\RequestBody</h3>";

// Retrieve a provided request body
try {
  echo json_encode(\Rhonda\RequestBody::get());
} catch (Exception $e) {
  echo "No raw POST body.";
}

try {
  $request_body = new \Rhonda\RequestBody();
  echo json_encode($request_body->get());
} catch (Exception $e) {
  echo "No raw POST body.";
}