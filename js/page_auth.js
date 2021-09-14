var email
var uid
var data = []

authUser = Object.keys(window.sessionStorage).filter(item => item.startsWith('firebase:authUser'))[0]
if (authUser) {
    data[0] = JSON.parse(Object.values(window.sessionStorage).filter(i => i.startsWith(`{"uid"`))[0])
    email = data[0].email
    uid = data[0].uid

    document.getElementsByClassName("session")[0].innerHTML += `<span>${email}</span>`
    
}

firebase.auth().onAuthStateChanged(function(user) {
    if (user) {
        console.log("current")
        data[0] = JSON.parse(Object.values(window.sessionStorage).filter(i => i.startsWith(`{"uid"`))[0])
        email = data[0].email
        uid = data[0].uid
        console.log(email)
        console.log(uid)
        //unsubscribe()
    } else {
        window.location.replace("telaLogin.html")
    }
});