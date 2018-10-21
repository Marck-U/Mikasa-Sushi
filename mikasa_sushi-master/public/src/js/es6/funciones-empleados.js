function cargaModalEmpleado(id) {
    $('#modal_actualiza_empleado').modal('open');
    var action = 'cargaModalEmpleado';
    //*Se envían datos del form y action, al controlador mediante ajax
    $.ajax({
      data: "action=" + action + "&id=" + id,
      url: '../app/control/despEmpleados.php',
      type: 'POST',
      success: function (respuesta) {
        // alert(respuesta);
        var arr = JSON.parse(respuesta);
        //*Acción a ejecutar si la respuesta existe
        switch (respuesta) {
          case 'error':
          swal('error', 'ocurrio un problema', 'error');
            break;
          default:
            //* Por defecto los datos serán cargados en pantalla
            $.each(arr, function (indice, item) {
              $('#lbl_id_empleados').text(id);
              $("label[for='txt_nombre']").addClass('active');
              $('#txt_nombre').val(item.Nombre);
              $(`label[for='txt_apellidos']`).addClass('active');
              $('#txt_apellidos').val(item.Apellidos);
              $(`label[for='txt_email']`).addClass('active');
              $('#txt_email').val(item.Correo);
              $('#combo_EstadoEmpleado').val(item.idEstado);
              $('#combo_TipoEmpleado2').val(item.idTipoEmpleado);
              
            });
            break;
        }
      },
      error: function () {
        swal('error', 'Lo siento a ocurrido un error', 'error');
      }
    });
  }

  $('#ActualizaEmpleados').validate({
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
      combo_EstadoClientes:{
        required: true
      },
      combo_TipoEmpleado2:{
        required: true
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
      combo_EstadoClientes:{
        required: 'Campo requerido *'
      },
      combo_TipoEmpleado2:{
        required: 'Campo requerido *'
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
          let action = 'ActualizaEmpleados';
          let idEmpleado = $('#lbl_id_empleados').text();
          let nombre = $('#txt_nombre').val();
          let apellidos = $('#txt_apellidos').val();
          let email = $('#txt_email').val();
          let idEstado = $('#combo_EstadoEmpleado').val();
          let idTipoEmp = $('#combo_TipoEmpleado2').val();
          //*Se envían datos del form y action, al controlador mediante ajax
          $.ajax({
            data: {
              id: idEmpleado,
              nombre: nombre,
              apellidos: apellidos,
              email: email,
              idEstado: idEstado,
              idTipoEmp: idTipoEmp,
              action: action
            },
            url: '../app/control/despEmpleados.php',
            type: 'POST',
            success: function (resp) {
              // alert(resp);
              //*Acción a ejecutar si la respuesta existe
              switch (resp) {
                case '1': //*El cambio se realizó exitosamente
                  // alert(resp);
                  swal('Listo', 'El empleado fue actualizado', 'success');
                  CargarTablaEmpleados();
                  break;
                case '2':
                  // alert(resp);
                  swal('error', 'El empleado no pudo actualizarse', 'error');
                  break;
                default:
                // alert(resp);
                swal('error', 'Lo siento hubo un problema al actualizar', 'error');
              }
            },
            error: function () {
              swal('error', 'Lo siento a ocurrido un error', 'error');
            }
          });
        }
      }); 
    }
  });
  

// esta funcion carga el combo box del modal para actualizar el cliente
  function CargaEstadoEmpleadoModal() {
    var action = 'CargaEstadoEmpleado';
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
        cargaHtml += `<option disabled selected>Estado Empleado</option>`;
        $.each(arr, function (indice, item) {
          cargaHtml += `<option value='${item.idEstado}'>${item.Estado}</option>`;
        });
        $('#combo_EstadoEmpleado').html(cargaHtml);
      },
      error: function () {
        swal('Error', 'Lo siento a ocurrido un error', 'Error');
      }
    });
  }

// respectivamente se cargan los combobox de tipo Empleado como los de arriba
  function CargaTipoEmpleado() {
    var action = 'CargaTipoEmpleado';
    $('select').formSelect();
    var cargaHtml = '';
    var cargaHtmlFiltro = '';
    //*Se envían datos del form y action, al controlador mediante ajax
    $.ajax({
      data: `action=${action}`,
      url: '../app/control/despTipoEmpleado.php',
      type: 'POST',
      success: function (respuesta) {
        // *cargaHtml es para los combobox del formulario
        // *cargaHtmlFiltro es para el combobox de filtro del mantenedor
        var arr = JSON.parse(respuesta);
        cargaHtml += `<option disabled selected>Tipo Empleado</option>`;
        $.each(arr, function (indice, item) {
          cargaHtml += `<option value='${item.idTipoEmp}'>${item.TipoEmpleado}</option>`;
        });
        $('#combo_TipoEmpleado').html(cargaHtml);
      },
      error: function () {
        swal('Error', 'Lo siento a ocurrido un error', 'Error');
      }
    });
  }

  function CargaTipoEmpleadoModal() {
    var action = 'CargaTipoEmpleado';
    $('select').formSelect();
    var cargaHtml = '';
    var cargaHtmlFiltro = '';
    //*Se envían datos del form y action, al controlador mediante ajax
    $.ajax({
      data: `action=${action}`,
      url: '../app/control/despTipoEmpleado.php',
      type: 'POST',
      success: function (respuesta) {
        // *cargaHtml es para los combobox del formulario
        // *cargaHtmlFiltro es para el combobox de filtro del mantenedor
        var arr = JSON.parse(respuesta);
        cargaHtml += `<option disabled selected>Tipo Empleado</option>`;
        $.each(arr, function (indice, item) {
          cargaHtml += `<option value='${item.idTipoEmp}'>${item.TipoEmpleado}</option>`;
        });
        $('#combo_TipoEmpleado2').html(cargaHtml);
      },
      error: function () {
        swal('Error', 'Lo siento a ocurrido un error', 'Error');
      }
    });
  }


  // cancela el modal
  $('#cancelar_actualizar_empleado').on('click', function(evt) {
    evt.preventDefault();
    $('#modal_actualiza_empleado').modal('close');
  });
  
  function EliminarEmpleado(id) {
    var action = "EliminarEmpleado";
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
          url: "../app/control/despEmpleados.php",
          type: "POST",
          success: function (resp) {
            // console.log(action);
            if (parseInt(resp) == 1) {
              // alert("funciona");
              swal('Listo', 'El empleado fue eliminado', 'success');
              CargarTablaEmpleados();
            } else {
              swal('Error', 'El empleado no pudo ser eliminado', 'error');
              // alert("no funciono");
              // alert(resp); 
            }
          }
        });
      }
    });
  }
  
  function CargarTablaEmpleados() {
    var action = 'CargarTablaEmpleados';
    //*Se envían datos del form y action, al controlador mediante ajax
    $.ajax({
      data: `action=${action}`,
      url: '../app/control/despEmpleados.php',
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
              tabla += `<td>${item.Correo}</td>`;
              tabla += `<td>${item.TipoEmpleado}</td>`;
              tabla += `<td>${item.Estado}</td>`;
              tabla += `<td  class="center-align"><button class="btn btn-floating tooltipped red darken-4 waves-effect waves-light "
                data-position="right" data-tooltip="Eliminar" class='delete' id=${item.idEmpleado} onclick='EliminarEmpleado(${item.idEmpleado})' ><i class="material-icons">delete</i></button></td>`;
              tabla += `<td><a class="waves-effect red darken-4 waves-light btn modal-trigger" id="${item.idEmpleado}" onclick='cargaModalEmpleado(${item.idEmpleado})' data-position="right" href="#modal-actualiza-cliente"><i class="material-icons">edit</i></a><td></tr>`;
            });
            $('#tabla_empleados').html(tabla);
            break;
        }
      },
      error: function () {
        swal('Error', 'Lo siento a ocurrido un error', 'Error');
      }
    });
  }
  CargarTablaEmpleados();
  
  
  $('#form_registro_empleado').validate({
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
      combo_TipoEmpleado:{
        required: true
      },
    //   txt_telefono:{
    //     required: true,
    //     digits: true,
    //     min: 11111111,
    //     max: 99999999
    //   }
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
      combo_TipoEmpleado:{
        required: 'Campo requerido *'
      },
    //   txt_telefono: {
    //     required: 'Campo requerido *',
    //     // minlength: 'Mínimo 1 numero',
    //     // maxlength: 'Maximo 8 numeros',
    //     digits: 'Solo numeros',
    //     min: 'No menor a 7 numeros',
    //     max: 'No pueder ser mayor a 9'
    //   }
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
      var action = 'RegistroEmpleado';
      var resp = '';
      //*Se envían datos del form y action, al controlador mediante ajax
      $.ajax({
        data: `${$('#form_registro_empleado').serialize()}&action=${action}`,
        url: '../app/control/despEmpleados.php',
        type: 'POST',
        success: function(resp) {
          //*Acción a ejecutar si la respuesta existe
          // alert(resp);
          switch (resp) {
            case '1':
            swal('error', 'El correo ya fue registrado', 'error');
              break;
            case '2':
            CargarTablaEmpleados();
            limpiarFormulario();
            swal('Listo', 'El empleado fue registrado', 'success');
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
    document.getElementById("form_registro_empleado").reset();
  }
  
  $('#txt_filtro_empleados').on('keyup',function() {
    var filtroEmpleado = $(this)
      .val()
      .toLowerCase();
    $('#tabla_empleados tr').filter(function(){
      $(this).toggle(
        $(this)
        .text()
        .toLowerCase()
        .indexOf(filtroEmpleado) > -1
    );
      });
  });
  
  