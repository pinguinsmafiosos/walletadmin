<?php
include("conexao.php");

if (!isset($_SESSION)) {
    session_start();
}

$tdlen = (int)$_POST['tdlen'];
$editlen = (int)$_POST['editlen'];

$cods = [];
for ($i=1; $i <= $tdlen ; $i++) {
    $cods[$i] = $_POST["money$i"];
}
$rawCotsCopy = [];
for ($i=1; $i <= $editlen ; $i++) {
    $rawCotsCopy[$i] = $_POST["rawCotsEdit$i"];
}
$idsF = [];
for ($i=1; $i <= $editlen ; $i++) {
    $idsF[$i] = $_POST["idsF$i"];
}
$vedit = [];
for ($i=1; $i <= $editlen ; $i++) {
    $vedit[$i] = $_POST["vedit$i"];
}
$editCod = [];
for ($i=1; $i <= $editlen ; $i++) {
    $editCod[$i] = $_POST["editcode$i"];
}

//sort rawCots
$rawCots = [];
for ($i=1; $i <= $editlen; $i++) {
    for ($j=1; $j <= $editlen; $j++) {
        if ($idsF[$j] == $editCod[$i]) {
            $rawCots[$i] = $rawCotsCopy[$j];
        }
    }
}

//define queries
$sql = [];
for ($i=1; $i <= $tdlen ; $i++) {
    $sql[$i] = "delete from carteira where usuario = '{$_SESSION['email']}' and codAcao = '{$cods[$i]}'";
}
$update = [];
for ($i=1; $i <= $editlen ; $i++) {
    $update[$i] = "update carteira set valor={$vedit[$i]},rawCot={$rawCots[$i]} where usuario = '{$_SESSION['email']}' and codAcao = {$editCod[$i]}";
}

for ($i=1; $i <= $tdlen ; $i++) { 
    $conexao->query($sql[$i]) === TRUE;
}
for ($i=1; $i <= $editlen ; $i++) { 
    $conexao->query($update[$i]) === TRUE;
}


echo "<script type='text/javascript'>alert('Carteira editada com sucesso!');";
echo "javascript:window.location='sua_carteira.php';</script>";

?>