//getting elements
const searchWrapper = document.querySelector(".search-input");
const inputBox = searchWrapper.querySelector("input");
const autoBox = searchWrapper.querySelector(".autocom-box");
let k = 0

//press and release any key and add eventListener for 'return' key
inputBox.onkeyup = (e)=>{
    let userData = e.target.value; //user action
    let emptyArray = [];
    if(userData) {
        inputBox.addEventListener("keyup",function(event) {
            if (event.keyCode === 13) {
                if (k == 0) {
                    document.getElementsByClassName("action-div")[0].style.display = ""
                    validar2()
                    validar()
                }
                k++
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
        k = 0
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
    let act_name = inputBox.value
    document.getElementsByClassName("action-div")[0].style.display = ""
    validar2()
    validar()
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