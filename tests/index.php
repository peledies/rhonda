<?php
require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload

// spoof an existing service chain header
$_SERVER['HTTP_SERVICE_CHAIN'] = '["External-Service","events.eventlink.local","facilities.eventlink.local"]';

// If your using ServiceChain, register should be one of the first things you do in your application
\Rhonda\ServiceChain:: register();

foreach (glob("./*.php") as $filename)
{
  if($filename != "./index.php"){
    include $filename;
  }
}

?>