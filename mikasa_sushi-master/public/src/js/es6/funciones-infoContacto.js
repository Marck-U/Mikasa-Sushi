// Abre el modal y le carga los datos de info contacto
function cargaInfoContacto(id) {
    $('#modal_actualiza_contacto').modal('open');
    var action = 'CargaModalInfoC'; // infoC = info Contacto
    //*Se envían datos del form y action, al controlador mediante ajax
    $.ajax({
      data: "action=" + action + "&id=" + id,
      url: '../app/control/despInfoContacto.php',
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
              $('#lbl_id_info_contacto').text(id);
              $("label[for='txt_descripcionCon']").addClass('active');
              $('#txt_descripcionCon').val(item.descripcionContacto);
              $('#combo_tipoContacto2').val(item.descripcionTipoC);
              
            });
            break;
        }
      },
      error: function () {
        swal('Error', 'Lo siento a ocurrido un error', 'Error');
      }
    });
  }
  
// Utilizamos está funcion para validar y actualizar los datos dentro del modal
  $('#ActualizaContacto').validate({
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
      txt_descripcionCon: {
        required: true,
        minlength: 3,
        maxlength: 45,
        lettersonly: true
      },
      combo_tipoContacto2: {
        required: true,
      }
    },
    messages: {
      //*Se establecen mensajes de error a imprimir
      txt_descripcionCon: {
        required: 'Campo requerido *',
        minlength: 'Ingresa un nombre válido',
        maxlength: 'Máximo permitido 45 caracteres'
      },
      combo_tipoContacto2: {
        required: 'Campo requerido *',
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
          let action = 'ActualizaInfoContacto';
          let idContacto = $('#lbl_id_info_contacto').text();
          let descripcionContacto = $('#txt_descripcionCon').val();
          let TipoContaco = $('#combo_tipoContacto2').val();
          console.log(idContacto);
          console.log(descripcionContacto);
          console.log(TipoContaco);
          //*Se envían datos del form y action, al controlador mediante ajax
          $.ajax({
            data: {
              idContacto: idContacto,
              descripcionC: descripcionContacto,
              TipoContacto: TipoContaco,
              action: action
            },
            url: '../app/control/despInfoContacto.php',
            type: 'POST',
            success: function (resp) {
              // alert(resp);
              //*Acción a ejecutar si la respuesta existe
              switch (resp) {
                case '1': //*El cambio se realizó exitosamente
                  // alert(resp);
                  swal('Listo', 'El registro fue actualizado', 'success');
                  CargarTablaInfoContacto(); 
                  break;
                case '2':
                  // alert(resp);
                  swal('error', 'El registro no pudo ser actualizado', 'error');
                  break;
                default:
                alert(resp);
                swal('error', 'Lo siento hubo un problema', 'error');
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
  

  // Funcion para cancelar el modal
  $('#cancelar_actualizar_contacto').on('click', function(evt) {
    evt.preventDefault();
    $('#modal_actualiza_contacto').modal('close');
  });
  
  function EliminarContaco(id) {
    var action = "eliminarInfoContacto";
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
          url: "../app/control/despInfoContacto.php",
          type: "POST",
          success: function (resp) {
            // console.log(action);
            if (parseInt(resp) == 1) {
              // alert("funciona");
              swal('Listo', 'El registro fue eliminado', 'success');
              CargarTablaInfoContacto();
            } else {
              swal('Error', 'El registro no pudo ser eliminado', 'error');
              // alert("no funciono");
              // alert(resp); 
            }
          }
        });
      }
    });
  }
  
  function CargarTablaInfoContacto() {
    var action = 'CargarTablaInfoContacto';
    //*Se envían datos del form y action, al controlador mediante ajax
    $.ajax({
      data: `action=${action}`,
      url: '../app/control/despInfoContacto.php',
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
              tabla += `<tr><td>${item.descripcionContacto}</td>`;
              tabla += `<td>${item.descripcionTipoC}</td>`;
              tabla += `<td  class="center-align"><button class="btn btn-floating tooltipped red darken-4 waves-effect waves-light "
                data-position="right" data-tooltip="Eliminar" class='delete' id=${item.idContacto} onclick='EliminarContaco(${item.idContacto})' ><i class="material-icons">delete</i></button></td>`;
              tabla += `<td><a class="waves-effect red darken-4 waves-light btn modal-trigger" id="${item.idContacto}" onclick='cargaInfoContacto(${item.idContacto})' data-position="right" href="#modal_actualiza_contacto"><i class="material-icons">edit</i></a><td></tr>`;
            });
            $('#tabla_infoContacto').html(tabla);
            break;
        }
      },
      error: function () {
        swal('Error', 'Lo siento a ocurrido un error', 'Error');
      }
    });
  }
  CargarTablaInfoContacto();
  
  $('#form_registro_infoContacto').validate({
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
      txt_info_contacto: {
        required: true,
        minlength: 3,
        maxlength: 45,
        lettersonly: true
      },
      combo_info_contacto: {
        required: true,
      }
    },
    messages: {
      //*Se establecen mensajes de error a imprimir
      // txt_descripcion contaco
      txt_info_contacto: {
        required: 'Campo requerido *',
        minlength: 'Ingresa un nombre válido',
        maxlength: 'Máximo permitido 45 caracteres'
      },
      combo_info_contacto: {
        required: 'Campo requerido *',
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
      var action = 'RegistroinfoContacto';
      //*Se envían datos del form y action, al controlador mediante ajax
      $.ajax({
        data: `${$('#form_registro_infoContacto').serialize()}&action=${action}`,
        url: '../app/control/despInfoContacto.php',
        type: 'POST',
        success: function(resp) {
          //*Acción a ejecutar si la respuesta existe
          switch (resp) {
            case '1':
            alert(resp);
            swal('error', 'No se pudo ingresar el registro', 'error');
              break;
            case '2':
            limpiarFormulario();
            CargarTablaInfoContacto();
            swal('Listo', 'Registro exitoso', 'success');
              break;
            default:
              alert(resp);
          }
        },
        error: function() {
          swal('error', 'Ups ocurrio un error', 'error');
        }
      });
    }
  });
  
// *Se cargan los combobox del mantenedor
function cargaComboTipoContacto() {
  var action = 'cargaComboTipoContacto';
  $('select').formSelect();
  var cargaHtml = '';
  var cargaHtmlFiltro = '';
  //*Se envían datos del form y action, al controlador mediante ajax
  $.ajax({
    data: `action=${action}`,
    url: '../app/control/despTipoContacto.php',
    type: 'POST',
    success: function (respuesta) {
      // alert(respuesta);
      // *cargaHtml es para los combobox del formulario
      // *cargaHtmlFiltro es para el combobox de filtro del mantenedor
      var arr = JSON.parse(respuesta);
      cargaHtml += `<option disabled selected>Tipo Contacto</option>`;
      $.each(arr, function (indice, item) {
        cargaHtml += `<option value='${item.idTipoContacto}'>${item.descripcionTipoC}</option>`;
      });
      $('#combo_info_contacto').html(cargaHtml);
    },
    error: function () {
      swal('error', 'Lo siento a ocurrido un error', 'error');
    }
  });
}

function cargaComboTipoContacto2() {
  var action = 'cargaComboTipoContacto';
  $('select').formSelect();
  var cargaHtml = '';
  var cargaHtmlFiltro = '';
  //*Se envían datos del form y action, al controlador mediante ajax
  $.ajax({
    data: `action=${action}`,
    url: '../app/control/despTipoContacto.php',
    type: 'POST',
    success: function (respuesta) {
      // alert(respuesta);
      // *cargaHtml es para los combobox del formulario
      // *cargaHtmlFiltro es para el combobox de filtro del mantenedor
      var arr = JSON.parse(respuesta);
      cargaHtml += `<option disabled selected>Tipo Contacto</option>`;
      $.each(arr, function (indice, item) {
        cargaHtml += `<option value='${item.idTipoContacto}'>${item.descripcionTipoC}</option>`;
      });
      $('#combo_tipoContacto2').html(cargaHtml);
    },
    error: function () {
      swal('error', 'Lo siento a ocurrido un error', 'error');
    }
  });
}

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
  
  $('#txt_filtro_tipocontacto').on('keyup',function() {
    var filtroTipoContacto = $(this)
      .val()
      .toLowerCase();
    $('#tabla_filtro_tipo_contacto tr').filter(function(){
      $(this).toggle(
        $(this)
        .text()
        .toLowerCase()
        .indexOf(filtroTipoContacto) > -1
    );
      });
  });
  
  