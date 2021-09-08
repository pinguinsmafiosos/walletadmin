<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/cotacoes.css">
    <title>Cotações</title>
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

    <div class="tradingview-widget2" id="widget2">
        <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js" async>
            loadCotacoes();

            function loadCotacoes() {
                new TradingView.widget({
                    "symbols": [{
                            "proName": "FOREXCOM:SPXUSD",
                            "title": "S&P 500"
                        },
                        {
                            "proName": "FOREXCOM:NSXUSD",
                            "title": "Nasdaq 1000"
                        },
                        {
                            "proName": "FX_IDC:EURUSD",
                            "title": "EUR/USD"
                        },
                        {
                            "proName": "BITSTAMP:BTCUSD",
                            "title": "BTC/USD"
                        },
                        {
                            "proName": "BITSTAMP:ETHUSD",
                            "title": "ETH/USD"
                        }
                    ],
                    "showSymbolLogo": true,
                    "colorTheme": "light",
                    "isTransparent": false,
                    "displayMode": "adaptive",
                    "locale": "br",
                    "container_id": "widget2"
                })
            };
        </script>
    </div>


    <div class="search-box">
        <h2>Pesquise por uma ação: </h2>
        <div class="wrapper">
            <div class="search-input">
                <input type="text" placeholder="digite aqui o nome do ativo..">
                <div class="autocom-box"></div>
                <div class="icon"><i class="fas fa-search"></i></div>
            </div>
        </div>
    </div>

    <div class="action-div">
    </div>
    
<script src="../js/autocomp.js"></script>
<script src="../js/search.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>

</body>

</html>