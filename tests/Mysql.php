<?php

echo "<h3>\Rhonda\Mysql</h3>";

// Mysql escape 
$object = json_decode('{
  "connections": {
    "local": {
      "host": "192.168.99.100"
    , "database": "core_elguapo"
    , "port": "3306"
    , "user": "root"
    , "password": "SECRET"
    }
  }
}');

\Rhonda\Config::load_object('DB', $object);
echo \Rhonda\Mysql:: real_escape("that's all folks");

$object = new \stdClass();
$object->obj = "it's fo sho";
$object->obj2 = "escape's this one too";

$array = array("ray"=>"it's escaping arrays", "ray2"=>"escape's this one too");

echo "<pre>".print_r(\Rhonda\Mysql:: real_escape($object),true)."</pre>";
echo "<pre>".print_r(\Rhonda\Mysql:: real_escape($array),true)."</pre>";
