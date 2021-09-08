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
                <form>
                    <input type="text" id="inputEmail" class="field" name="email" placeholder="Digite seu e-mail aqui" />
                    <input type="password" id="inputPass" class="field" name="senha" placeholder="Digite a sua senha" />
                </form>
                <input type="button" id="loginBtn" class="submit" value="Login" />
            </div>
            <div class="cadastro">
                <form>
                    <input type="text" id="emailCad" class="field" name="emailCad" placeholder="e-mail para cadastro" />
                    <input type="password" id="senhaCad" class="field" name="senhaCad" placeholder="Senha para cadastro" />
                    <input type="password" id="senhaCad2" class="field" name="senhaCad2" placeholder="Digite a senha novamente" />
                </form>
                <input type="button" id="signUpBtn" class="submit" value="Cadastro" onclick="cadastrar()" />
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
    <!-- core Firebase -->
    <script src="https://www.gstatic.com/firebasejs/8.8.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.8.1/firebase-firestore.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.8.1/firebase-auth.js"></script>

    <script>
        // Firebase configuration and initialize
        firebase.initializeApp({
            apiKey: "AIzaSyD8GUnpkARy2q-WqOXuRF6kM52tOerGzpw",
            authDomain: "walletadmin-5f07b.firebaseapp.com",
            projectId: "walletadmin-5f07b",
            storageBucket: "walletadmin-5f07b.appspot.com",
            messagingSenderId: "1071595045930",
            appId: "1:1071595045930:web:34752afad3c1bc0fd56f53"
        });

    </script>

    <script type="text/javascript" src="../js/slider.js"></script>
    <script type="text/javascript" src="../js/auth.js"></script>

</body>

</html>