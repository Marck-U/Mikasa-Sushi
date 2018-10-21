
// carga los datos al modal para actualizar, TipoC es tipo contacto
function cargaTipoC(id) {
  
  $('#modal-actualiza-tipo-contacto').modal('open');
  var action = 'CargatipoC';
  //*Se envían datos del form y action, al controlador mediante ajax
  $.ajax({
    data: "action=" + action + "&id=" + id,
    url: '../app/control/despTipoContacto.php',
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
            $('#lbl_id_tipo_contacto').text(id);
            $("label[for='txt_tipo_contacto']").addClass('active');
            $('#txt_tipo_contacto').val(item.descripcionTipoC);
          });
          break;
      }
    },
    error: function () {
      swal('Error', 'Lo siento a ocurrido un error', 'Error');
    }
  });
}
  
$('#Actualiza_tipo_contacto').validate({
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
    txt_tipo_contacto: {
      required: true,
      minlength: 3,
      maxlength: 45,
      lettersonly: true
    }
  },
  messages: {
    //*Se establecen mensajes de error a imprimir
    txt_tipo_contacto: {
      required: 'Campo requerido *',
      minlength: 'Ingresa un nombre válido',
      maxlength: 'Máximo permitido 45 caracteres'
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
        let action = 'actualizaTipoContacto';
        let idContacto = $('#lbl_id_tipo_contacto').text();
        let descripcionTipoC = $('#txt_tipo_contacto').val();
        //*Se envían datos del form y action, al controlador mediante ajax
        $.ajax({
          data: {
            action: action,
            idContacto: idContacto,
            descripcionTipoC: descripcionTipoC,
          },
          url: '../app/control/despTipoContacto.php',
          type: 'POST',
          success: function (resp) {
            // alert(resp);
            //*Acción a ejecutar si la respuesta existe
            switch (resp) {
              case '1': //*El cambio se realizó exitosamente
                alert(resp);
                swal('Listo', 'Se actualizo correctamente', 'success');
                CargarTablaTipoC();
                break;
              case '2':
                alert(resp);
                swal('Error', 'Ocurrio un problema', 'Error');
                break;
              default:
              swal('Error', resp, 'Error');
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

  // funcion para cargar la tabla de tipo Contacto
  function CargarTablaTipoC() {
    var action = 'CargarTablaTipoC';
    //*Se envían datos del form y action, al controlador mediante ajax
    $.ajax({
      data: `action=${action}`,
      url: '../app/control/despTipoContacto.php',
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
              tabla += `<tr><td>${item.descripcionTipoC}</td>`;
              tabla += `<td  class="center-align"><button class="btn btn-floating tooltipped red darken-4 waves-effect waves-light "
                data-position="right" data-tooltip="Eliminar" class='delete' id=${item.idTipoC} onclick='EliminarTipoContacto(${item.idTipoC})' ><i class="material-icons">delete</i></button></td>`;
              tabla += `<td><a class="waves-effect red darken-4 waves-light btn modal-trigger" id="${item.idTipoC}" onclick='cargaTipoC(${item.idTipoC})' data-position="right" href="#modal-actualiza-tipo-contacto"><i class="material-icons">edit</i></a><td></tr>`;
            });
            $('#tabla_tipoContacto').html(tabla);
            break;
        }
      },
      error: function () {
        swal('Error', 'Lo siento a ocurrido un error', 'Error');
      }
    });
  }
  CargarTablaTipoC();

function EliminarTipoContacto(id) {
  var action = "EliminarTipoContacto";
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
        url: "../app/control/despTipoContacto.php",
        type: "POST",
        success: function (resp) {
          // alert(resp);
          if (parseInt(resp) == 1) {
            // alert("funciona");
            swal('Listo', 'El cliente fue eliminado', 'success');
            CargarTablaTipoC();
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

$('#form_registro_tipoContacto').validate({
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
    txt_descripcionCon: {
      required: true,
      minlength: 3,
      maxlength: 45,
      lettersonly: true
    }
  },
  messages: {
    //*Se establecen mensajes de error a imprimir
    txt_descripcionCon: {
      required: 'Campo requerido *',
      minlength: 'Ingresa un nombre válido',
      maxlength: 'Máximo permitido 45 caracteres'
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
    var action = 'Registro_tipo_contacto';
    //*Se envían datos del form y action, al controlador mediante ajax
    $.ajax({
      data: `${$('#form_registro_tipoContacto').serialize()}&action=${action}`,
      url: '../app/control/despTipoContacto.php',
      type: 'POST',
      success: function(resp) {
        //*Acción a ejecutar si la respuesta existe
        alert(resp);
        switch (resp) {
          case '1':
          swal('error', 'No se pudo ingresar el registro', 'error');
            break;
          case '2':
          // CargarTablaEmpleados();
          // limpiarFormulario();
          swal('Listo', 'Registro exitoso', 'success');
          CargarTablaTipoC();
          limpiarFormulario();
            break;
          default:
          //  alert(resp);
        }
      },
      error: function() {
          // alert(resp);
        swal('error', 'Ups ocurrio un error', 'error');
      }
    });
  }
});

  function limpiarFormulario() {
    document.getElementById("form_registro_tipoContacto").reset();
  }
  
  $('#txt_filtro_tipocontacto').on('keyup',function() {
    var filtroCliente = $(this)
      .val()
      .toLowerCase();
    $('#tabla_tipoContacto tr').filter(function(){
      $(this).toggle(
        $(this)
        .text()
        .toLowerCase()
        .indexOf(filtroCliente) > -1
    );
      });
  });
  