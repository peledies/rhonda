<?php

class ServiceChainGenericTest extends PHPUnit_Framework_TestCase
{

  private function spoof_headers(){
    $_SERVER['HTTP_SERVICE_CHAIN'] = '["External-Service-1","External-Service-2"]';
  }

  protected function setUp()
  {
    self::spoof_headers();
    \Rhonda\ServiceChain:: register();
  }

  public function test_service_chain() {
    $chain = json_decode($_SERVER['HTTP_SERVICE_CHAIN']);
    $this->assertCount(3,$chain);
    $this->assertEquals('Generic-Service',$chain[2]);
  }

  protected function tearDown(){
    unset($_SERVER['HTTP_SERVICE_CHAIN']);
  }

}

?>