<?php

echo "<h3>\Rhonda\JSON</h3>";

// Encode json value with numerics
$value = array('a' => '1', 'b' => '2', 'c' => '3', 'd' => '4', 'e' => '5', 'string' => 'don\'t convert me!');
echo \Rhonda\JSON:: encode_numeric($value);
echo "</br>";