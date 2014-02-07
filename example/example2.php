<?php
require "autoloader.php";

use Sanitize\Sanitizer;

$phone = Sanitize\Sanitizer::add('phone','phone');

echo $phone->sanitize("88485827") . "\n";
echo $phone->sanitize("9888485827") . "\n";

try {
	echo $phone->sanitize("9888.485827") . "\n";
} catch ( \Exception $e ) {
	echo $e->getMessage();
}