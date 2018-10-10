$(document).ready(function() {
  function cargarDatosPerfilCliente() {
    var action = 'ObtenerDatosPerfil';
    //*Se envían datos del form y action, al controlador mediante ajax
    $.ajax({
      data: `action=${action}`,
      url: '../app/control/despCliente.php',
      type: 'POST',
      success: function(respuesta) {
        var arr = JSON.parse(respuesta);
        //*Acción a ejecutar si la respuesta existe
        switch (respuesta) {
          case 'error':
            alert('Lo sentimos ha ocurrido un error');
            break;
          default:
            //* Por defecto los datos serán cargados en pantalla
            $.each(arr, function(indice, item) {
              $('#txt_nombre').val(item.Nombre);
              $('#txt_apellidos').val(item.Apellidos);
              $('#txt_correo').val(item.Correo);
              if (item.Telefono === 'NULL') {
                $('#txt_telefono').val('');
              } else {
                $('#txt_telefono').val(item.Telefono);
              }
            });
            break;
        }
      },
      error: function() {
        alert('Lo sentimos ha ocurrido un error');
      }
    });
  }
  cargarDatosPerfilCliente();

  // *Login clientes
  // *Validación de formulario de cambios de datos para el cliente cuya sesión esté activa
  $('#form-editar-perfil-cliente').validate({
    //*configuración de jquery validata para la validación de campos
    errorClass: 'invalid red-text',
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
      txt_telefono: {
        minlength: true,
        minlength: 8,
        maxlength: 8,
        digits: true
      }
    },
    messages: {
      //*Se establecen mensajes de error a imprimir
      txt_nombre: {
        required: 'Campo requerido *',
        minlength: 'Ingresa un nombre válido',
        maxlength: 'Máximo permitido 45 caracteres',
        lettersonly: true
      },
      txt_apellidos: {
        required: 'Campo requerido *',
        minlength: 'Ingresa un nombre válido',
        maxlength: 'Máximo permitido 45 caracteres',
        lettersonly: true
      },
      txt_telefono: {
        minlength: 'Ingresa un número válido (8 digitos)',
        maxlength: 'Ingresa un número válido (8 digitos)',
        digits: 'Solo números'
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
    submitHandler: function(form) {
      let action = 'EditarPerfilCliente';
      let nombre = $('#txt_nombre').val();
      let apellidos = $('#txt_apellidos').val();
      let telefono = $('#txt_telefono').val();
      //*Se envían datos del form y action, al controlador mediante ajax
      $.ajax({
        data: {
          txt_nombre: nombre,
          txt_apellidos: apellidos,
          txt_telefono: telefono,
          action: action
        },
        url: '../app/control/despCliente.php',
        type: 'POST',
        success: function(resp) {
          //*Acción a ejecutar si la respuesta existe
          switch (resp) {
            case '1': //*El cambio se realizó exitosamente
              console.log('exito');
              cargarDatosPerfilCliente();
              break;
            case '2':
              //* El cambio no se pudo llevar a cabo por un error inesperado
              M.toast({
                html: 'Lo sentimos ha ocurrido un error inesperado',
                displayLength: 3000,
                classes: 'red'
              });
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

  //* Validación del formulario para cambiar la clave del cliente
  $('#form-pass-cliente').validate({
    //*configuración de jquery validata para la validación de campos
    errorClass: 'invalid red-text',
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
      txt_pass_actual: {
        required: true,
        minlength: 10,
        maxlength: 100
      },
      txt_pass_nueva: {
        required: true,
        minlength: 10,
        maxlength: 100
      },
      txt_pass_confirmar: {
        required: true,
        minlength: 10,
        maxlength: 100,
        equalTo: '#txt_pass_nueva'
      }
    },
    messages: {
      //*Se establecen mensajes de error a imprimir
      txt_pass_actual: {
        required: 'Campo requerido *',
        minlength: 'Mínimo 10 caracteres',
        maxlength: 'Máximo 10 caracteres'
      },
      txt_pass_nueva: {
        required: 'Campo requerido *',
        minlength: 'Mínimo 10 caracteres',
        maxlength: 'Máximo 10 caracteres'
      },
      txt_pass_confirmar: {
        required: 'Campo requerido *',
        minlength: 'Mínimo 10 caracteres',
        maxlength: 'Máximo 10 caracteres',
        equalTo: 'Las contraseñas no coinciden'
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
    submitHandler: function(form) {
      var action = 'ConfirmarPassCliente';
      var pass_actual = $('#txt_pass_actual').val();
      var pass_nueva = $('#txt_pass_nueva').val();
      var pass_confirmar = $('#txt_pass_confirmar').val();
      //*Se envían datos del form y action, al controlador mediante ajax
      $.ajax({
        data: {
          txt_pass_actual: pass_actual,
          action: action
        },
        url: '../app/control/despCliente.php',
        type: 'POST',
        success: function(resp) {
          //*Acción a ejecutar si la respuesta existe
          switch (resp) {
            case '1':
              //* La contraseña del primer campo (actual) coincide con la almacenada en BD
              var action2 = 'CambiarPassCliente';
              //* Se ejecuta otra solicitud para llevar a cabo la actualización de la contraseña
              $.ajax({
                data: {
                  txt_pass_nueva: pass_nueva,
                  txt_pass_confirmar: pass_confirmar,
                  action: action2
                },
                url: '../app/control/despCliente.php',
                type: 'POST',
                success: function(respuesta) {
                  switch (respuesta) {
                    case '1':
                      //* La contraseña fue cambiada de manera exitosa
                      M.toast({
                        html: 'La contraseña ha sido cambiada exitosamente',
                        displayLength: 3000,
                        classes: 'green'
                      });
                      $('#modal-password').modal();
                      $('#form-pass-cliente')[0].reset();
                      break;
                    case '2':
                      //* No se ha podido llevar a cabo el cambio de contraseña
                      M.toast({
                        html: 'Lo sentimos ha ocurrido un error inesperado',
                        displayLength: 3000,
                        classes: 'red'
                      });
                      break;
                  }
                },
                error: function() {
                  alert('Lo sentimos ha ocurrido un error');
                }
              });
              break;
            case '2':
              M.toast({
                html: 'Lo sentimos ha ocurrido un error inesperado',
                displayLength: 3000,
                classes: 'red'
              });
              console.log('error');
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
});
