<?php
require "autoloader.php";

use Sanitize\Sanitizer;

$intFilter = Sanitize\Sanitizer::add('int','n1');
$numFilter = Sanitize\Sanitizer::add('float','f1');
	$thousand = $numFilter->thousand();

echo $intFilter->sanitize("12X0") . "\n";
echo $numFilter->sanitize("12.0") . "\n";
echo $numFilter->sanitize("12,0") . "\n";
echo $thousand->sanitize("12.000,00") . "\n";
echo $thousand->sanitize("12,000,00") . "\n";