<?php
    require_once("core/init.php");
?>
<!doctype html>
<html>
<head>
    <?php require_once("common-head.php"); ?>
    <title>page title</title>
</head>
<body>
<?php require_once("nav.php"); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Test Page</h2><hr>
<?php

$db = connect();

$stmt = $db->prepare("select * from hindiwords");
$stmt->execute(array());
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($result as $item) {
    echo "Hindi word : <span>".$item['wordname']."</span><br>";
    echo "Parent id : ".$item['parent']."<br><br>";
}

$db = null;

?>
            </div>
        </div>
    </div>   
<?php require_once("footer.php"); ?>
    

    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
