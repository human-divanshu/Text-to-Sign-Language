<table class="table table-striped">

<?php

$content = file_get_contents("admin/examples.txt");

$sentences = explode("\n", $content);

foreach ($sentences as $line) {
	$line = trim($line);
	if(!empty($line)) {
		echo "<tr>";
		echo "<td>".$line."</td>";
		echo "<td><button type='button' class='btn btn-default btn-sm' ";
		echo "onclick=\"playsign('".$line."');\"";
		echo ">Play <i class='glyphicon glyphicon-play'></i></button></td>";
		echo "</tr>";
	}
}

?>
</table>