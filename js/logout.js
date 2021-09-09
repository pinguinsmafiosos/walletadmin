function logout() {
    console.log("sucess")
    firebase.auth().signOut().then(() => {
        window.location.reload()
        }).catch((error) => {
            alert(error.message)
        });
}