<?php
/*
	Convert given english sentence to
	its root word
*/
include('vendor/autoload.php');


use Wamania\Snowball\English;

include("islblock.php");

if (isset($_GET['l'])) {

	$text = trim($_GET['l']);
	$s = preg_replace('/[^a-z\d]+/i', '_', $text);

	$stemmer = new English();
	
	$result = array();
	$input = explode("_", $s);

	//print_r($input);

	foreach ($input as $word) {
		if(!empty($word))
			array_push($result, $stemmer->stem($word));
	}

	$final = array_diff($result,$blockedwords);
	
	$newfinal = array();

	foreach ($final as $val) {
		array_push($newfinal, $val);
	}

	echo json_encode($newfinal);
}
?>