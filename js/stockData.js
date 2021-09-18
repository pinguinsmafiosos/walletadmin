//finnhub stock data -------------------------------------------------------------

// const finnhub = require('finnhub');

// const api_key = finnhub.ApiClient.instance.authentications['api_key'];
// api_key.apiKey = "c50uv22ad3if5950l4tg"
// const finnhubClient = new finnhub.DefaultApi()

// finnhubClient.companyBasicFinancials("PETR4.SA", "all", (error, data, response) => {
//   console.log(data["metric"]["52WeekHigh"])
//   console.log(data["metric"]["52WeekLow"]);
// });

var symb
var symb2

function validar2() {
    symb2 = inputBox.value
    symb = symb2.toUpperCase()

    if (symb === undefined || symb == null) {
        console.log("error")
    } else {
        url = `https://finnhub.io/api/v1/stock/metric?symbol=${symb}.SA&metric=all&token=c50uv22ad3if5950l4tg`
        requestData2(url)
    }

}

async function requestData2(url) {
    const options = {
        method: 'GET',
        mode: 'cors',
        cache: 'default'
    }

    await fetch(url,options)
        .then(response => {response.json()
            .then(data => showData2(data))
        }).catch (e => console.log(e.message))
}

function showData2(data) {
    let alta52 = data['metric']['52WeekHigh']
    let baixa52 = data['metric']['52WeekLow']
    let roi5 = data['metric']['roi5Y']
    let roe = data['metric']['roeRfy']
    let ebit5 = data['metric']['ebitdaCagr5Y']

    document.getElementsByClassName("company-info")[0].innerHTML = `<h4>Dados fundamentalistas</h4>
    <table class="table table-striped">
        <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Dado</th>
              <th scope="col">Valor</th>
            </tr>
        </thead>
        <tbody>
            <tr>
              <th scope="row">1</th>
              <td>Alta 52 sem.</td>
              <td>R$${alta52}</td>
            </tr>
            <tr>
              <th scope="row">2</th>
              <td>Baixa 52 sem.</td>
              <td>R$${baixa52}</td>
            </tr>
            <tr>
              <th scope="row">3</th>
              <td>ROI 5a.</td>
              <td>${roi5}</td>
            </tr>
            <tr>
              <th scope="row">4</th>
              <td>ROE</td>
              <td>${roe}</td>
            </tr>
            <tr>
              <th scope="row">5</th>
              <td>Ebitda comp. 5a.</td>
              <td>${ebit5}</td>
            </tr>
        </tbody>
    </table>`
}

// --------------------------------------------------------------------------------

document.getElementsByClassName("action-div")[0].style.display = "none"

var actname
var actname2

function validar() {
    actname2 = inputBox.value
    actname = actname2.toUpperCase()

    if (actname === undefined || actname == null || actname.length < 5) {
        console.log("error")
    } else {
        url = `https://www.alphavantage.co/query?function=TIME_SERIES_DAILY_ADJUSTED&symbol=${actname}.SA&apikey=0YE77YUSRW4DVMO6`
        requestData(url)
    }

}

async function requestData(url) {
    const options = {
        method: 'GET',
        mode: 'cors',
        cache: 'default'
    }

    await fetch(url,options)
        .then(response => {response.json()
            .then(data => showData(data))
        }).catch (e => console.log(e.message))
}

function showData(data) {

    var dataArray = []

    let aux = data['Time Series (Daily)']

    let aux2
    let openValue
    let highValue
    let lowValue
    let closeValue

    let altas = []
    let baixas = []

    today = new Date().getTime()

    function getFormattedDate(date) {
        const year = date.getFullYear()
        const month = ('0' + (date.getMonth() + 1)).slice(-2)
        const day = ('0' + (date.getDate())).slice(-2)

        return [year,month,day].join('-')
    }

    let err = 0

    for (let i = 0; i < 50; i++) {

        today -= 86400000

        date = getFormattedDate(new Date(today))

        aux2 = aux[date.toString()]
        
        let arraySpc = []

        arraySpc = date.split("-")

        if (typeof aux[date.toString()] != 'undefined') {
            openValue = aux2['1. open']
            highValue = aux2['2. high']
            lowValue = aux2['3. low']
            closeValue = aux2['4. close']

            altas.push(parseFloat(highValue))
            baixas.push(parseFloat(lowValue))

            dataArray[i] = []
    
            dataArray[i][0] = (arraySpc[2])
            dataArray[i][1] = (parseFloat(lowValue))
            dataArray[i][2] = (parseFloat(openValue))
            dataArray[i][3] = (parseFloat(closeValue))
            dataArray[i][4] = (parseFloat(highValue))

            err = 0

        } else {
            i--
            err++
        }
        if (err == 40) {
            console.log("erro")
            break
        }
    }
    
    let altasf = parseFloat(((altas.reduce((acc,num) => acc+num))/(altas.length)).toFixed(3))
    let baixasf = parseFloat(((baixas.reduce((acc,num) => acc+num))/(baixas.length)).toFixed(3))

    // chart 1 ----------------------------------------------------------
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart2);
    function drawChart2() {
      var data = google.visualization.arrayToDataTable([
        ["Element", "Density", { role: "style" } ],
        ["Altas", altasf, "#b87333"],
        ["Baixas", baixasf, "gold"],
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Médias das altas/baixas",
        width: 600,
        height: 400,
        bar: {groupWidth: "95%"},
        legend: { position: "none" }
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("avg-info"));
      chart.draw(view, options);
  }

    // chart 2 ----------------------------------------------------------
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        dataArray.reverse()

        var data = google.visualization.arrayToDataTable(dataArray, true);

        var options = {
        legend:'none',
        title: `${actname} - GRÁFICO DIÁRIO`,
        animation: {startup: true,
            duration: 1200,
            easing: 'linear'
        },
        candlestick: {
            fallingColor: {
                stroke: 'red',
                fill: 'red'
            },
            risingColor: {
                stroke: 'green',
                fill: 'green'
            }
        },
        hAxis: {
            title: "dias"
        }
        
        };

        var chart = new google.visualization.CandlestickChart(document.getElementById('chart_div'));

        chart.draw(data, options);
    }
}