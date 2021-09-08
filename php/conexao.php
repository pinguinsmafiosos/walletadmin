<?php
define('HOST','127.0.0.1');
define('USUARIO','admin');
define('SENHA','password');
define('DB','bdsite');

$conexao = mysqli_connect(HOST,USUARIO,SENHA,DB) or die ('Não foi possível conectar');


?>