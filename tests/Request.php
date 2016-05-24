<?php
/*
echo "<h3>\Rhonda\Request</h3>";

// package the request data into a singleton to be
// used later in the code
\Rhonda\Request::packager();

// Retrieve a provided request body
try {
  echo json_encode(\Rhonda\Request::get());
} catch (Exception $e) {
  echo "No raw POST body.";
}*/

class RequestGET extends PHPUnit_Framework_TestCase
{
  protected function setUp()
  {
    $_GET = "a={a:1}&b={b:2}";
  }

  public function test_GET_request_parsing() {
    echo json_encode(\Rhonda\Request::get());
  }

  protected function tearDown()
  {
    $_GET = null;
  }

}
?>