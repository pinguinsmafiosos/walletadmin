<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <title>Site</title>
</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark" aria-label="Third navbar example">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Expand at sm</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample03" aria-controls="navbarsExample03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExample03">
                <ul class="navbar-nav me-auto mb-2 mb-sm-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-bs-toggle="dropdown" aria-expanded="false">Dropdown</a>
                        <ul class="dropdown-menu" aria-labelledby="dropdown03">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                </ul>
                <form>
                    <input class="form-control" type="text" placeholder="Search" aria-label="Search">
                </form>
            </div>
        </div>
    </nav>
    <div id="rg">
        <h1>
            <?php
            $url = "https://www.horario-brasilia.com/";

            $sitedata = file_get_contents($url);

            $var1 = explode('<p id="hora">', $sitedata);
            $var2 = explode('</p>', $var1[1]);

            print $var2[0];

            ?>
        </h1>
    </div>
    <div class="time2">
        <h2>
            <?php
            $url = "https://www.horario-brasilia.com/";

            $sitedata = file_get_contents($url);

            $var1 = explode('<p id="hora">', $sitedata);
            $var2 = explode('</p>', $var1[1]);

            print $var2[0];

            ?>
        </h2>
    </div>

    <div class="b-example-divider"></div>

    <div class="container">
        <footer class="py-3 my-4">
            <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Home</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Features</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Pricing</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">FAQs</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
            </ul>
            <p class="text-center text-muted">&copy; 2021 WalletAdmin, Inc</p>
        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <!-- <script>
            $(function() {
                setTime();

                function setTime() {
                    var date = new Date().getTime();
                    var string = "Timestamp: " + date;
                    setTimeout(setTime, 3000);
                    $('#setTime').html(string);
                }
            });
        </script> -->
    <script>
        setInterval(function() {
            $.ajax({
                method: "GET", //GET OU POST

            }).done(function(answer) {
                $('#rg').html('<div id="rg">'); //Executa se tiver sucesso

            }).fail(function(jqXHR, textStatus) {
                console.log("Request search failed: " + textStatus); //executa se falhar 
            });
        }, 1000);
    </script>
</body>

</html>