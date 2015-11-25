<?php
require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload

foreach (glob("./*.php") as $filename)
{
  if($filename != "./index.php"){
    include $filename;
  }
}
?>