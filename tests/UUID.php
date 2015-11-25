<?php

echo "<h3>\Rhonda\UUID</h3>";

// Create a new UUID
echo \Rhonda\UUID::create();
echo "</br>";

$uuid = new \Rhonda\UUID();
echo $uuid->create();
echo "</br>";