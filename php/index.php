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
    ?>
    <header class="menu-principal">
        <div class="session">
            <span> Olá, <?php echo $_SESSION['email']; ?> </span>
        </div>
        <div class="logout">
            <h3><button onclick="logout()">Sair</button></h3>
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

    <script type="text/javascript">
        var uids = []
        var data = []
        authUser = Object.keys(window.sessionStorage).filter(item => item.startsWith('firebase:authUser'))[0]
        if (authUser) {
            console.log("current")
            data[0] = JSON.parse(Object.values(window.sessionStorage).filter(i => i.startsWith(`{"uid"`))[0])
            uid = data.map(x => x.uid)
            uids[0] = uid[0]
            console.log("aqui: ")
            console.log(uids[0])
        } else {
            window.location.replace("telaLogin.php")
        }
    </script>
    <script type="text/javascript">
        function logout() {
            console.log("sucess")
            firebase.auth().signOut().then(() => {
                window.location.reload()
                }).catch((error) => {
                    alert(error.message)
                });
        }
    </script>
        
</body>

</html>