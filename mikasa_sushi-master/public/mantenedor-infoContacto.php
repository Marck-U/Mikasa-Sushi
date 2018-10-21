<nav class="top-nav background red">
    <div class="container">
        <div class="nav-wrapper">
            <div class="row">
                <div class="col s12 m10 l10 offset-l1">
                    <h1 class="center-align">Mantenedor Info Contacto</h1>
                </div>
            </div>
        </div>
    </div>
</nav>
<?php
require_once "templates/nav-admin.php";
?>
<div class="container">
    <div class="row">
        <div class="col s12 m12  offset-l10 xl11 offset-xl2">
            <div>
                <label for="">Filtro Contacto</label>
                <input type="text" name="" id="txt_filtro_cliente">
            </div>
            <div class="">
                <table class="table table-hover table-responsive" id='tabla_filtro_contacto'>
                    <thead>
                        <tr class="">
                            <th>Descripcion Contacto</th>
                            <th>Tipo Contacto</th>
                            <th colspan="2">Accion</th>
                        </tr>
                    </thead>
                    <tbody id="tabla_infoContacto">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal de actualizar cliente -->
    <div>
        <form action="" method="POST" name="ActualizaContacto" id="ActualizaContacto">
            <div id="modal_actualiza_contacto" class="modal info-perfil-content">
                <div class="modal-content">
                    <h4 class="center-align">Modificar InfoContato</h4>
                    <label id="lbl_id_info_contacto" class=""></label>
                    <div class="row">
                        <div class="row">
                            <div class="input-field col s12">
                                <input placeholder="Placeholder" name="txt_descripcionCon" id="txt_descripcionCon" type="text"
                                    class="validate">
                                <label for="txt_descripcionCon">Descripcion Contacto</label>
                            </div>
                            <div class="input-field col s12">
                                <label class="active">Tipo Contacto</label>
                                <select name="combo_tipoContacto2" id="combo_tipoContacto2" class="browser-default">
                                </select> 
                            </div>
                            <div class="col s10 offset-s1 center-align">
                                <button class="btn waves-effect waves-light btn-large background red" type="submit"
                                    name="action">
                                    Actualizar<i class="material-icons right">send</i>
                                </button>
                                <button class="btn waves-effect waves-light btn-large background red" id="cancelar_actualizar_contacto">
                                    Cancelar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
        </form>
    </div>
    <!-- Formulario de ingreso de los mantenedores-->
    <form class="row" id="form_registro_infoContacto" name="form_registro_infoContacto" action="" method="POST">
        <div class="container col s12 m12  offset-l10 xl11 offset-xl2 ">
            <div class="row">
                <div class="card grey lighten-3" style="width: 100%;">
                    <div class="card-content">
                        <span class="card-title">Ingreso info contacto</span>
                        <div class="row">
                            <div class="row">
                                <div class="input-field col s12">
                                    <input placeholder="Placeholder" name="txt_info_contacto" id="txt_descripcionCon"
                                        type="text" class="validate">
                                    <label for="txt_info_contacto">Descripcion Contacto</label>
                                </div>
                                <div class="input-field col s12">
                                    <label class="active">Tipo Contacto</label>
                                    <select name="combo_info_contacto" id="combo_info_contacto" class="browser-default">
                                    </select>
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
        </div>
<script src="src/js/es6/funciones-infoContacto.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.4/dist/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.4/dist/sweetalert2.min.css"></script>
<script>
    $(document).ready(function () {
        $('modal-actualiza-cliente').modal({
            dismissible: true,
            onCloseEnd: function () {
                $('#lbl_id_clientes').text('');
            }
        });
    });
    cargaComboTipoContacto();
    cargaComboTipoContacto2(); 
</script>
</body>
</html>