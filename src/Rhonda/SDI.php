<?php
namespace Rhonda;

class SDI
{
  public static function verify_permissions($flag){    
    $headers = array("Domain"=>getallheaders()['Domain'], "Authorization"=>getallheaders()['Authorization']);
    $api = new \Rhonda\APIGateway('GET','http://elguapo.eventlink.local/authenticate/verify/permissions/'.$flag, null, $headers);
    
    $verified = $api->run();
  }
}