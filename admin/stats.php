<?php
    require_once("core/init.php");
    
    if(!loggedIn()) {
        header('Location: accessDenied.php');
        exit();
    }
?>
<!doctype html>
<html>
<head>
    <?php require_once("common-head.php"); ?>
    <title>Database Stats</title>
</head>
<body>
<?php require_once("nav.php"); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
               <?php
               if(loggedIn()) {
                    include "includes/sideBar.php";
               }               
               ?>
            </div>
            <div class="col-md-9">
                <h2>Database Stats</h2><hr>
<?php
$englishwords_count = 0; // total english words in database
$eng2hindi_count = 0;   // total english words which are connected to some hindi word
$hindiwords_count = 0;  // total number of hindi words
$eng2ham_count = 0;     // total english words with hamnosys infomation
$ham_count = 0;         // total hamnosys
$authorship = "";       // how many words did each author work on
$verified = 0;          // number of verified hamnosys

$db = connect();

$stmt = $db->prepare("select count(*) as count from englishwords");
$stmt->execute(array());
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$englishwords_count = $result['count'];

$stmt = $db->prepare("select count(*) as count from englishwords where wordid in (select parent from hindiwords)");
$stmt->execute(array());
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$eng2hindi_count = $result['count'];

$stmt = $db->prepare("select count(*) as count from hindiwords");
$stmt->execute(array());
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$hindiwords_count = $result['count'];

$stmt = $db->prepare("select count(*) as count from englishwords where wordid in (select parent from hamnosys)");
$stmt->execute(array());
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$eng2ham_count = $result['count'];

$stmt = $db->prepare("select count(distinct notation) as count from hamnosys");
$stmt->execute(array());
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$ham_count = $result['count'];

$stmt = $db->prepare("select count(*) as count, author FROM hamnosys group by author");
$stmt->execute(array());
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$authorship = $result;

$stmt = $db->prepare("select count(*) as count from hamnosys where verified = 1");
$stmt->execute(array());
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$verified = $result['count'];

$db = null;
?>          <table class="table table-striped">
                <tr>
                    <td>Total english words</td>
                    <td><?php echo $englishwords_count; ?></td>
                </tr>
                <tr>
                    <td>Total english words with corresponding hindi words</td>
                    <td><?php echo $eng2hindi_count; ?></td>
                </tr>
                <tr>
                    <td>Total hindi words</td>
                    <td><?php echo $hindiwords_count; ?></td>
                </tr>
                <tr>
                    <td>Total english words with corresponding hamnosys</td>
                    <td><?php echo $eng2ham_count; ?></td>
                </tr>
                <tr>
                    <td>Unique HamNoSys </td>
                    <td><?php echo $ham_count; ?></td>
                </tr>
                <tr>
                    <td>Authorship Information</td>
                    <td><pre><?php print_r($authorship); ?></pre></td>
                </tr>
                <tr>
                    <td>Total verfified HamNoSys records</td>
                    <td><?php echo $verified; ?></td>
                </tr>
                <tr>
                    <td>Percentage of records verfified</td>
                    <td><?php echo ($verified / $ham_count) * 100; ?></td>
                </tr>
            </table>           
            </div>
        </div>
    </div>   
<?php require_once("footer.php"); ?>
    

    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
