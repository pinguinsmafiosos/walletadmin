<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <title>WalletAdmin</title>
</head>

<body>
    <?php
    if (!isset($_SESSION)) {
        session_start();
    }
    include 'verifica_login.php';
    ?>
    <header class="menu-principal">
        <div class="session">
            <span> Olá, <?php echo $_SESSION['email']; ?> </span>
        </div>
        <div class="logout">
            <h3><a href="logout.php">Sair</a></h3>
        </div>
        <div class="header-main">
            <div class="header-1">
                <div class="logo">
                    <img src="../img/WalletAdmin logo.png" />
                </div>
                <div class="redes-sociais">
                    <ul>
                        <li><a href=""><img src="../img/rss logo.png" /></a></li>
                        <li><a href=""><img src="../img/fb logo.png" /></a></li>
                        <li><a href=""><img src="../img/twitter logo.png" /></a></li>
                        <li><a href=""><img src="../img/linkedin logo.png" /></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <main class="col-100 menu-urls">
        <div class="header-2">
            <div class="menu">
                <ul>
                    <li><a href="index.php">Boas-Vindas</a></li>
                    <li><a href="sua_carteira.php">Sua Carteira</a></li>
                    <li><a href="cotacoes.php">Cotações</a></li>
                    <li><a href="">Histórico</a></li>
                    <li><a href="">Contatos</a></li>
                </ul>
            </div>
            <div class="busca">
                <input placeholder="Search Something" type="text" />
            </div>
        </div>
    </main>
    <!-- ----- menu padrão até aqui ----- -->
    <div class="col-100 fundo1"></div>
    <div class="fundo-preto"></div>
    <h2 class="texto1">ADMINISTRE SEUS INVESTIMENTOS</h2>
    <div class="col-100">
        <div class="buttons">
            <p>
            <a href="sua_carteira.php" class="btn">Clique Aqui</a> para ir para a sua carteira ou criar uma nova
            </p>
        </div>
    </div>
        
</body>

</html>