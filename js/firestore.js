const db = firebase.firestore().collection("actions");
const db2 = firebase.firestore()
var divact = document.querySelector('[data-js="actions"]')

var data = []
var pricesCopy = []
var prices = []
var bvmfs = []
var entsCopy = []
var ents = []
var i = 0
var isCarteira
var val

async function verifyCarteira() {
  await db2.collection("carteira").where("usuario", "==", email).get()
  .then((querySnapshot) => {
      isCarteira = querySnapshot.empty
    })
    val = isCarteira

}

async function  getCots(){
  
  var allcots = await db.where("bvmf","in",actions).get();
  
   for(const doc of allcots.docs){
        data[0] = doc.data()
        price = data.map(x => x.price)
        bvmf = data.map(y => y.bvmf)
        ent = data.map(z => z.empresa)
        pricesCopy[i] = price[0]
        bvmfs[i] = bvmf[0]
        entsCopy[i] = ent[0]
        
        i++
    }
    for (let i = 0; i < actions.length; i++) {
      for (let j = 0; j < actions.length; j++) {
        if (bvmfs[j] === actions[i]) {
          prices[i] = pricesCopy[j]
          ents[i] = entsCopy[j]
        }
      }
    }

    for (let i = 0; i < numRows; i++) {
      valuesf[i] = (values[i] * (prices[i]/rawCots[i]))
    }

    let percent = []
    for (let i = 0; i < actions.length; i++) {
      percent[i] = ((prices[i]/rawCots[i])-1)*100

      divact.innerHTML += `<div class="actions-list">
          <div class="card-text">
            <h2>${actions[i]}</h2>
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
