window.onload = function () {

    let boton = document.getElementById("boton");
    boton.addEventListener('click',validar);

}

function validar(e) {
    let nombre = document.getElementById("nombre");
    let apellido1 = document.getElementById("apellido_1");
    let apellido2 = document.getElementById("apellido_2");
    let email = document.getElementById("email");
    let login = document.getElementById("login");
    let pass = document.getElementById("pass");
    let error =  document.getElementById("error");

    let nombreCheck = validaCampo(nombre);
    let apellido1Check = validaCampo(apellido1);
    let apellido2Check = validaCampo(apellido2);
    let emailCheck = validaEmail(email);
    let loginCheck = validaCampo(login);
    let passCheck = validaPass(pass);
    if (!nombreCheck || !apellido1Check || !apellido2Check || !emailCheck || !loginCheck || !passCheck) {
        if (error.className.includes("hidden")){
            error.className = error.className.replace('hidden','');
        }
        e.preventDefault();
    } 
}

/*
Función que valida que el usuario no haya introducido solo espacios en blanco
*/
function validaCampo(dato) {
    let recorte = dato.value.trim();
    if (recorte === "") {
        dato.setCustomValidity('El campo no puede estar vacío ni incluir espacios en blanco.')
        return false;
    } else {
        return true;
    }
}

/*
Función que valida que el email sea correcto
*/
function validaEmail(email) {
    
    let patron = /[^@\s]+@[^@\s]+\.[^@\s]+/g;
    if (!patron.test(email.value)) {
        email.setCustomValidity('Asegúrate de que la dirección de email es correcta. Ejemplo: ejemplo@email.com')
        return false;
    } else {
        return true;
    }
}

/*
Función que valida que la contraseña tenga entre 4 y 8 caracteres
*/
function validaPass(dato) {
    let pass = dato.value;
    if (pass.length < 4 || pass.length > 8) {
        dato.setCustomValidity('La contraseña debe tener una extensión de entre 4 y 8 caracteres.')
        return false;
    } else {
        return true;
    }
}