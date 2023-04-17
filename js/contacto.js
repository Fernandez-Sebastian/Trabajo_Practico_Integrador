// Aquí puedes agregar cualquier script que necesites para hacer tu página más interactiva
let botonFormulario = document.getElementById("botonFormulario");

$(document).ready(function(){
  $("#formulario-contacto").validate(
      {
          rules: {
              nombre: {
                  required: true,
                  minlength: 2
              },
              apellido: {
                required: true,
                minlength: 2
              },
              email: {
                 required: true,
                 email: true
              },
              comentario:{
                required: true                
              }
         },
         messages: {
              nombre : {
                  required: "Este campo es obligatorio",
                  minlength: "Debe tener al menos 2 letras"
              },
              apellido: {
                required: "Éste campo es obligatorio",
                minlength: "Debe tener al menos 2 letras"
              },
              email: {
                required: "Éste campo es obligatorio",
                email: "El email no tiene el formato requerido"
              },
              comentario: {
                required: "Éste campo es obligatorio",
              }
         }
      }
  )
});

let enviarFormulario = () => {
  if ($("#nombre").valid() && $("#apellido").valid() && $("#email").valid() && $("#comentario").valid()){
      document.getElementById("nombre").value= "";  
      document.getElementById("apellido").value= "";  
      document.getElementById("email").value= "";
      document.getElementById("comentario").value= "";  
      alert("Su consulta ha sido enviada. En breve recibirá una respuesta a su Email ");
  }  
}
botonFormulario.addEventListener("click", enviarFormulario);
