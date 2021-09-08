<?php
include("conexao.php");

if (!isset($_SESSION)) {
    session_start();
}

//get form data
$num = (int)$_POST['num'];
$actions = [];
for ($i=1; $i <= $num; $i++) {
    $actions[$i] = $_POST["action$i"];
}
$values = [];
for ($i=1; $i <= $num; $i++) {
    $values[$i] = $_POST["value$i"];
}
$rawCotsCopy = [];
for ($i=1; $i <= $num; $i++) {
    $rawCotsCopy[$i] = $_POST["cot$i"];
}
$ids = [];
for ($i=1; $i <= $num; $i++) {
    $ids[$i] = $_POST["id$i"];
}

//define codAcao
$codAcao = [];
for ($i=1; $i <= $num; $i++) {
$select = "select id from acoes where simbolo = '{$actions[$i]}'";

$result = mysqli_query($conexao, $select);

while ($rows = $result->fetch_assoc()) {
    $codAcao[$i] = $rows['id'];
}
}

//sort rawCots
$rawCots = [];
for ($i=1; $i <= $num; $i++) {
    for ($j=1; $j <= $num; $j++) {
        if ($ids[$j] == $codAcao[$i]) {
            $rawCots[$i] = $rawCotsCopy[$j];
        }
    }
}

//insert into database
$sql = [];
for ($i=1; $i <= $num ; $i++) {
    $sql[$i] = "insert into carteira(codAcao,usuario,valor,rawCot) values ({$codAcao[$i]},'{$_SESSION['email']}',{$values[$i]},{$rawCots[$i]})";
}

$k = 0;
for ($i=1; $i <= $num ; $i++) { 
    if ($conexao->query($sql[$i]) === TRUE) {
        $k++;
    }
}


if ($k = $num) {
    echo "<script type='text/javascript'>alert('Carteira criada com sucesso!');";
    echo "javascript:window.location='sua_carteira.php';</script>";
}

echo "<script type='text/javascript'>alert('Carteira criada com sucesso!');";
echo "javascript:window.location='sua_carteira.php';</script>";

?>