<?php

if (!isset($_GET['action_name'])) {
    header("Location: index.php");
    exit;
}

$name = "%".trim($_GET['action_name'])."%";

$dbh = new PDO('mysql:host=127.0.0.1;dbname=dbstock','admin','password');

$sth = $dbh->prepare('SELECT * FROM actions WHERE symbol like :nome');
$sth->bindParam(':nome',$name,PDO::PARAM_STR);
$sth->execute();

$result = $sth->fetchAll(PDO::FETCH_ASSOC);
echo "<pre>";
print_r($result);exit;

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search_result</title>
</head>

<body>
    <h3>Search result: </h3>
    <?php
    if (count($result)) {
        foreach ($result as $results) {

    ?>
            <label><?php echo $results['symbol']; ?></label>
            <br>
        <?php
        }
    } else {
        ?>
        <label>nothing</label>
    <?php
    }
    ?>
</body>

</html>