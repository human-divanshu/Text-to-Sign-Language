<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_GET['l'])) {

	$text = trim($_GET['l']);
	
	$fp = fopen("hindi.input.txt","w");
	fwrite($fp, $text);
	fclose($fp);

	shell_exec("make hindi.output");

	$output = file_get_contents("hindi.output");

	$lines = explode("\n", $output);

	print_r($lines);

	foreach($lines as $line) {
		if(!empty(trim($line))) {
			$words = explode("\t", $line);
			//$word = $words[2];
			print_r($words);
		}
	}

}

?>