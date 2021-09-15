//getting elements
const searchWrapper = document.querySelector(".search-input");
const inputBox = searchWrapper.querySelector("input");
const autoBox = searchWrapper.querySelector(".autocom-box");

//press and release any key and add eventListener for 'return' key
inputBox.onkeyup = (e)=>{
    let userData = e.target.value; //user action
    let emptyArray = [];
    if(userData) {
        inputBox.addEventListener("keyup",function(event) {
            if (event.keyCode === 13) {
                window.location.href = "https://www.tradingview.com/symbols/BMFBOVESPA-"+inputBox.value+"/?utm_source=www.tradingview.com&utm_medium=widget&utm_campaign=chart&utm_term=BMFBOVESPA:"+inputBox.value;
            }
        });
        emptyArray = autocomp.filter((data)=>{
            //array filtering and return words which starts with entered char
            return data.toLocaleLowerCase().includes(userData.toLocaleLowerCase());
        });
        emptyArray = emptyArray.map((data)=>{
            return data = '<li>'+ data +'</li>';
        });
        console.log(emptyArray);
        searchWrapper.classList.add("active"); //show autocomplete
        showSuggestions(emptyArray);
        let allList = autoBox.querySelectorAll("li")
        for (let i = 0; i < allList.length; i++) {
            //adding onclick attribute in all li tag
            allList[i].setAttribute("onclick", "select(this)");            
        }
    } else {
        searchWrapper.classList.remove("active"); //hide autocomplete
    }
}

function select(element) {
    let selectUserData = element.textContent;
    inputBox.value = selectUserData; //selected item to textfield
    searchWrapper.classList.remove("active"); //hide autocomplete
    window.location.href = "https://www.tradingview.com/symbols/BMFBOVESPA-"+element.textContent+"/?utm_source=www.tradingview.com&utm_medium=widget&utm_campaign=chart&utm_term=BMFBOVESPA:"+element.textContent;
}

function showSuggestions(list) {
    let listData;
    if(!list.length) {
        userValue = inputBox.value;
        listData = '<li>'+ userValue +'</li>';
    } else {
        listData = list.join('');
    }
    autoBox.innerHTML = listData;
}