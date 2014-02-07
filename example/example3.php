<?php
use Infra\Sanitize\Sanitizer;
$path = realpath( dirname(__FILE__) . "/../src" );
require "{$path}/Sanitize/Sanitizer.php";

//This uses only php filter_sanitize_email
$email = Sanitizer::add('email', 'normal');

//This applies regex to replace some characters
$strict = Sanitizer::add('email', 'strict')->strict();

$my_email = 'so$!m\e(one)@exa\\mple.com';

echo $email->sanitize( $my_email ), "\n";
echo $strict->sanitize( $my_email ), "\n";

$my_url = 'http://win@my.sa$[nitize.dev';

//This uses only php filter_sanitize_url
$url = Sanitizer::add('url', 'url');
echo $url->sanitize($my_url), "\n";

//Sets strict mode to object '$url'
$ustrict = $url->strict();
echo $ustrict->sanitize($my_url), "\n";