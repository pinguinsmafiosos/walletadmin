<?php
if (!isset($_SESSION)) {
    session_start();
}
include("conexao.php");

$email = mysqli_real_escape_string($conexao, $_POST['emailCad']);
$senha = mysqli_real_escape_string($conexao, MD5($_POST['senhaCad']));
$senha2 = mysqli_real_escape_string($conexao, MD5($_POST['senhaCad2']));

if (empty($_POST['emailCad']) || empty($_POST['senhaCad']) || empty($_POST['senhaCad2'])) {
    $_SESSION['credenciais_vazias'] = true;
    header("Location: telaLogin.php");
    exit;
}

if ($senha != $senha2) {
    $_SESSION['senhas_diferentes'] = true;
    header("Location: telaLogin.php");
    exit;
}

$sql = "select email from usuarios where email='{$email}'";
$result = mysqli_query($conexao, $sql);
$row = mysqli_num_rows($result);

if ($row != 0) {
    $_SESSION['usuario_existe'] = true;
    header("Location: telaLogin.php");
    exit;
}

$sql = "insert into usuarios(email,pass) values('{$email}','{$senha}')";


if ($conexao->query($sql) === TRUE) {
    $_SESSION['status_cadastro'] = true;
}

$conexao->close();

header("Location: telaLogin.php");
exit;
?>