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
    <div class="col-100 fundo1">
    </div>
    <div class="fundo-preto"></div>
    <h2 class="texto1">ADMINISTRE SEUS INVESTIMENTOS</h2>
    <div class="col-100">
        <div class="graph">
            <canvas class="line-chart">

            </canvas>
        </div>
    </div>
    <div class="col-100">
        <div class="graph2">
            <canvas class="doughnut-chart">

            </canvas>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.min.js"></script>
    <script>
        var ctx = document.getElementsByClassName("line-chart");
        
        //type, data ou options
        var chartGraph = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: "Variação Patrimonial - 2021",
                    data: [5,10,5,14,20,15,6,14,8,12,15,5,10],
                    borderWidth: 6,
                    borderColor: ['rgba(77,166,253,0.85)'],
                    backgroundColor: 'transparent',
                    tension: 0.5
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Relatório anual'
                    }
                }
            }
        });
        
        var ctx2 = document.getElementsByClassName("doughnut-chart");
        var doughnutGraph = new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: ['FIIS','Ações','Bitcoin'],
                datasets: [{
                    label: "Diversificação dos ativos",
                    data: [40,50,10],
                    borderWidth: 0,
                    backgroundColor: ['rgb(255, 99, 132)','rgb(54, 162, 235)','rgb(255, 205, 86)'],
                    hoverOffset: 20
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Diversificação da carteira'
                    }
                }
            }
        });

    </script>
</body>

</html>