// const finnhub = require('finnhub');

// const api_key = finnhub.ApiClient.instance.authentications['api_key'];
// api_key.apiKey = "c50uv22ad3if5950l4tg"
// const finnhubClient = new finnhub.DefaultApi()

// finnhubClient.stockCandles("AAPL", "D", 1590988249, 1591852249, {}, (error, data, response) => {
//   console.log(data)
// });

var aux = 'khdlfhalk'

function validar() {
    if (aux === undefined || aux == null || aux.length < 5) {
        console.log(error)
    } else {
        url = `https://finnhub.io/api/v1/news?category=finance&token=c50uv22ad3if5950l4tg`
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
    console.log(data['0'].url);
    let aux = data['Time Series (Daily)']
    let aux2 = aux['2021-09-14']
    let openValue = aux2['1. open']
    console.log(openValue);
}

validar()