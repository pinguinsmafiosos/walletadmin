const db = firebase.firestore().collection("actions");
const db2 = firebase.firestore()
var divact = document.querySelector('[data-js="actions"]')

var data = []
var pricesCopy = []
var prices = []
var bvmfs = []
var entsCopy = []
var ents = []
var cods2 = []
var i = 0

var g = 0
var isCarteira
var dat = []
var val
var numPapeis = []
var numPapeisCopy = []
var codAcoes = []
var codAcoesCopy = []
var rawCotsCopy = []
var rawCots = []
var valuesf = []
var bvmfsCopy = []

async function verifyCarteira() {
  await db2.collection("carteira").where("usuario", "==", email).get()
  .then((querySnapshot) => {
      isCarteira = querySnapshot.empty
      querySnapshot.forEach((doc) => {
          dat[0] = doc.data()
          act = dat.map(x => x.numPapeis)
          cods = dat.map(y => y.codAcao)
          raw = dat.map(z => z.rawCot)
          numPapeisCopy[g] = act[0]
          codAcoesCopy[g] = cods[0]
          rawCotsCopy[g] = raw[0]

          g++
      });
    })
    val = isCarteira
    numPapeis = numPapeisCopy
    codAcoes = codAcoesCopy
    rawCots = rawCotsCopy

    if (!val) {
      var allcots = await db.where("codAcao","in",codAcoes).get()
  
      for(const doc of allcots.docs){
        data[0] = doc.data()
        price = data.map(x => x.price)
        bvmf = data.map(y => y.bvmf)
        ent = data.map(z => z.empresa)
        cod2 = data.map(a => a.codAcao)
        pricesCopy[i] = price[0]
        bvmfsCopy[i] = bvmf[0]
        entsCopy[i] = ent[0]
        cods2[i] = cod2[0]
        i++
      }
      
      
      for (let i = 0; i < codAcoes.length; i++) {
        for (let j = 0; j < codAcoes.length; j++) {
          if (cods2[j] === codAcoes[i]) {
            prices[i] = pricesCopy[j]
            ents[i] = entsCopy[j]
            bvmfs[i] = bvmfsCopy[j]
          }
        }
      }
    
    
      for (let i = 0; i < codAcoes.length; i++) {
        valuesf[i] = ((numPapeis[i]*prices[i])*(prices[i]/rawCots[i]))
      }
    
      let percent = []
      for (let i = 0; i < codAcoes.length; i++) {
        percent[i] = ((prices[i]/rawCots[i])-1)*100

        divact.innerHTML += `<div class="actions-list">
            <div class="card-text">
              <h2>${bvmfs[i]}</h2>
              <p><span>Preço: R$${prices[i]}</span></p>
              <p><span>Lucro/perda agora: </span><span class="nb">${percent[i].toFixed(3)}%</span></p>
            </div>
            <div id="bg${i+1}" class="card-stats">
              <div class="stat">
                <div class="value">R$${prices[i]}</div>
                <div class="type">Preço</div>
              </div>
              <div class="stat">
                <div class="ent">${ents[i]}</div>
                <div class="type">Empresa</div>
              </div>
            </div>
          </div>`
    
        document.getElementById(`bg${i+1}`).style.background = colors[i]
        if (percent[i] > 0) {
          document.getElementsByClassName("nb")[i].style.color = "green"
        } else if (percent[i] < 0) {
          document.getElementsByClassName("nb")[i].style.color = "red"
        } else {
          document.getElementsByClassName("nb")[i].style.color = "black"
        }
      }

    }
    
}