'use strict';

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

$(document).ready(function () {
  // *Activa sidenav
  $('.sidenav').sidenav();
  // *Activa parallax
  $('.parallax').parallax();
  // *Activa función de scrollspy
  $('.scrollspy').scrollSpy();
  // *Activa modal
  $('.modal').modal();
  // *Activa collapsible
  $('.collapsible').collapsible();
  // *Activa dropdown en li nav
  $('.dropdown-trigger').dropdown();
  // *Activa tabs
  $('.tabs').tabs();
  //* Activa slider
  $(document).ready(function () {
    $('.slider').slider();
  });
});

// * Activa funciones de cambios de slide en slider de index
$('.rigth-arrow-slider').click(function () {
  $('.slider').slider('next');
});

$('.left-arrow-slider').click(function () {
  $('.slider').slider('prev');
});
// -----------

$(document).ready(function () {
  var _txt_telefono;

  function cargarDatosPerfilCliente() {
    var action = 'ObtenerDatosPerfil';
    //*Se envían datos del form y action, al controlador mediante ajax
    $.ajax({
      data: 'action=' + action,
      url: '../app/control/despCliente.php',
      type: 'POST',
      success: function success(respuesta) {
        var arr = JSON.parse(respuesta);
        //*Acción a ejecutar si la respuesta existe
        switch (respuesta) {
          case 'error':
            alert('Lo sentimos ha ocurrido un error');
            break;
          default:
            //* Por defecto los datos serán cargados en pantalla
            $.each(arr, function (indice, item) {
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
      error: function error() {
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
    errorPlacement: function errorPlacement(error, element) {
      $(element).closest('form').find('label[for=' + element.attr('id') + ']') //*Se insertará un label para representar el error
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
      txt_telefono: (_txt_telefono = {
        minlength: true
      }, _defineProperty(_txt_telefono, 'minlength', 8), _defineProperty(_txt_telefono, 'maxlength', 8), _defineProperty(_txt_telefono, 'digits', true), _txt_telefono)
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
    invalidHandler: function invalidHandler(form) {
      //*Acción a ejecutar al no completar todos los campos requeridos
      M.toast({
        html: 'Por favor completa los campos requeridos',
        displayLength: 3000,
        classes: 'red'
      });
    },
    submitHandler: function submitHandler(form) {
      var action = 'EditarPerfilCliente';
      var nombre = $('#txt_nombre').val();
      var apellidos = $('#txt_apellidos').val();
      var telefono = $('#txt_telefono').val();
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
        success: function success(resp) {
          //*Acción a ejecutar si la respuesta existe
          switch (resp) {
            case '1':
              //*El cambio se realizó exitosamente
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
        error: function error() {
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
    errorPlacement: function errorPlacement(error, element) {
      $(element).closest('form').find('label[for=' + element.attr('id') + ']') //*Se insertará un label para representar el error
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
    invalidHandler: function invalidHandler(form) {
      //*Acción a ejecutar al no completar todos los campos requeridos
      M.toast({
        html: 'Por favor completa los campos requeridos',
        displayLength: 3000,
        classes: 'red'
      });
    },
    submitHandler: function submitHandler(form) {
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
        success: function success(resp) {
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
                success: function success(respuesta) {
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
                error: function error() {
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
        error: function error() {
          alert('Lo sentimos ha ocurrido un error');
        }
      });
    }
  });
});

'use strict';

// *Login clientes
$('#form-login-cliente').validate({
  //*configuración de jquery validata para la validación de campos
  errorClass: 'invalid red-text',
  validClass: 'valid',
  errorElement: 'div',
  errorPlacement: function errorPlacement(error, element) {
    $(element).closest('form').find('label[for=' + element.attr('id') + ']') //*Se insertará un label para representar el error
    .attr('data-error', error.text()); //*Se obtiene el texto de erro
    error.insertAfter(element); //*Se inserta el error después del elemento
  },
  rules: {
    //*Se establecen reglas de validación para campos del form
    txt_email: {
      required: true,
      email: true
    },
    txt_password: {
      required: true
    }
  },
  messages: {
    //*Se establecen mensajes de error a imprimir
    txt_email: {
      required: 'Campo requerido *',
      email: 'Ingresa un correo válido'
    },
    txt_password: {
      required: 'Campo requerido *'
    }
  },
  invalidHandler: function invalidHandler(form) {
    //*Acción a ejecutar al no completar todos los campos requeridos
    M.toast({
      html: 'Por favor completa los campos requeridos',
      displayLength: 3000,
      classes: 'red'
    });
  },
  submitHandler: function submitHandler(form) {
    var action = 'LoginCliente';
    //*Se envían datos del form y action, al controlador mediante ajax
    $.ajax({
      data: $('#form-login-cliente').serialize() + '&action=' + action,
      url: '../app/control/despCliente.php',
      type: 'POST',
      success: function success(resp) {
        //*Acción a ejecutar si la respuesta existe
        switch (resp) {
          case '1':
            //*Inicio de sesión exitoso, se redirige al usuario al menu de cliente
            location.href = 'index-cliente.php';
            break;
          case '2':
            M.toast({
              html: 'Los datos ingresador son incorrectos',
              displayLength: 3000,
              classes: 'red'
            });
            break;
          default:
            console.log(resp);
        }
      },
      error: function error() {
        alert('Lo sentimos ha ocurrido un error');
      }
    });
  }
});

//*Login empleados

$('#form-login-empleado').validate({
  //*configuración de jquery validata para la validación de campos
  errorClass: 'invalid red-text',
  validClass: 'valid',
  errorElement: 'div',
  errorPlacement: function errorPlacement(error, element) {
    $(element).closest('form').find('label[for=' + element.attr('id') + ']') //*Se insertará un label para representar el error
    .attr('data-error', error.text()); //*Se obtiene el texto de erro
    error.insertAfter(element); //*Se inserta el error después del elemento
  },
  rules: {
    //*Se establecen reglas de validación para campos del form
    txt_email: {
      required: true,
      email: true
    },
    txt_password: {
      required: true
    }
  },
  messages: {
    //*Se establecen mensajes de error a imprimir
    txt_email: {
      required: 'Campo requerido *',
      email: 'Ingresa un correo válido'
    },
    txt_password: {
      required: 'Campo requerido *'
    }
  },
  invalidHandler: function invalidHandler(form) {
    //*Acción a ejecutar al no completar todos los campos requeridos
    M.toast({
      html: 'Por favor completa los campos requeridos',
      displayLength: 3000,
      classes: 'red'
    });
  },
  submitHandler: function submitHandler(form) {
    var action = 'LoginEmpleado';
    //*Se envían datos del form y action, al controlador mediante ajax
    $.ajax({
      data: $('#form-login-empleado').serialize() + '&action=' + action,
      url: '../app/control/despEmpleados.php',
      type: 'POST',
      success: function success(respuesta) {
        console.log(respuesta);
        //*Acción a ejecutar si la respuesta existe
        switch (respuesta) {
          case '1':
            // alert('Registro Exitoso');
            //*Inicio de sesión exitoso se redirige al usuario al menu de admin
            location.href = 'index-admin.html';
            break;
          case '2':
            //*Inicio de sesión exitoso se redirige al usuario al menu de repartidor
            location.href = 'index-repartidor.html';
            break;
          case 'error':
            M.toast({
              html: 'Los datos ingresador son incorrectos',
              displayLength: 3000,
              classes: 'red'
            });
            break;
        }
      },
      error: function error() {
        alert('Lo sentimos ha ocurrido un error');
      }
    });
  }
});

'use strict';

$('#form_registro').validate({
  //*Se utiliza jquery validate para validar campos del formulario
  errorClass: 'invalid red-text', //*Clase añadida post-error
  validClass: 'valid',
  errorElement: 'div',
  errorPlacement: function errorPlacement(error, element) {
    $(element).closest('form').find('label[for=' + element.attr('id') + ']') //*Se insertará un label para representar el error
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
      minlength: 'Mínimo 10 caracteres'
    }
  },
  invalidHandler: function invalidHandler(form) {
    //*Acción a ejecutar al no completar todos los campos requeridos
    M.toast({
      html: 'Por favor completa los campos requeridos',
      displayLength: 3000,
      classes: 'red'
    });
  },
  submitHandler: function submitHandler() {
    var action = 'RegistroCliente';
    //*Se envían datos del form y action, al controlador mediante ajax
    $.ajax({
      data: $('#form_registro').serialize() + '&action=' + action,
      url: '../app/control/despCliente.php',
      type: 'POST',
      success: function success(resp) {
        //*Acción a ejecutar si la respuesta existe
        switch (resp) {
          case '1':
            M.toast({
              html: 'Lo sentimos el correo ingresado ya se encuentra en nuestros registros',
              displayLength: 3000,
              classes: 'red'
            });
            break;
          case '2':
            // alert('Registro Exitoso');
            //*Se redirige al usuario al menu de cliente
            location.href = 'index-cliente.php';
            break;
          default:
            console.log(resp);
        }
      },
      error: function error() {
        alert('Lo sentimos ha ocurrido un error');
      }
    });
  }
});

//*Se anadió nuevo método para validar que el campo seleccionado solo contenga letras
jQuery.validator.addMethod('lettersonly', function (value, element) {
  return this.optional(element) || /^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/i.test(value);
}, 'Ingresa solo letras por favor');