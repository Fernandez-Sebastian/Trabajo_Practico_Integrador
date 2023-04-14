// Aquí puedes agregar cualquier script que necesites para hacer tu página más interactiva
$(document).ready(function() {
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
              nombre: {
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

function enviarDatos(){
  var campoNombre = $('#nombre').val();
  var campoApellido = $('#apellido').val();
  var campoEmail = $("#email").val();
  var campoComentario = $('#texto').val();
   if(((campoNombre).length>2) && ((campoApellido).length>2) && (campoEmail != "") && (campoComentario != "")){
    confirm("se ah enviado el mensaje. Muchas gracias, En breve recibirà una respuesta a su mail.");
    }else{
      confirm("Hay campos obligatorios por completar")
    }

  }