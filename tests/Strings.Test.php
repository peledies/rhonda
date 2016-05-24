<?php
class Strings extends PHPUnit_Framework_TestCase
{

  public function test_valid_email() {
    $string = 'test@test.com';
    $valid = \Rhonda\Strings:: validate_or_error('email',$string);
    $this->assertTrue($valid);
  }

  /**
   * @expectedException        Exception
   * @expectedExceptionMessage Invalid email Format
   */
  public function test_invalid_email() {
    $string = 'test@test';
    \Rhonda\Strings:: validate_or_error('email',$string);
  }

  public function test_normalize_string() {
    // Normalize a string
    $input = 'Some TEST-@#string#-yo-#$-$#';
    $normalized = \Rhonda\Strings:: normalize($input);
    $this->assertEquals($normalized, 'some_test_string_yo');
  }

}
?>