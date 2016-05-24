<?php

class ServiceChainConfigTest extends PHPUnit_Framework_TestCase
{

  private function add_config_options(){
    // Load an object into memory for internal config testing
    $object = new stdClass();
    $object->host = 'Internal-Service';
    \Rhonda\Config::load_object('system', $object);
  }

  private function spoof_headers(){
    $_SERVER['HTTP_SERVICE_CHAIN'] = '["External-Service-1","External-Service-2"]';
  }

  protected function setUp()
  {
    self::add_config_options();
    self::spoof_headers();
    \Rhonda\ServiceChain:: register();
  }

  public function test_service_chain() {
    $chain = json_decode($_SERVER['HTTP_SERVICE_CHAIN']);
    $this->assertCount(3,$chain);
    $this->assertEquals('Internal-Service',$chain[2]);
  }

  protected function tearDown(){
    unset($_SERVER['HTTP_SERVICE_CHAIN']);
    \Rhonda\Config::unset_object('system');
  }

}
?>