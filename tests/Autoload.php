<?php

echo "<h3>\Rhonda\Autoload</h3>";

// Automatically load all php files in a directory

\Rhonda\Autoload:: path(__DIR__.'../Rhonda/')
echo "All files in the directory Rhonda have been loaded";