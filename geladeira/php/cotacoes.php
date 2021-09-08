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
                    <li><a href="">Sua Carteira</a></li>
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


    <div class="div-acoes">
        <h2>Escolha uma Ação: </h2>
        <select onchange="loadCharts();" name="Acoes" id="cotAcoes">
            <option value="AAPL">Apple inc</option>
            <option value="TSLA">Tesla</option>
        </select>
    </div>

    <div class="tradingview-widget-container" id="tvchart">
    </div>

    <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
    <script type="text/javascript">
        loadCharts();

        function loadCharts() {
            let active = document.getElementById('cotAcoes').value;
            new TradingView.widget({
                "autosize": true,
                "symbol": "NASDAQ:" + active,
                "interval": "D",
                "timezone": "America/Sao_Paulo",
                "theme": "light",
                "style": "1",
                "locale": "br",
                "toolbar_bg": "#f1f3f6",
                "enable_publishing": false,
                "allow_symbol_change": true,
                "container_id": "tvchart"
            })
        };
    </script>
</body>

</html>