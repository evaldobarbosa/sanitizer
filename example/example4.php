<?php
require "autoloader.php";

use Sanitize\Sanitizer;

$str = chr(15) . chr(20) . 'ABCdefGh"I"%$^~Ç&' . chr(215) . chr(220);

$s = Sanitizer::add('string', 'string');

echo "\n=== String ===\n";
echo "Origin: \t\t", $str, "\n";
echo "Encode Amp: \t\t", $s->encodeAmp()->sanitize( $str ), "\n";
echo "Sanitize String: \t", $s->reset()->sanitize( $str ), "\n";
echo "Low: \t\t\t", $s->reset()->low()->sanitize( $str ), "\n";
echo "Encode Low: \t\t", $s->reset()->encodeLow()->sanitize( $str ), "\n";
echo "High: \t\t\t", $s->reset()->high()->sanitize( $str ), "\n";
echo "Encode High: \t\t", $s->reset()->encodeHigh()->sanitize( $str ), "\n";
echo "No Encode : \t\t", $s->reset()->noEncode()->sanitize( $str ), "\n";
echo "Some flags: \t\t", $s->low()->high()->encodeAmp()->sanitize( $str ), "\n";
echo "\n=== More filters ===\n";

$sc = Sanitizer::add('chars', 'sc');
echo "Special chars: \t\t", $sc->sanitize( $str ), "\n";

$mq = Sanitizer::add('quotes', 'mq');
echo "Magic quotes: \t\t", $mq->sanitize( $str ), "\n";