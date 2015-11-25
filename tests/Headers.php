<?php

echo "<h3>\Rhonda\Headers</h3>";

// Get all request headers
echo "<pre>";
print_r( \Rhonda\Headers:: getallheaders() );
echo "</pre>";