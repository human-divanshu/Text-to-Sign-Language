<?php

/*
*	Convert HamNoSys to Sigml online
*/

function mb_str_split( $string ) { 
    # Split at all position not after the start: ^ 
    # and not before the end: $ 
    return preg_split('/(?<!^)(?!$)/u', $string ); 
} 

function hamconvert($ham, $gloss)
{
	// get all ham symbols from the database

	$db = connect();

	$stmt = $db->prepare("select * from h2s");
	$stmt->execute(array());
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	$hamarray = array(); // create associative array for ham symbols

	foreach ($result as $item) {
		$hamarray[$item['hamsymbol']] = $item['tagname'];
	}

	$db = null;

	// value to be returned by the function
	$sigml = "<sigml>\n";

	$sigml .= "<hns_sign gloss=\"" . $gloss . "\">\n";
	$sigml .= "\t<hamnosys_nonmanual>\n";

	$sigml .= "\t</hamnosys_nonmanual>\n";
	$sigml .= "\t<hamnosys_manual>\n";

	$ham = trim($ham);
	//$ham = str_split($ham);
	$ham = mb_str_split($ham);

	try {
		foreach ($ham as $key) {		
			$sigml .= "\t\t<" . $hamarray[$key] . "/>\n";	
		}
	} catch(Exception $e) {
		echo "Error occured while processing : " . $gloss;
		return False;
	}

	$sigml .= "\t</hamnosys_manual>\n";
	$sigml .= "</hns_sign>\n";
	$sigml .= "</sigml>";

	return $sigml;
}

?>