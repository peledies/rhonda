<?php

echo "<h3>\Rhonda\Boolean</h3>";

// Evaluate string
echo "'false' evaluates to: ".\Rhonda\Boolean::evaluate("false");
echo "</br>";

$boolean = new \Rhonda\Boolean();
echo "'false' evaluates to: ".$boolean->evaluate("false");
echo "</br>";

// Evaluate string
echo "'0' evaluates to: ".\Rhonda\Boolean::evaluate("0");
echo "</br>";

$boolean = new \Rhonda\Boolean();
echo "'random word' evaluates to: ".$boolean->evaluate("random word");
echo "</br>";



// Evaluate string
echo "'true' evaluates to: ".\Rhonda\Boolean::evaluate("true");
echo "</br>";

$boolean = new \Rhonda\Boolean();
echo "'true' evaluates to: ".$boolean->evaluate("true");
echo "</br>";

// Evaluate string
echo "'yes' evaluates to: ".\Rhonda\Boolean::evaluate("yes");
echo "</br>";

$boolean = new \Rhonda\Boolean();
echo "'1' evaluates to: ".$boolean->evaluate("1");
echo "</br>";