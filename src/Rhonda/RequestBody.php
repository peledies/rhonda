<?php
namespace Rhonda;

class RequestBody
{
    public static function get()
    {
      return json_decode(file_get_contents('php://input'));
    }
}