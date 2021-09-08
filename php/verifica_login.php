<?php
if (!isset($_SESSION)) {
    session_start();
}
if(!$_SESSION['email']) {
    header('Location: telaLogin.php');
    exit();
}
?>