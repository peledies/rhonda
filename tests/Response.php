<h3>\Rhonda\Response</h3>

<?php

$data = "Will we have success";
\Rhonda\Error:: add_summary_item("We show an error");

echo "<pre>";
	print_r(\Rhonda\Response:: package($data));
echo "</pre>";


