<?php

echo "<h3>\Rhonda\Config</h3>";

// Load an object into memory for later retrieval
$object = new stdClass();
$object->thing_1 = 'something one';
$object->thing_2 = 'something two';
\Rhonda\Config::load_object('test_one', $object);

// Retrieve a configuration object from memory
echo "<pre>";
print_r(\Rhonda\Config::get('test_one'));
echo "</pre>";

$config = new \Rhonda\Config();
$config->load_object('test_two', $object);

echo "<pre>";
print_r($config->get('test_two'));
echo "</pre>";
