<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/telaLogin.css">
    <link rel="stylesheet" type="text/css" href="http://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <title>Login</title>
</head>

<body>
    <?php
    if (!isset($_SESSION)) {
        session_start();
    }
    ?>
    <div class="login-box">
        <img class="logo" src="../img/WalletAdmin logo.png" />

        <div class="slider">

            <div class="login">
                <form method="POST" action="login.php">
                    <input type="text" class="field" name="email" placeholder="Digite seu e-mail aqui" />
                    <input type="password" class="field" name="senha" placeholder="Digite a sua senha" />
                    <input type="submit" class="submit" value="Login" />
                </form>
            </div>
            <div class="cadastro">
                <form method="POST" action="cadastro.php">
                    <input type="text" class="field" name="emailCad" placeholder="e-mail para cadastro" />
                    <input type="password" class="field" name="senhaCad" placeholder="Senha para cadastro" />
                    <input type="password" class="field" name="senhaCad2" placeholder="Digite a senha novamente" />
                    <input type="submit" class="submit" value="Cadastro" />
                </form>
            </div>

        </div>
    </div>
    <div class="errors">
        <?php if (isset($_SESSION['nao_autenticado'])) : ?>
            <p class="errors-p">Erro: Usuário não cadastrado.</p>
        <?php endif; unset($_SESSION['nao_autenticado']); ?>
        <?php if (isset($_SESSION['credenciais_vazias'])) : ?>
            <p class="errors-p">Erro: Uma ou mais credenciais vazias.</p>
        <?php endif; unset($_SESSION['credenciais_vazias']); ?>
        <?php if (isset($_SESSION['senhas_diferentes'])) : ?>
            <p class="errors-p">Erro: Senhas diferentes digitadas.</p>
        <?php endif; unset($_SESSION['senhas_diferentes']); ?>
        <?php if (isset($_SESSION['usuario_existe'])) : ?>
            <p class="errors-p">Erro: Email escolhido para cadastro já existe.</p>
        <?php endif; unset($_SESSION['usuario_existe']); ?>
    </div>
    <div class="success">
        <?php if (isset($_SESSION['status_cadastro'])) : ?>
            <p class="success-p">Cadastro realizado com sucesso!</p>
        <?php endif; unset($_SESSION['status_cadastro']); ?>
    </div>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="http://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script type="text/javascript" src="../js/slider.js"></script>

</body>

</html>