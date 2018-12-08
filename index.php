<?php
error_reporting(-1);
ini_set('display_errors','On');

$factory = require_once(__DIR__ . '/Scales.php');

$info = null;
if ($_GET) {
	if(in_array($_GET['action'],['search','search-by'])){
		$_GET['args'][0] = explode(' ',$_GET['args'][0]);
	}

	$info = $factory($_GET['action'],$_GET['args']);
}

require_once __DIR__ . '/View.php';