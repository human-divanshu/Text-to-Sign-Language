<?php
/*
	Convert given english sentence to
	its root word
*/
include('vendor/autoload.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// use Wamania\Snowball\English;
use Skyeng\Lemmatizer;
use Skyeng\Lemma;

include("islblock.php");

if (isset($_GET['l'])) {

	$text = trim($_GET['l']);
	$s = preg_replace('/[^a-z\d]+/i', '_', $text);

	// $stemmer = new English();
	$lemmatizer = new Lemmatizer();
	
	$result = array();
	$input = explode("_", $s);

	//print_r($input);

	foreach ($input as $word) {
		if(!empty($word))
			// array_push($result, $stemmer->stem($word));
			array_push($result, $lemmatizer->getOnlyLemmas($word)[0]);
	}

	$final = array_diff($result,$blockedwords);
	
	$newfinal = array();

	foreach ($final as $val) {
		array_push($newfinal, $val);
	}

	echo json_encode($newfinal);
}
?>