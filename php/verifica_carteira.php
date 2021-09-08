<?php
include("conexao.php");

if (!isset($_SESSION)) {
    session_start();
}

$sql = "select * from carteira where usuario = '{$_SESSION['email']}'";
$result = mysqli_query($conexao, $sql);
$row = mysqli_num_rows($result);

if ($row == 0) {
    $_SESSION['sem_carteira'] = true;
}



?>