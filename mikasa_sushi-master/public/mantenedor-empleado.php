<nav class="top-nav background red">
        <div class="container">
            <div class="nav-wrapper">
                <div class="row">
                    <div class="col s12 m10 l10 offset-l1">
                        <h1 class="center-align">Mantenedor empleado</h1>
                    </div>
                </div>
            </div>
        </div>
    </nav>
<?php
require_once "templates/nav-admin.php";
?>
<!-- Seccion de las tablas de carga de informacion-->
<div class="container">
    <div class="row">
        <div class="col s12 m12  offset-l10 xl11 offset-xl2">
            <div>
                <label for="">Filtro empleado</label>
                <input type="text" name="" id="txt_filtro_empleados">
            </div>
            <div class="">
                <table  cellpadding="1" cellspacing="1" class="table table-hover" id='tabla_filtro_empleados'>
                    <thead>
                        <tr class="">
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Correo</th>
                            <th>Tipo Empleado</th>
                            <th>Estado</th>
                            <th colspan="2">Accion</th>
                        </tr>
                    </thead>
                    <tbody id="tabla_empleados">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal de actualizar empleado -->
    <div>
        <form action="" method="POST" name="ActualizaEmpleados" id="ActualizaEmpleados">
            <div id="modal_actualiza_empleado" class="modal info-perfil-content">
                <div class="modal-content">
                    <h4 class="center-align">Actualiza empleado</h4>
                    <label id="lbl_id_empleados" class=""></label>
                    <div class="row">
                        <div class="row">
                            <div class="input-field col s12">
                                <input placeholder="Placeholder" name="txt_nombre" id="txt_nombre" type="text" class="validate">
                                <label for="txt_nombre">Nombre</label>
                            </div>
                            <div class="input-field col s12">
                                <input id="txt_apellidos" name="txt_apellidos" type="text" class="validate">
                                <label for="txt_apellidos">Apellido</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="txt_email" name="txt_email" type="text" class="validate">
                                <label for="txt_email">Correo</label>
                            </div>
                        </div>
                        <div class="input-field col s12">
                            <label class="active">Estado empleado</label>
                            <select name="combo_EstadoEmpleado" id="combo_EstadoEmpleado" class="browser-default">
                            </select>
                        </div>
                        <!-- combo_tipoEmpleado2 se nombra el combobox ya que si se deja como el combo del formulario solo se logran insertar los datos en uno-->
                        <div class="input-field col s12">
                            <label class="active">Tipo empleado</label>
                            <select name="combo_TipoEmpleado2" id="combo_TipoEmpleado2" class="browser-default">
                            </select>
                        </div>
                        <div class="col s10 offset-s1 center-align">
                            <button class="btn waves-effect waves-light btn-large background red" type="submit" name="action">
                                Actualizar<i class="material-icons right">send</i>
                            </button>
                            <button class="btn waves-effect waves-light btn-large background red" id="cancelar_actualizar_empleado">
                                Cancelar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- Formulario de ingreso de los mantenedores-->
    <form class="row" id="form_registro_empleado" action="" method="POST">
        <div class="container col s12 m12  offset-l10 xl11 offset-xl2 ">
            <div class="row">
                <div class="card grey lighten-3" style="width: 100%;">
                    <div class="card-content">
                        <span class="card-title">Ingreso empleado</span>
                        <div class="row">
                            <div class="row">
                                <div class="input-field col s12">
                                    <input placeholder="Placeholder" name="txt_nombre" id="nombre" type="text" class="validate">
                                    <label for="nombre">Nombre</label>
                                </div>
                                <div class="input-field col s12">
                                    <input id="apellidos" name="txt_apellidos" type="text" class="validate">
                                    <label for="apellidos">Apellido</label>
                                </div>
                            </div>
                            <div class="input-field col s12">
                            <label class="active">Tipo empleado</label>
                            <select name="combo_TipoEmpleado" id="combo_TipoEmpleado" class="browser-default">
                            </select>
                        </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="email" name="txt_email" type="text" class="validate">
                                    <label for="email">Correo</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="password" name="txt_password" type="password" class="validate">
                                    <label for="password">Contraseña</label>
                                </div>
                            </div>

                            <div class="col s10 offset-s1 center-align">
                                <button class="btn waves-effect waves-light btn-large background red" type="submit"
                                    name="action">
                                    Registrar<i class="material-icons right">send</i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

<script src="src/js/es6/funciones-empleados.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.4/dist/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.4/dist/sweetalert2.min.css"></script>
<script>
    $(document).ready(function () {
        
        $('modal_actualiza_empleado').modal({
            dismissible: true,
            onCloseEnd: function () {
                $('#lbl_id_empleados').text('');
            }
        });
    });
    CargarTablaEmpleados();
    // Estas dos funciones cargan los combobox respectivos
    CargaTipoEmpleado();
    CargaTipoEmpleadoModal();
    CargaEstadoEmpleadoModal();
</script>
</body>

</html>