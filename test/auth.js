var login = document.getElementById("inputEmail")
var pass = document.getElementById("inputPass")
var loginBtn = document.getElementById("loginBtn")

loginBtn.addEventListener('click',authenticate => {
    
    firebase.auth().signInWithEmailAndPassword(login.value, pass.value)
    .then((userCredential) => {
      var user = userCredential.user;
      window.location.replace("index.php")
    })
    .catch((error) => {
      var errorCode = error.code;
      var errorMessage = error.message;
    })

})
