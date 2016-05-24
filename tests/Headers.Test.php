<?php
class Headers extends PHPUnit_Framework_TestCase
{

  /**
    * @runInSeparateProcess
    */
  public function test_header_retrieval() {
    header('Test-Header: Test-Value');
    //echo \Rhonda\Headers:: getallheaders();
    $this->assertContains(
        'Test-Header: Test-Value'
      , \Rhonda\Headers::getallheaders()
    );
  }

}
?>