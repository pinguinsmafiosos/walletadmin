const fields = document.querySelectorAll("[required]")

// console.log(fields)

function customValidation(event) {
    const field = event.target
    
    var foundError = true
    //resetar customValidity
    function verifyError() {
        foundError = false;
        for (let error in field.validity) {
            if (error != "customError" && field.validity[error]) {
                foundError = true;
            }
        }
        return foundError;
    }

    const error = verifyError()
    
    console.log("error exists: ",error)


    if (error) {
        //change required message
        field.setCustomValidity("Preencha o campo")
        field.classList.add("is-invalid")
        console.log(field.classList)
    } else {
        field.setCustomValidity("")
        field.classList.remove("is-invalid")
        field.classList.add("is-valid")
        console.log(field.validity)
    }

    var stillNo = false
    for (const field of fields) {
        if (field.validity.customError == true) {
            stillNo = true;
        }
    }
    if (stillNo == false) {
        //document.querySelector("form").submit()
        console.log("form enviado")
    }

}

for (field of fields) {
    field.addEventListener("invalid", customValidation)
}



// document.getElementById("sbmt1").addEventListener("click", event => {
//     //console.log("formulário enviado")
// })