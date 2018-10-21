'use strict';

$('#form_registro').validate({
  //*Se utiliza jquery validate para validar campos del formulario
  errorClass: 'invalid red-text', //*Clase añadida post-error
  validClass: 'valid',
  errorElement: 'div',
  errorPlacement: function(error, element) {
    $(element)
      .closest('form')
      .find(`label[for=${element.attr('id')}]`) //*Se insertará un label para representar el error
      .attr('data-error', error.text()); //*Se obtiene el texto de erro
    error.insertAfter(element); //*Se inserta el error después del elemento
  },
  rules: {
    //*Se establecen reglas de validación para campos del form
    txt_nombre: {
      required: true,
      minlength: 3,
      maxlength: 45,
      lettersonly: true
    },
    txt_apellidos: {
      required: true,
      minlength: 3,
      maxlength: 45,
      lettersonly: true
    },
    txt_email: {
      required: true,
      email: true
    },
    txt_password: {
      required: true,
      minlength: 10,
      maxlength: 100
    }
  },
  messages: {
    //*Se establecen mensajes de error a imprimir
    txt_nombre: {
      required: 'Campo requerido *',
      minlength: 'Ingresa un nombre válido',
      maxlength: 'Máximo permitido 45 caracteres'
    },
    txt_apellidos: {
      required: 'Campo requerido *',
      minlength: 'Ingresa un apellido válido',
      maxlength: 'Máximo permitido 45 caracteres'
    },
    txt_email: {
      required: 'Campo requerido *',
      email: 'Correo inválido (ejemplo: dmc@gmail.com)'
    },
    txt_password: {
      required: 'Campo requerido *',
      minlength: 'Mínimo 10'
    }
  },
  invalidHandler: function(form) {
    //*Acción a ejecutar al no completar todos los campos requeridos
    M.toast({
      html: 'Por favor completa los campos requeridos',
      displayLength: 3000,
      classes: 'red'
    });
  },
  submitHandler: function() {
    var action = 'RegistroCliente';
    //*Se envían datos del form y action, al controlador mediante ajax
    $.ajax({
      data: `${$('#form_registro').serialize()}&action=${action}`,
      url: '../app/control/despCliente.php',
      type: 'POST',
      success: function(resp) {
        //*Acción a ejecutar si la respuesta existe
        switch (resp) {
          case '1':
            M.toast({
              html:
                'Lo sentimos el correo ingresado ya se encuentra en nuestros registros',
              displayLength: 3000,
              classes: 'red'
            });
            break;
          case '2':
            alert('Registro Exitoso');
            //*Se redirige al usuario al menu de cliente
            // location.href = 'index-cliente.php';
            break;
          default:
            console.log(resp);
        }
      },
      error: function() {
        alert('Lo sentimos ha ocurrido un error');
      }
    });
  }
});

//*Se anadió nuevo método para validar que el campo seleccionado solo contenga letras
jQuery.validator.addMethod(
  'lettersonly',
  function(value, element) {
    return (
      this.optional(element) ||
      /^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/i.test(
        value
      )
    );
  },
  'Ingresa solo letras por favor'
);
