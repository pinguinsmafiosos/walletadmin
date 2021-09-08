<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    if (!isset($_SESSION)) {
        session_start();
    }
    include "conexao.php";

    if (empty($_POST['email']) || empty($_POST['senha'])) {
        header('Location: telaLogin.php');
        exit();
    }

    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $senha = mysqli_real_escape_string($conexao, $_POST['senha']);
    
    $query = "select email,pass from usuarios where email='{$email}' and pass=MD5('{$senha}')";

    $result = mysqli_query($conexao, $query);

    $row = mysqli_num_rows($result);
    

    if ($row == 1) {
        $_SESSION['email'] = $email;
        header('Location: index.php');
        exit();
    } else {
        $_SESSION['nao_autenticado'] = true;
        header('Location: telaLogin.php');
        exit();
    }


    ?>
</body>

</html>