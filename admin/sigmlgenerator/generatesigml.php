<?php
    require_once("../core/init.php");

    $db = connect();
    $stmt = $db->prepare("select wordname, notation from englishwords, hamnosys where englishwords.wordid = hamnosys.parent");
	$stmt->execute(array());
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	echo "<pre>";
	foreach ($result as $item) {
		$gloss = $item['wordname'];
		$ham = $item['notation'];
		echo $gloss;

		$filename = str_replace(" ", "", $gloss).".sigml";

		$res = hamconvert($ham, $gloss);

		if($res != False) {
			$fp = fopen($filename, "w");
			fwrite($fp, $res);
			fclose($fp);
		}

	}
	echo "</pre>";
?>