<?php
//* Validamos la existencia de la sesión y el tipo de usuario que solicita el acceso
    session_start();
    if(!isset($_SESSION['user']) || $_SESSION['user'] == '' || $_SESSION['user'][0] != 'cliente'){
        header('Location: login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mikasa Clientes</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="dist/img/m-logo.ico" />
    <link rel="stylesheet" href="dist/css/style.min.css">
    <link rel="stylesheet" href="src/css/perfil.css">
</head>

<body>
    <?php require_once 'templates/nav-cliente.php';?>
    <div class="info-perfil">
        <div class="info-perfil-content">
            <h5 class="center-align">Editar perfil</h5>
            <form action="" name="form-editar-perfil-cliente" id="form-editar-perfil-cliente">
                <table class="profile-data-table">
                    <tr>
                        <td>
                            <label for="txt_nombre" class="lbl_inputs_perfil">Nombre: </label>
                        </td>
                        <td>
                            <input type="text" id="txt_nombre" name="txt_nombre">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="txt_apellidos" class="lbl_inputs_perfil">Apellidos: </label>
                        </td>
                        <td>
                            <input type="text" id="txt_apellidos" name="txt_apellidos">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="txt_correo" class="lbl_inputs_perfil">Correo: </label>
                        </td>
                        <td>
                            <input type="text" id="txt_correo" name="txt_correo" disabled>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="" class="lbl_inputs_perfil">Contraseña: </label>
                        </td>
                        <td>
                            <a class="modal-trigger" href="#modal-password">Cambiar Password</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="txt_telefono" class="lbl_inputs_perfil">Teléfono: </label>
                        </td>
                        <td>
                            <div class="input-field-telefono">
                            <label for="txt_telefono" class='telefono-lbl-input lbl_inputs_perfil'>+56 9</label>
                            <input type="text" id="txt_telefono" name="txt_telefono">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="center">
                            <input type="submit" class="btn black" value="Confirmar">
                        </td>
                    </tr>
                </table>
            </form>
            <div id="modal-password" class="modal">
                <div class="modal-content">
                    <h5 class="center">Cambiar contraseña</h5>
                    <form action="" name="form-pass-cliente" id="form-pass-cliente">
                        <div class="input-field">
                            <input id="txt_pass_actual" name="txt_pass_actual" type="password">
                            <label for="txt_pass_actual">Contraseña actual</label>
                        </div>
                        <div class="input-field">
                            <input id="txt_pass_nueva" name="txt_pass_nueva" type="password">
                            <label for="txt_pass_nueva">Nueva contraseña</label>
                        </div>
                        <div class="input-field">
                            <input id="txt_pass_confirmar" name="txt_pass_confirmar" type="password">
                            <label for="txt_pass_confirmar">Confirmar contraseña</label>
                        </div>
                        <input type="submit" class="btn black" value="Confirmar">
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
                </div>
            </div>
        </div>
    </div>

    <script src="dist/js/script.min.js"></script>
    <script src="src/js/es6/funciones-cliente.js"></script>
    <script>
        $(document).ready(function() {
            $('.dropdown-trigger').dropdown();
            // *Activa tabs
        });
    </script>
</body>

</html>