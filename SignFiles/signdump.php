<?php

/*
	Get all sigml file in this folder
	convert them into json and dump them

	This will be loaded by the ui when the 
	avatar will play hello sign

	use gzip for json to make the file size
	small
*/

	$files = glob("*.sigml");

	$result = array();

	foreach ($files as $file) {
		$cmd = "cat ".$file." | tr -d '\t\n\r'";
		$output = shell_exec($cmd);

		//array_push($result, array())
		$filearr = explode(".", $file);
		$newarr = array('w'=>$filearr[0], 's' => $output);

		array_push($result, $newarr);
	}

	echo json_encode($result);

?>