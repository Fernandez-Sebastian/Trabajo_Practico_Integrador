//Declaro todos los elementos que voy a utilizar
let nombrePaso1 = document.getElementById("nombrePaso1");
let mailPaso1 = document.getElementById("mailPaso1");
let motivoPaso2 = document.getElementById("motivoPaso2");
let reclamoPaso2 = document.getElementById("reclamoPaso2");
let nombrePaso3 = document.getElementById("nombrePaso3");
let mailPaso3 = document.getElementById("mailPaso3");
let motivoPaso3 = document.getElementById("motivoPaso3");
let reclamoPaso3 = document.getElementById("reclamoPaso3");
let paso1 = document.getElementById("paso1");
let paso2 = document.getElementById("paso2");
let paso3 = document.getElementById("paso3");
let btnPaso1 = document.getElementById("btnPaso1");
let btnPaso2 = document.getElementById("btnPaso2");
let btnPaso3 = document.getElementById("btnPaso3");
let avisoDeEnvio = document.getElementById("avisoDeEnvio");
let btnVolver = document.getElementById("btnVolver");
let btnModificar = document.getElementById("btnModificar");


//Guardo los valores de los inputs del paso 1 en los inputs del paso 3 ademas de ocultar el paso 1 y mostrar el paso 2
let verPaso2 = () => {
    if ($("#nombrePaso1").valid() && $("#mailPaso1").valid()){
        nombrePaso3.value=nombrePaso1.value;
        mailPaso3.value=mailPaso1.value;
        paso1.style.display="none";
        paso2.style.display="flex";
    }
};

//Guardo los valores de los inputs del paso 2 en los inputs del paso 3 ademas de ocultar el paso 2 y mostrar el paso 3
let verPaso3 = () => {
    if ($("#motivoPaso2").valid() && $("#reclamoPaso2").valid()){
        motivoPaso3.value=motivoPaso2.value;
        reclamoPaso3.value=reclamoPaso2.value;
        paso2.style.display="none";
        paso3.style.display="flex";
    }    
};

//Oculto el paso 3, borro el contenido de los inputs de los pasos anteriores y muestro nuevamente el paso 1 pero con el texto de "Solicitud enviada..." que se ocultará automaticamente despues del tiempo estimado
let verPaso1 = () => {
    paso3.style.display="none";
    paso1.style.display="flex";
    nombrePaso1.value="";
    mailPaso1.value="";
    motivoPaso2.value="";
    reclamoPaso2.value="";
    avisoDeEnvio.style.display="block";
    setTimeout(ocultarAviso,5000)
};

let ocultarAviso = () => {
    avisoDeEnvio.style.display="none";
}

// Función boton volver
let volver = () => {
    paso1.style.display="flex";
    paso2.style.display="none";
    paso3.style.display="none";    
};

//Al apretar el boton del paso 1 va a llamar a la función "verPaso2"
btnPaso1.addEventListener("click", verPaso2);

//Al apretar el boton del paso 2 va a llamar a la función "verPaso3"
btnPaso2.addEventListener("click", verPaso3);

//Al apretar el boton del paso 3 va a llamar a la función "verPaso1"
btnPaso3.addEventListener("click", verPaso1);

//Al apretar el boton del paso 3 va a llamar a la función "verPaso1"
btnVolver.addEventListener("click", volver);

//Al apretar el boton del paso 3 va a llamar a la función "verPaso1"
btnModificar.addEventListener("click", volver);


// Validación de los campos
$(document).ready(function() {
    $("#wizard").validate(
        {
            rules: {
                nombrePaso1: {
                    required: true,
                    minlength: 2
                },
                mailPaso1: {
                   required: true,
                   email: true
                },
                motivoPaso2: {
                    required: true,
                    minlength: 2
                },
                reclamoPaso2: {
                   required: true,
                   minlength: 20
                }
           },
           messages: {
                nombrePaso1: {
                    required: "Este campo es obligatorio",
                    minlength: "Debe tener al menos 2 letras"
                },
                mailPaso1: {
                  required: "Éste campo es obligatorio",
                  email: "El email no tiene el formato requerido"
                },
                motivoPaso2: {
                    required: "Este campo es obligatorio",
                    minlength: "Debe tener al menos 2 letras"
                },
                reclamoPaso2: {
                  required: "Éste campo es obligatorio",
                  minlength: "Debe tener al menos 20 caracteres"
                }
           }
        }
    )
  });