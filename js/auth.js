var login = document.getElementById("inputEmail")
var pass = document.getElementById("inputPass")
var loginBtn = document.getElementById("loginBtn")
var signUpBtn = document.getElementById("signUpBtn")

var email = document.getElementById("emailCad")
var pass1 = document.getElementById("senhaCad")
var pass2 = document.getElementById("senhaCad2")

var emailContent

loginBtn.addEventListener('click',authenticate => {

  firebase.auth().setPersistence(firebase.auth.Auth.Persistence.SESSION).then(() => {
    console.log("autenticado")
    return firebase.auth().signInWithEmailAndPassword(login.value, pass.value).then((userCredential) => {
      console.log("email: ")
      console.log(firebase.auth().currentUser.email)
      window.location.replace("index.php")
    })
    .catch((error) => {
      var errorCode = error.code;
      var errorMessage = error.message;
      alert(errorMessage)
    })

  })

})

function cadastrar() {
    if ((pass1.value == pass2.value)) {

            firebase.auth().createUserWithEmailAndPassword(email.value, pass1.value)
          .then((userCredential) => {
            // Signed in 
            var user = userCredential.user;
            alert("cadastrado com sucesso")
            window.location.replace("index.php")
          })
          .catch((error) => {
            var errorCode = error.code;
            var errorMessage = error.message;
            alert(errorMessage)
          });
        
    
    } else {
        alert("senhas não coincidem")
    }

}