<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/sua_carteira.css">
    <title>Sua Carteira</title>
</head>

<body id="body">
    <?php
    if (!isset($_SESSION)) {
        session_start();
    }
    ?>
    <header class="menu-principal">
        <div class="session">
            <span> Olá, </span>
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
    <div class="title">
        <h1>RESUMO DA SUA CARTEIRA</h1>
    </div>

    <!-- loading div -->
    <div class="loading">
        <div></div>
    </div>

    <!-- modal sem carteira -->

        <div class="modal-button">
            Não tem carteira ainda?
            <button type="button" class="btn btn-primary mx-auto" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Crie aqui a sua carteira
            </button>
        </div>

        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Digite o símbolo das suas Ações</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <form>
                            <div class="input-group mb-2">
                                <label class="input-group-text" for="inputGroupSelect01">Selecione o número de ações diferentes que possui:</label>
                                <select onchange="loadInput();" name="num" id="select1">
                                    <option selected>selecione...</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                            </div>
                            <h5>Ação / número de papéis que possui</h5>

                            <div id="inputs">
                            </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button id="sbmt1" class="btn btn-primary" type="button" onclick="getRawCot()">Submit form</button>
                    </div>

                    </form>
                    <script type="text/javascript">
                        var data2 = []
                        var prices2Copy = []
                        var prices2 = []
                        var idsCopy = []
                        var ids = []
                        var fbvmfs = []
                        var actions2 = []
                        var j = 0

                        // var date = new Date()
                        //get month
                        // console.log((date.getMonth()+1))

                        async function getCots2() {
                            const db = firebase.firestore().collection("actions");
                            //const db2 = firebase.firestore()
                            
                            var allcots2 = await db.where("bvmf","in",actions2).get();

                            for(const doc of allcots2.docs){
                                data2[0] = doc.data()
                                price2 = data2.map(x => x.price)
                                fbvmf = data2.map(y => y.bvmf)
                                idsCopy[j] = parseInt(doc.id) + parseInt(1)
                                prices2Copy[j] = price2[0]
                                fbvmfs[j] = fbvmf[0]
                                
                                j++
                                
                            }
                            // sort ids
                            for (let i = 0; i < actions2.length; i++) {
                                for (let j = 0; j < actions2.length; j++) {
                                    if (fbvmfs[j] === actions2[i]) {
                                        ids[i] = idsCopy[j]
                                        prices2[i] = prices2Copy[j]
                                    }
                                }
                            }
                        }
                        
                        function getRawCot() {
                            //define actions2
                            var num = document.getElementById("select1").value
                            for (let i = 1; i <= num; i++) {
                                actions2[i-1] = document.getElementById(`contain${i}`).value
                            }

                            //form validation
                            let count = 0
                            let h = 0
                            for (let i = 0; i < num; i++) {
                                if (document.getElementsByClassName("form-control")[h].value == "") {
                                    console.log("preencha os campos1")
                                    document.getElementsByClassName("form-control")[h].classList.add("is-invalid")
                                    count++
                                } else {
                                    document.getElementsByClassName("form-control")[h].classList.remove("is-invalid")
                                    document.getElementsByClassName("form-control")[h].classList.add("is-valid")
                                }
                                h+=2
                            }
                            h = 1
                            for (let i = 0; i < num; i++) {
                                if (document.getElementsByClassName("form-control")[h].value == "") {
                                    console.log("preencha os campos2")
                                    document.getElementsByClassName("form-control")[h].classList.add("is-invalid")
                                    count++
                                } else {
                                    document.getElementsByClassName("form-control")[h].classList.remove("is-invalid")
                                    document.getElementsByClassName("form-control")[h].classList.add("is-valid")
                                }
                                h+=2
                            }

                            
                            if (count == 0) {
                                getCots2().then(y => {
                                    const db3 = firebase.firestore()
                                    const batch = db3.batch()
                                    const cRef = db3.collection("carteira")
                                    let i = 0

                                    for (let i = 1; i <= num; i++) {
                                        document.getElementById(`cot${i}`).value = prices2[i-1]
                                        document.getElementById(`id${i}`).value = ids[i-1]
                                        console.log(document.getElementById(`id${i}`).value)
                                    }
                                    
                                    console.log("formulário enviado")

                                    for (let i = 0; i < actions2.length; i++) {
                                        batch.set(cRef.doc(), {
                                            codAcao: ids[i],
                                            numPapeis: document.getElementById(`paper${i+1}`).value,
                                            usuario: email,
                                            rawCot: prices2[i]
                                        })
                                        
                                    }

                                    batch.commit().then(() => {
                                        alert("Carteira criada com sucesso!")
                                        window.location.reload()
                                    })

                                    // for (let i = 0; i < actions2.length; i++) {
                                    //     db2.collection("carteira").doc().set({
                                    //         codAcao: ids[i],
                                    //         numPapeis: document.getElementById(`paper${i+1}`).value,
                                    //         usuario: email,
                                    //         rawCot: prices2[i]
                                    //     })
                                    //     .then(() => {
                                    //         console.log("Document successfully written!");
                                    //     })
                                    //     .catch((error) => {
                                    //         console.error("Error writing document: ", error);
                                    //     });
                                    // }

                                    //window.location.reload()
                                })
                            }

                        }
                    </script>

                </div>
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

    <!-- com carteira -->

        <div class="edit">
            <div class="modal-button">
                Editar/excluir ações:
                <button type="button" class="btn btn-primary mx-auto" data-bs-toggle="modal" data-bs-target="#staticBackdrop" onclick="editContent();">
                    Editar carteira
                </button>
            </div>

            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Edite a sua carteira</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <form id="form-edit" method="POST" action="edita_carteira.php">
                                
                                <h5>Ação / número de papéis que possui</h5>

                                <div id="inputs2">
                                </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button class="btn btn-primary" type="button" onclick="confirmEdit();">Confirmar Edições</button>
                        </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>

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

        <div class="title1">
            <h2>Seus ativos:</h2>
        </div>

        <div data-js="actions" class="actions">
        </div>

        <!-- authentication -->
    <script src="../js/page_auth.js"></script>
    <script src="../js/logout.js"></script>

    <script type="text/javascript">
        <?php include("variables.php");
        echo $actionsJS; ?>;

        <?php echo $valuesJS; ?>;

        <?php echo $codActsJS; ?>;

        var numRows = <?php echo $row; ?>;

        //define colors array
        var colors = [];
        colors[0] = 'rgb(255, 99, 132)';
        colors[1] = 'rgb(54, 162, 235)';
        colors[2] = 'rgb(139,0,0)';
        colors[3] = 'rgb(255,0,0)';
        colors[4] = 'rgb(250,128,114)';
        colors[5] = 'rgb(255,69,0)';
        colors[6] = 'rgb(255,140,0)';
        colors[7] = 'rgb(255,215,0)';
        colors[8] = 'rgb(240,230,140)';
        colors[9] = 'rgb(154,205,50)';
        colors[10] = 'rgb(85,107,47)';
        colors[11] = 'rgb(144,238,144)';
        colors[12] = 'rgb(0,250,154)';
        colors[13] = 'rgb(47,79,79)';
        colors[14] = 'rgb(0,255,255)';
        colors[15] = 'rgb(100,149,237)';
        colors[16] = 'rgb(0,0,128)';
        colors[17] = 'rgb(138,43,226)';
        colors[18] = 'rgb(255,0,255)';
        colors[19] = 'rgb(139,69,19)';


        //must define:
        //values array
    </script>

    <script src="../js/firestore.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.min.js"></script>
    <script>
        document.getElementsByClassName("graph")[0].style.display = "none"
        document.getElementsByClassName("graph2")[0].style.display = "none"
        document.getElementsByClassName("title1")[0].style.display = "none"
        document.getElementsByClassName("edit")[0].style.display = "none"
        document.getElementsByClassName("modal-button")[0].style.display = "none"

        verifyCarteira().then((c) => {
            if (!val) {

                //reveal items
                document.getElementsByClassName("loading")[0].style.display = "none"
                document.getElementById("body").style.background = "#007eff30"
                document.getElementsByClassName("modal-button")[0].style.display = "none"
                
                document.getElementsByClassName("graph")[0].style.display = ""
                document.getElementsByClassName("graph2")[0].style.display = ""
                document.getElementsByClassName("title1")[0].style.display = ""
                document.getElementsByClassName("edit")[0].style.display = ""


                var ctx = document.getElementsByClassName("line-chart");
        
                //type, data ou options
                var chartGraph = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                        datasets: [{
                            label: `Variação Patrimonial - ${new Date().getFullYear()}`,
                            data: [5, 10, 5, 14, 20, 15, 6, 14, 8, 12, 15, 5, 10],
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
                        labels: bvmfs,
                        datasets: [{
                            label: "Diversificação dos ativos",
                            data: valuesf,
                            borderWidth: 0,
                            backgroundColor: colors,
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
        
                
            } else {
                document.getElementsByClassName("loading")[0].style.display = "none"
                document.getElementById("body").style.background = "#007eff30"
                document.getElementsByClassName("modal-button")[0].style.display = ""
            }
        })


    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

    <script src="../js/autocomp.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="../js/validation.js"></script>

    <script src="https://cdn.rawgit.com/PascaleBeier/bootstrap-validate/v2.2.0/dist/bootstrap-validate.js"></script>

    <script type="text/javascript">
        var k = 0
        var old = 0

        function loadInput() {
            let num = document.getElementById("select1").value
            
            //reset inputs
            if (k == 1) {
                let f = 0
                for (let i = 0; i < old; i++) {
                    for (let j = 0; j < 2; j++) {
                        document.getElementsByClassName("form-control")[f].value = ""
                        f++
                    }
                }
            }
            old = document.getElementById("select1").value

            //reset innerHTML
            if (k == 1) {
                document.getElementById("inputs").innerHTML = ""
            }

            for (let i = 1; i <= num; i++) {
                document.getElementById("inputs").innerHTML += `<div class="input-group mb-3 align-items-start" id="div1">

                    <input id="contain${i}" type="text" name="action${i}" class="form-control col-3" placeholder="Ex: PETR4" aria-label="Username" required>

                    <span class="input-group-text">R$</span>
                    <input type="number" name="value${i}" id="paper${i}" class="form-control" aria-label="Amount (to the nearest dollar)" required>

                    <input type="number" name="cot${i}" id="cot${i}" class="cots">
                    <input type="number" name="id${i}" id="id${i}" class="ids">

                    </div>`

            }

            k = 1
            validateAction()
        }
    </script>
    <script type="text/javascript">
        var toDelete = []
        var toEdit = []
        function editContent() {

            document.getElementById("inputs2").innerHTML = ""

            for (let i = 0; i < actions.length; i++) {
                document.getElementById("inputs2").innerHTML += `<div class="input-group mb-3 align-items-start">

                    <input class="form-control acts" type="text" placeholder="${actions[i]}" aria-label="Disabled input example" disabled>

                    <span class="input-group-text">R$</span>
                    <input type="number" id="money${i+1}" name="invest${i+1}" class="form-control" value="${valuesf[i].toFixed(3)}" aria-label="Amount (to the nearest dollar)" required>
                    <button type="button" class="btn btn-danger" onclick="deleteAction${i+1}();">Delete</button>

                    </div>`
            }

            //document.getElementById("inputs2").innerHTML += `<button type="button" class="btn btn-primary">Adicionar Ação</button>`

        }
        function confirmEdit() {
            toDelete = toDelete.filter(Boolean)

            //define toEdit values
            for (let i = 0; i < actions.length; i++) {
                toEdit[i] = []
                if (document.getElementById(`money${i+1}`).value != valuesf[i].toFixed(3)) {
                    toEdit[i][i] = document.getElementById(`money${i+1}`).value
                    toEdit[i][(i+1)] = codActs[i]
                }
                    
            }

            for (let i = 1; i < toEdit.length; i++) {
                toEdit[i].splice(0,i)
            }

            //mark empty arrays location
            let pos = []
            let p = 0
            for (let i = 0; i < toEdit.length; i++) {
                if (toEdit[i].length == 0) {
                    pos[p] = i
                    p++
                }
            }
            
            //delete empty arrays
            p = 0
            for (let i = 0; i < pos.length; i++) {
                    toEdit.splice((pos[i]-p),1)
                    p++
            }

            document.getElementById("inputs2").innerHTML += `<input type="number" name="tdlen" class="money" value="${toDelete.length}">`
            document.getElementById("inputs2").innerHTML += `<input type="number" name="editlen" class="money" value="${toEdit.length}">`

            for (let i = 0; i < toDelete.length; i++) {
                document.getElementById("inputs2").innerHTML += `<input type="number" name="money${i+1}" class="money" value="${toDelete[i]}">`
            }
            for (let i = 0; i < toEdit.length; i++) {
                document.getElementById("inputs2").innerHTML += `<input type="number" name="vedit${i+1}" class="money" value="${toEdit[i][0]}">`
            }
            for (let i = 0; i < toEdit.length; i++) {
                document.getElementById("inputs2").innerHTML += `<input type="number" name="editcode${i+1}" class="money" value="${toEdit[i][1]}">`
            }
            for (let i = 0; i < toEdit.length; i++) {
                document.getElementById("inputs2").innerHTML += `<input type="number" id="cotsF${i+1}" name="rawCotsEdit${i+1}" class="money">`
            }
            for (let i = 0; i < toEdit.length; i++) {
                document.getElementById("inputs2").innerHTML += `<input type="number" id="idsF${i+1}" name="idsF${i+1}" class="money">`
            }

            var data2 = []
            var prices2 = []
            var ids = []
            var j = 0
            var actions3 = []
            
            pos2 = []
            p = 0

            for (let i = 0; i < actions.length; i++) {
                if (!pos.includes(i)) {
                    actions3[p] = actions[i]
                    p++
                }
            }

            async function getCots2() {
                if (actions3.length == true) {
                    const db = firebase.firestore().collection("actions");
                    
                    var allcots2 = await db.where("bvmf","in",actions3).get();
    
                    for(const doc of allcots2.docs){
                        data2[0] = doc.data()
                        price2 = data2.map(x => x.price)
                        ids[j] = parseInt(doc.id) + parseInt(1)
                        prices2[j] = price2[0]
                        
                        j++
                        
                    }
                }
            }
            getCots2().then(y => {

                for (let i = 1; i <= toEdit.length; i++) {
                    document.getElementById(`cotsF${i}`).value = prices2[i-1]
                    document.getElementById(`idsF${i}`).value = ids[i-1]
                    
                }
                document.getElementById("form-edit").submit()
            })

        }
        function deleteAction1() {
            document.getElementsByClassName("acts")[0].style.display = "none"
            document.getElementsByClassName("input-group-text")[0].style.display = "none"
            document.getElementById("money1").style.display = "none"
            document.getElementsByClassName("btn-danger")[0].style.display = "none"

            toDelete[0] = codActs[0]
        }
        function deleteAction2() {
            document.getElementsByClassName("acts")[1].style.display = "none"
            document.getElementsByClassName("input-group-text")[1].style.display = "none"
            document.getElementById("money2").style.display = "none"
            document.getElementsByClassName("btn-danger")[1].style.display = "none"

            toDelete[1] = codActs[1]
        }
        function deleteAction3() {
            document.getElementsByClassName("acts")[2].style.display = "none"
            document.getElementsByClassName("input-group-text")[2].style.display = "none"
            document.getElementById("money3").style.display = "none"
            document.getElementsByClassName("btn-danger")[2].style.display = "none"

            toDelete[2] = codActs[2]
        }
        function deleteAction4() {
            document.getElementsByClassName("acts")[3].style.display = "none"
            document.getElementsByClassName("input-group-text")[3].style.display = "none"
            document.getElementById("money4").style.display = "none"
            document.getElementsByClassName("btn-danger")[3].style.display = "none"

            toDelete[3] = codActs[3]
        }
        function deleteAction5() {
            document.getElementsByClassName("acts")[4].style.display = "none"
            document.getElementsByClassName("input-group-text")[4].style.display = "none"
            document.getElementById("money5").style.display = "none"
            document.getElementsByClassName("btn-danger")[4].style.display = "none"

            toDelete[4] = codActs[4]
        }
        function deleteAction6() {
            document.getElementsByClassName("acts")[5].style.display = "none"
            document.getElementsByClassName("input-group-text")[5].style.display = "none"
            document.getElementById("money6").style.display = "none"
            document.getElementsByClassName("btn-danger")[5].style.display = "none"

            toDelete[5] = codActs[5]
        }
        function deleteAction7() {
            document.getElementsByClassName("acts")[6].style.display = "none"
            document.getElementsByClassName("input-group-text")[6].style.display = "none"
            document.getElementById("money7").style.display = "none"
            document.getElementsByClassName("btn-danger")[6].style.display = "none"

            toDelete[6] = codActs[6]
        }
        function deleteAction8() {
            document.getElementsByClassName("acts")[7].style.display = "none"
            document.getElementsByClassName("input-group-text")[7].style.display = "none"
            document.getElementById("money8").style.display = "none"
            document.getElementsByClassName("btn-danger")[7].style.display = "none"

            toDelete[7] = codActs[7]
        }
        function deleteAction9() {
            document.getElementsByClassName("acts")[8].style.display = "none"
            document.getElementsByClassName("input-group-text")[8].style.display = "none"
            document.getElementById("money9").style.display = "none"
            document.getElementsByClassName("btn-danger")[8].style.display = "none"

            toDelete[8] = codActs[8]
        }
        function deleteAction10() {
            document.getElementsByClassName("acts")[9].style.display = "none"
            document.getElementsByClassName("input-group-text")[9].style.display = "none"
            document.getElementById("money10").style.display = "none"
            document.getElementsByClassName("btn-danger")[9].style.display = "none"

            toDelete[9] = codActs[9]
        }
    </script>

    <script>
        function validateAction() {
            bootstrapValidate(['#contain1', '#contain2', '#contain3', '#contain4', '#contain5', '#contain6', '#contain7', '#contain8', '#contain9', '#contain10', '#contain11', '#contain12', '#contain13', '#contain14', '#contain15', '#contain16', '#contain17', '#contain18', '#contain19', '#contain20'], 'inArray:(IBOV,\
            ,ARML3,\
            ,MLAS3,\
            ,CBAV3,\
            ,TTEN3,\
            ,BRBI11,\
            ,NINJ3,\
            ,DOTZ3,\
            ,MODL4,\
            ,MODL11,\
            ,MODL3,\
            ,KRSA3,\
            ,CXSE3,\
            ,GGPS3,\
            ,MATD3,\
            ,ALLD3,\
            ,BLAU3,\
            ,ATMP3,\
            ,ASAI3,\
            ,JSLG3,\
            ,CMIN3,\
            ,ELMD3,\
            ,ORVR3,\
            ,OPCT3,\
            ,WEST3,\
            ,CSED3,\
            ,BMOB3,\
            ,JALL3,\
            ,POWE3,\
            ,MOSI3,\
            ,MBLY3,\
            ,ESPA3,\
            ,VAMO3,\
            ,INTB3,\
            ,CJCT11,\
            ,BMLC11,\
            ,RECR11,\
            ,URPR11,\
            ,DEVA11,\
            ,MFAI11,\
            ,NGRD3,\
            ,BRK.B,\
            ,BAX,\
            ,BKR,\
            ,T,\
            ,MO,\
            ,AIG,\
            ,ACN,\
            ,ABT,\
            ,MMM,\
            ,PEP,\
            ,GOOG,\
            ,AVLL3,\
            ,RRRP3,\
            ,AERI3,\
            ,ENJU3,\
            ,CASH3,\
            ,TFCO4,\
            ,GMAT3,\
            ,SEQL3,\
            ,BOAS3,\
            ,MELK3,\
            ,HBSA3,\
            ,CURY3,\
            ,PLPL3,\
            ,PETZ3,\
            ,PGMN3,\
            ,LAVV3,\
            ,LJQQ3,\
            ,DMVF3,\
            ,SOMA3,\
            ,AMBP3,\
            ,ALPK3,\
            ,MTRE3,\
            ,MDNE3,\
            ,BDLL4,\
            ,BDLL3,\
            ,UPSS34,\
            ,LMTB34,\
            ,JNJB34,\
            ,FDXB34,\
            ,EXXO34,\
            ,CATP34,\
            ,BMYB34,\
            ,BOEI34,\
            ,ARMT34,\
            ,AXPB34,\
            ,STBP3,\
            ,RAPT3,\
            ,EGIE3,\
            ,VIIA3,\
            ,CEDO4,\
            ,CEDO3,\
            ,NFLX34,\
            ,NIKE34,\
            ,MCDC34,\
            ,HOME34,\
            ,FDMO34,\
            ,CMCS34,\
            ,AMZO34,\
            ,RDNI3,\
            ,SLED3,\
            ,RSID3,\
            ,MNDL3,\
            ,LEVE3,\
            ,CTKA4,\
            ,CTKA3,\
            ,MYPK3,\
            ,GRND3,\
            ,LCAM3,\
            ,CEAB3,\
            ,LLIS3,\
            ,CGRA4,\
            ,CGRA3,\
            ,ESTR4,\
            ,ESTR3,\
            ,DIRR3,\
            ,CTNM4,\
            ,CTNM3,\
            ,ANIM3,\
            ,EVEN3,\
            ,AMAR3,\
            ,MOVI3,\
            ,JHSF3,\
            ,HBOR3,\
            ,PDGR3,\
            ,EZTC3,\
            ,HGTX3,\
            ,ALPA3,\
            ,ALPA4,\
            ,RENT3,\
            ,MRVE3,\
            ,MGLU3,\
            ,LREN3,\
            ,COGN3,\
            ,WHRL4,\
            ,WHRL3,\
            ,TCSA3,\
            ,SBUB34,\
            ,SEER3,\
            ,SLED4,\
            ,LAME4,\
            ,LAME3,\
            ,HOOT4,\
            ,GFSA3,\
            ,YDUQ3,\
            ,CYRE3,\
            ,CVCB3,\
            ,WALM34,\
            ,PEPB34,\
            ,COLG34,\
            ,COCA34,\
            ,SMTO3,\
            ,MDIA3,\
            ,CAML3,\
            ,AGRO3,\
            ,BEEF3,\
            ,VIVA3,\
            ,CRFB3,\
            ,PCAR3,\
            ,NTCO3,\
            ,MRFG3,\
            ,JBSS3,\
            ,PGCO34,\
            ,BRFS3,\
            ,TRAD3,\
            ,BK,\
            ,BAC,\
            ,BSLI4,\
            ,BSLI3,\
            ,WFCO34,\
            ,VISA34,\
            ,MSBR34,\
            ,MSCD34,\
            ,JPMC34,\
            ,HONB34,\
            ,GEOO34,\
            ,GSGI34,\
            ,CTGP34,\
            ,BOAC34,\
            ,MMMC34,\
            ,SCAR3,\
            ,LPSB3,\
            ,BMGB4,\
            ,IGBR3,\
            ,GSHP3,\
            ,PSSA3,\
            ,CARD3,\
            ,BBRK3,\
            ,BRPR3,\
            ,BRSR6,\
            ,BRSR5,\
            ,BRSR3,\
            ,BIDI3,\
            ,BIDI11,\
            ,BIDI4,\
            ,SANB4,\
            ,SANB3,\
            ,SANB11,\
            ,MULT3,\
            ,ITUB4,\
            ,ITUB3,\
            ,ALSO3,\
            ,BMIN3,\
            ,MERC4,\
            ,LOGG3,\
            ,ITSA4,\
            ,ITSA3,\
            ,IRBR3,\
            ,IGTA3,\
            ,BBDC4,\
            ,BBDC3,\
            ,BRML3,\
            ,APER3,\
            ,BBSE3,\
            ,BPAN4,\
            ,BBAS3,\
            ,DEXP4,\
            ,DEXP3,\
            ,FCXO34,\
            ,PMAM3,\
            ,FESA4,\
            ,FESA3,\
            ,EUCA4,\
            ,EUCA3,\
            ,SUZB3,\
            ,KLBN4,\
            ,KLBN3,\
            ,KLBN11,\
            ,VALE3,\
            ,UNIP6,\
            ,UNIP5,\
            ,UNIP3,\
            ,MMXM3,\
            ,MMXM11,\
            ,GOAU4,\
            ,CSNA3,\
            ,BRKM6,\
            ,BRKM5,\
            ,BRKM3,\
            ,BRAP4,\
            ,BRAP3,\
            ,W2ST34,\
            ,S2QS34,\
            ,P2AT34,\
            ,G2DD34,\
            ,D2AS34,\
            ,C2PT34,\
            ,BIVW39,\
            ,BIVE39,\
            ,BCWV39,\
            ,A2VL34,\
            ,A2MC34,\
            ,AFHI11,\
            ,HSRE11,\
            ,VSEC11,\
            ,AGXY3,\
            ,CRPG6,\
            ,CRPG5,\
            ,CRPG3,\
            ,SMFT3,\
            ,SOJA3,\
            ,Z2NG34,\
            ,T2TD34,\
            ,T2DH34,\
            ,S2UI34,\
            ,S2QU34,\
            ,S2NW34,\
            ,S2HO34,\
            ,C2ZR34,\
            ,U2ST34,\
            ,S2EA34,\
            ,P2EN34,\
            ,M2PW34,\
            ,K2CG34,\
            ,D2KN34,\
            ,C2ON34,\
            ,C2HD34,\
            ,B2YN34,\
            ,ENMT4,\
            ,ENMT3,\
            ,AIRB34,\
            ,PAGS34,\
            ,HBRE3,\
            ,XINA11,\
            ,ADP,\
            ,OLP,\
            ,AKBA,\
            ,DLTH,\
            ,KBLM,\
            ,MRAM,\
            ,DESP,\
            ,BLCM,\
            ,CULP,\
            ,LEVI,\
            ,HII,\
            ,ASMB,\
            ,CABA,\
            ,TRMB,\
            ,RBBN,\
            ,FDBC,\
            ,PTRS,\
            ,HUD,\
            ,OSK,\
            ,EQ,\
            ,SEAC,\
            ,RAND,\
            ,EMN,\
            ,KRMD,\
            ,MHK,\
            ,APOG,\
            ,HEC,\
            ,XENE,\
            ,GOOGL,\
            ,LYV,\
            ,BDTX,\
            ,WMS,\
            ,KBR,\
            ,WHG,\
            ,HIG,\
            ,STIM,\
            ,MX,\
            ,STFC,\
            ,VAPO,\
            ,MTR,\
            ,C,\
            ,SCX,\
            ,EKSO,\
            ,ASRV,\
            ,GLAD,\
            ,HMHC,\
            ,HQY,\
            ,LMND,\
            ,CHKP,\
            ,VCTR,\
            ,VEEV,\
            ,RAIZ4,\
            ,RECV3,\
            ,SLBG34,\
            ,HALI34,\
            ,COPH34,\
            ,CHVX34,\
            ,PRIO3,\
            ,OSXB3,\
            ,DMMO3,\
            ,RPMG3,\
            ,UGPA3,\
            ,PETR4,\
            ,PETR3,\
            ,BRDT3,\
            ,ENAT3,\
            ,ONCO3,\
            ,VVEO3,\
            ,PARD3,\
            ,BIOM3,\
            ,BALM4,\
            ,BALM3,\
            ,PFIZ34,\
            ,MRCK34,\
            ,PNVL4,\
            ,PNVL3,\
            ,AALR3,\
            ,ODPV3,\
            ,RADL3,\
            ,QUAL3,\
            ,OFSA3,\
            ,HYPE3,\
            ,FLRY3,\
            ,ABTT34,\
            ,CLSA3,\
            ,LVTC3,\
            ,G2DI33,\
            ,IFCM3,\
            ,ADBE,\
            ,CMCSA,\
            ,CSCO,\
            ,INTC,\
            ,FB,\
            ,AMZN,\
            ,AAPL,\
            ,MSFT,\
            ,GOGL35,\
            ,LWSA3,\
            ,TOTS3,\
            ,XRXB34,\
            ,QCOM34,\
            ,ORCL34,\
            ,MSFT34,\
            ,IBMB34,\
            ,ITLC34,\
            ,HPQB34,\
            ,CSCO34,\
            ,AAPL34,\
            ,POSI3,\
            ,EBAY34,\
            ,BRIT3,\
            ,FIQE3,\
            ,VERZ34,\
            ,OIBR4,\
            ,OIBR3,\
            ,TIMS3,\
            ,VIVT3,\
            ,TELB4,\
            ,TELB3,\
            ,ATTB34,\
            ,CEPE6,\
            ,CEPE5,\
            ,CEPE3,\
            ,CEED4,\
            ,CEED3,\
            ,EEEL4,\
            ,EEEL3,\
            ,CASN3,\
            ,CEGR3,\
            ,CEBR6,\
            ,CEBR5,\
            ,CEBR3,\
            ,RNEW4,\
            ,RNEW3,\
            ,COCE5,\
            ,COCE3,\
            ,CLSC4,\
            ,CLSC3,\
            ,ALUP4,\
            ,ALUP3,\
            ,ALUP11,\
            ,SAPR4,\
            ,SAPR3,\
            ,SAPR11,\
            ,CPLE6,\
            ,CPLE5,\
            ,CPLE3,\
            ,CPFE3,\
            ,CGAS5,\
            ,CGAS3,\
            ,AESB3,\
            ,NEOE3,\
            ,TRPL4,\
            ,TRPL3,\
            ,TAEE4,\
            ,TAEE3,\
            ,TAEE11,\
            ,SBSP3,\
            ,RNEW11,\
            ,GEPA4,\
            ,GEPA3,\
            ,CESP6,\
            ,CESP5,\
            ,CESP3,\
            ,CMIG4,\
            ,CMIG3,\
            ,AFLT3,\
            ,B3SA3,\
            ,GGBR3,\
            ,ENGI3,\
            ,ENGI4,\
            ,ENGI11,\
            ,CIEL3,\
            ,ABEV3,\
            ,AZUL4,\
            ,EMBR3,\
            ,BPAC11,\
            ,CCRO3,\
            ,CSAN3,\
            ,CSMG3,\
            ,ECOR3,\
            ,ELET3,\
            ,ELET6,\
            ,ENBR3,\
            ,ENEV3,\
            ,EQTL3,\
            ,GGBR4,\
            ,GNDI3,\
            ,GOLL4,\
            ,HAPV3,\
            ,LIGT3,\
            ,MEAL3,\
            ,RAIL3,\
            ,RAPT4,\
            ,SULA11,\
            ,USIM5,\
            ,WEGE3):ERRO: Símbolo não está no nosso banco de dados.')
        }
    </script>

</body>

</html>