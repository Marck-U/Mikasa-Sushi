function cargaCliente(id) {
  $('#modal-actualiza-cliente').modal('open');
  var action = 'CargaCliente';
  //*Se envían datos del form y action, al controlador mediante ajax
  $.ajax({
    data: "action=" + action + "&id=" + id,
    url: '../app/control/despCliente.php',
    type: 'POST',
    success: function (respuesta) {
      // alert(respuesta);
      var arr = JSON.parse(respuesta);
      //*Acción a ejecutar si la respuesta existe
      switch (respuesta) {
        case 'error':
        swal('Error', 'Lo siento a ocurrido un error', 'Error');
          break;
        default:
          //* Por defecto los datos serán cargados en pantalla
          $.each(arr, function (indice, item) {
            $('#lbl_id_clientes').text(id);
            $("label[for='txt_nombre']").addClass('active');
            $('#txt_nombre').val(item.Nombre);
            $(`label[for='txt_apellidos']`).addClass('active');
            $('#txt_apellidos').val(item.Apellidos);
            $(`label[for='txt_email']`).addClass('active');
            $('#txt_email').val(item.Correo);
            $(`label[for='txt_telefono']`).addClass('active');
            $('#txt_telefono').val(item.Telefono);
            $('#combo_EstadoClientes').val(item.idEstado);
            
          });
          break;
      }
    },
    error: function () {
      swal('Error', 'Lo siento a ocurrido un error', 'Error');
    }
  });
}

// $("a").click(function(){
//   idCliente = $(this).attr("id");
// });
$('#ActualizaCliente').validate({
  //*Se utiliza jquery validate para validar campos del formulario
  errorClass: 'invalid red-text', //*Clase añadida post-error
  validClass: 'valid',
  errorElement: 'div',
  errorPlacement: function (error, element) {
    $(element)
      .closest('form')
      .find(`label[for=${element.attr('id')}]`) //*Se insertará un label para representar el error
      .attr('data-error', error.text()); //*Se obtiene el texto de error
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
    txt_telefono: {
      required: true,
      digits: true,
      min: 11111111,
      max: 99999999
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
    txt_telefono: {
      required: 'Campo requerido *',
      // minlength: 'Mínimo 1 numero',
      // maxlength: 'Maximo 8 numeros',
      digits: 'Solo numeros',
      min: 'No menor a 7 numeros',
      max: 'No pueder ser mayor a 8'
    }
  },
  invalidHandler: function (form) {
    //*Acción a ejecutar al no completar todos los campos requeridos
    M.toast({
      html: 'Por favor completa los campos requeridos',
      displayLength: 3000,
      classes: 'red'
    });
  },
  submitHandler: function (form) {
    swal({
      title: '¿Estás seguro?',
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si',
      cancelButtonText: 'Cancelar'
    }).then(result => {
      if (result.value) {
        let action = 'ActualizaCliente';
        let idCliente = $('#lbl_id_clientes').text();
        let nombre = $('#txt_nombre').val();
        let apellidos = $('#txt_apellidos').val();
        let email = $('#txt_email').val();
        let telefono = $('#txt_telefono').val();
        let idEstado = $('#combo_EstadoClientes').val();
        //*Se envían datos del form y action, al controlador mediante ajax
        $.ajax({
          data: {
            id: idCliente,
            nombre: nombre,
            apellidos: apellidos,
            telefono: telefono,
            email: email,
            idEstado: idEstado,
            action: action
          },
          url: '../app/control/despCliente.php',
          type: 'POST',
          success: function (resp) {
            // alert(resp);
            //*Acción a ejecutar si la respuesta existe
            switch (resp) {
              case '1': //*El cambio se realizó exitosamente
                // alert(resp);
                swal('Listo', 'El cliente fue actualizado', 'success');
                CargarTablaClientes();
                break;
              case '2':
                // alert(resp);
                swal('Error', 'El cliente fue eliminado', 'Error');
                break;
              default:
              swal('Error', 'Lo siento a ocurrido un error', 'Error');
            }
          },
          error: function () {
            swal('Error', 'Lo siento a ocurrido un error', 'Error');
          }
        });
      }
    }); 
  }
});

// *Se cargan los combobox del mantenedor
function CargaEstadoCliente() {
  var action = 'CargaEstadoCliente';
  $('select').formSelect();
  var cargaHtml = '';
  var cargaHtmlFiltro = '';
  //*Se envían datos del form y action, al controlador mediante ajax
  $.ajax({
    data: `action=${action}`,
    url: '../app/control/depIndiceEstadoCli.php',
    type: 'POST',
    success: function (respuesta) {
      // *cargaHtml es para los combobox del formulario
      // *cargaHtmlFiltro es para el combobox de filtro del mantenedor
      var arr = JSON.parse(respuesta);
      cargaHtml += `<option disabled selected>Estado Cliente</option>`;
      $.each(arr, function (indice, item) {
        cargaHtml += `<option value='${item.idEstado}'>${item.Estado}</option>`;
      });
      $('#combo_EstadoClientes').html(cargaHtml);
    },
    error: function () {
      swal('Error', 'Lo siento a ocurrido un error', 'Error');
    }
  });
}
// cancela el modal
$('#cancelar_actualizar_cliente').on('click', function(evt) {
  evt.preventDefault();
  $('#modal-actualiza-cliente').modal('close');
});

function EliminarClientes(id) {
  var action = "EliminarCliente";
  swal({
    title: '¿Estás seguro?',
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si',
    cancelButtonText: 'Cancelar'
  }).then(result => {
    if (result.value) {
      // alert(id);
      $.ajax({
        data: "action=" + action + "&id=" + id,
        url: "../app/control/despCliente.php",
        type: "POST",
        success: function (resp) {
          // console.log(action);
          if (parseInt(resp) == 1) {
            // alert("funciona");
            swal('Listo', 'El cliente fue eliminado', 'success');
            CargarTablaClientes();
          } else {
            swal('Error', 'El cliente no pudo ser eliminado', 'error');
            // alert("no funciono");
            // alert(resp); 
          }
        }
      });
    }
  });
}

function CargarTablaClientes() {
  var action = 'CargarTablaClientes';
  //*Se envían datos del form y action, al controlador mediante ajax
  $.ajax({
    data: `action=${action}`,
    url: '../app/control/despCliente.php',
    type: 'POST',
    success: function (respuesta) {
      //  alert(respuesta);
      var arr = JSON.parse(respuesta);
      var tabla = '';
      //*Acción a ejecutar si la respuesta existe
      switch (respuesta) {
        case 'error':
        swal('Error', 'Lo siento a ocurrido un error', 'Error');
          break;
        default:
          //* Por defecto los datos serán cargados en pantalla
          $.each(arr, function (indice, item) {
            // var idCliente = item.idCliente;
            tabla += `<tr><td>${item.Nombre}</td>`;
            tabla += `<td>${item.Apellidos}</td>`;
            tabla += `<td>${item.Telefono}</td>`;
            tabla += `<td>${item.Correo}</td>`;
            tabla += `<td>${item.Estado}</td>`;
            tabla += `<td  class="center-align"><button class="btn btn-floating tooltipped red darken-4 waves-effect waves-light "
              data-position="right" data-tooltip="Eliminar" class='delete' id=${item.idCliente} onclick='EliminarClientes(${item.idCliente})' ><i class="material-icons">delete</i></button></td>`;
            tabla += `<td><a class="waves-effect red darken-4 waves-light btn modal-trigger" id="${item.idCliente}" onclick='cargaCliente(${item.idCliente})' data-position="right" href="#modal-actualiza-cliente"><i class="material-icons">edit</i></a><td></tr>`;
          });
          $('#tabla_clientes').html(tabla);
          break;
      }
    },
    error: function () {
      swal('Error', 'Lo siento a ocurrido un error', 'Error');
    }
  });
}
CargarTablaClientes();
'use strict';

$('#form_registro2').validate({
  //*Se utiliza jquery validate para validar campos del formulario
  errorClass: 'invalid red-text', //*Clase añadida post-error
  validClass: 'valid',
  errorElement: 'div',
  errorPlacement: function(error, element) {
    $(element)
      .closest('form')
      .find(`label[for=${element.attr('id')}]`) //*Se insertará un label para representar el error
      .attr('data-error', error.text()); //*Se obtiene el texto de error
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
    },
    txt_telefono:{
      required: true,
      digits: true,
      min: 11111111,
      max: 99999999
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
    },
    txt_telefono: {
      required: 'Campo requerido *',
      // minlength: 'Mínimo 1 numero',
      // maxlength: 'Maximo 8 numeros',
      digits: 'Solo numeros',
      min: 'No menor a 7 numeros',
      max: 'No pueder ser mayor a 9'
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
      data: `${$('#form_registro2').serialize()}&action=${action}`,
      url: '../app/control/despCliente.php',
      type: 'POST',
      success: function(resp) {
        //*Acción a ejecutar si la respuesta existe
        switch (resp) {
          case '1':
          swal('Error', 'el correo ya fue registrado', 'Error');
            break;
          case '2':
          CargarTablaClientes();
          limpiarFormulario();
          swal('Listo', 'El cliente fue actualizado', 'success');
            break;
          default:
            // console.log(resp);
        }
      },
      error: function() {
        swal('Error', 'Ups ocurrio un error', 'Error');
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
$(document).ready(function() {
  M.updateTextFields();
});

function limpiarFormulario() {
  document.getElementById("form_registro2").reset();
}

$('#txt_filtro_cliente').on('keyup',function() {
  var filtroCliente = $(this)
    .val()
    .toLowerCase();
  $('#tabla_filtro_cliente tr').filter(function(){
    $(this).toggle(
      $(this)
      .text()
      .toLowerCase()
      .indexOf(filtroCliente) > -1
  );
    });
});

