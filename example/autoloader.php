<?php
function __autoload($classname) {
	$classname = str_replace("\\","/",$classname);
	$baseDir = realpath( dirname(__FILE__) . "/../src" );

	require "{$baseDir}/{$classname}.php";
}