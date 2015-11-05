<?php
namespace Rhonda;

class Error
{
    public static function handle($e, $status = 400)
    {
      error_log($e->getMessage()."\n------\n".$e->getTraceAsString()."\n------\n");
      http_response_code($status);
      return json_encode(array("code"=>$status, "message"=>$e->getMessage()));
    }
}