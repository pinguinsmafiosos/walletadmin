const db = firebase.firestore().collection("actions");
const db2 = firebase.firestore()
var divact = document.querySelector('[data-js="actions"]')

var docData
var pricesCopy = []
var prices = []
var bvmfs = []
var entsCopy = []
var ents = []
var cods2 = []
var newActions = []
var i = 0
var mani = 1

var g = 0
var isCarteira
var dat = []
var val
var numPapeis = []
var numPapeisCopy = []
var codAcoes = []
var codAcoesCopy = []
var uniqueCods = []
var rawCotsCopy = []
var rawCots = []
var valuesf = []
var bvmfsCopy = []

var sumPapeis = []

async function verifyCarteira() {
  await db2.collection("carteira").where("usuario", "==", email).get()
  .then((querySnapshot) => {
      isCarteira = querySnapshot.empty
      querySnapshot.forEach((doc) => {
          numPapeisCopy[g] = doc.data().numPapeis
          codAcoesCopy[g] = doc.data().codAcao
          rawCotsCopy[g] = doc.data().rawCot

          g++
      });
    })
    val = isCarteira
    numPapeis = numPapeisCopy
    codAcoes = codAcoesCopy
    rawCots = rawCotsCopy

    let codAcoes2 = codAcoes.filter((c, index) => {
      return codAcoes.indexOf(c) === index;
    });

    if (!val) {
      var allcots = await db.where("codAcao","in",codAcoes2).get()
  
      for(const doc of allcots.docs){
        docData = doc.data()
        pricesCopy[i] = docData.price
        bvmfsCopy[i] = docData.bvmf
        entsCopy[i] = docData.empresa
        cods2[i] = docData.codAcao
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
    
      //mark duplicate positions
      let reps = []
      reps[0] = []
      reps[1] = []

      let aux = 0
      
      function getAllIndexes(arr, val) {
        var indexes = [], i;
        for(i = 0; i < arr.length; i++)
            if (arr[i] === val)
                indexes.push(i);
        return indexes;
      }
      
      //setting unique elements
      let uniqueChars = bvmfs.filter((c, index) => {
          return bvmfs.indexOf(c) === index;
      });

      reps[0] = uniqueChars

      let uniqueEnts = ents.filter((c, index) => {
        return ents.indexOf(c) === index;
      });

      uniqueCods = codAcoes.filter((c, index) => {
        return codAcoes.indexOf(c) === index;
      });

      //getting reps positions
      for (let i = 0; i < uniqueChars.length; i++) {
        reps[1][i] = getAllIndexes(bvmfs,uniqueChars[i])
      }

      //define valuesf, precos medios, percent
      let percent = []
      let precosMedios = []
      let prices3 = []
      for (let i = 0; i < reps[0].length; i++) {
        let prices2 = []
        let papeis2 = []
        let rawCots2 = []
        let sum = 0
        let sum1 = 0
        let sum2 = 0
        for (let j = 0; j < bvmfs.length; j++) {
          for (let k = 0; k < reps[1][i].length; k++) {
            if (j == reps[1][i][k]) {
              prices2[aux] = prices[j]
              rawCots2[aux] = rawCots[j]
              papeis2[aux] = numPapeis[j]

              sum += (parseFloat(papeis2[aux])*parseFloat(rawCots2[aux]))

              sum2 += (parseFloat(papeis2[aux])*parseFloat(rawCots2[aux]))*(parseFloat(prices2[aux])/parseFloat(rawCots2[aux]))

              sum1 += sum2

              aux++
              sum2 = 0
            }
          }
        }
        prices3[i] = prices2[0]
        precosMedios[i] = parseFloat(((sum)/(papeis2.reduce((acc,num) => parseFloat(acc)+parseFloat(num)))).toFixed(3))
        valuesf[i] = parseFloat(sum1.toFixed(3))
        percent[i] = ((prices2[0]/precosMedios[i])-1)*100

        sumPapeis[i] = papeis2.reduce((acc,num) => parseFloat(acc)+parseFloat(num))

        aux = 0
        sum = 0
        sum1 = 0
        sum2 = 0
        
      }
      
      bvmfs = reps[0]
      codAcoes = uniqueCods

      for (let i = 0; i < bvmfs.length; i++) {

        divact.innerHTML += `<div class="actions-list">
            <div class="card-text">
              <h2>${bvmfs[i]}</h2>
              <p><span>Pre??o: R$${prices3[i]}</span></p>
              <p><span>A????es compradas: ${sumPapeis[i]}</span></p>
              <p><span>Lucro/perda agora: </span><span class="nb">${percent[i].toFixed(3)}%</span></p>
            </div>
            <div id="bg${i+1}" class="card-stats">
              <div class="stat">
                <div class="value">R$${prices3[i]}</div>
                <div class="type">Pre??o</div>
              </div>
              <div class="stat">
                <div class="ent">${uniqueEnts[i]}</div>
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