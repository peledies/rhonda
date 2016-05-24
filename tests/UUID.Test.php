<?php
class UUID extends PHPUnit_Framework_TestCase
{

  public function test_singleton() {
    // Create a new UUID
    $uuid = \Rhonda\UUID::create();
    $this->assertStringMatchesFormat('%x%x%x%x%x%x%x%x-%x%x%x%x-%x%x%x%x-%x%x%x%x-%x%x%x%x%x%x%x%x%x%x%x%x'
      , $uuid);
  }

  public function test_instantiated_class() {
    $uuid = new \Rhonda\UUID();
    $result = $uuid->create();
    $this->assertStringMatchesFormat(
      '%x%x%x%x%x%x%x%x-%x%x%x%x-%x%x%x%x-%x%x%x%x-%x%x%x%x%x%x%x%x%x%x%x%x'
      , $result);
  }

}
?>