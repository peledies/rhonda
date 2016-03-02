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

echo "</br>Convert 'TRUE' to string: ".\Rhonda\Mysql:: bool_to_string('TRUE');
echo "</br>Convert 'FALSE' to string: ".\Rhonda\Mysql:: bool_to_string('FALSE');
echo "</br>Convert 'true' to string: ".\Rhonda\Mysql:: bool_to_string('true');
echo "</br>Convert 'false' to string: ".\Rhonda\Mysql:: bool_to_string('false');
echo "</br>Convert '0' to string: ".\Rhonda\Mysql:: bool_to_string('0');
echo "</br>Convert '1' to string: ".\Rhonda\Mysql:: bool_to_string('1');
echo "</br>Convert 'asdfghq' to string: ".\Rhonda\Mysql:: bool_to_string('asdfhg');
echo "</br>Convert '' to string: ".\Rhonda\Mysql:: bool_to_string('');
echo "</br>Convert '01' to string: ".\Rhonda\Mysql:: bool_to_string('01');
echo "</br>Convert '10' to string: ".\Rhonda\Mysql:: bool_to_string('10');
echo "</br>Convert NULL to string: ".\Rhonda\Mysql:: bool_to_string(NULL);
echo "</br>Convert -1 to string: ".\Rhonda\Mysql:: bool_to_string(-1);
echo "</br>Convert 0 to string: ".\Rhonda\Mysql:: bool_to_string(0);
echo "</br>Convert 1 to string: ".\Rhonda\Mysql:: bool_to_string(1);
echo "</br>Convert 2 to string: ".\Rhonda\Mysql:: bool_to_string(2);
echo "</br>Convert new stdClass() to string: ".\Rhonda\Mysql:: bool_to_string(new stdClass());
