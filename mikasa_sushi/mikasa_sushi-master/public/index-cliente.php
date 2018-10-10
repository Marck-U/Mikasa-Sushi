<?php
//* Validamos la existencia de la sesión y el tipo de usuario que solicita el acceso
    session_start();
    if(!isset($_SESSION['user']) || $_SESSION['user'] == '' || $_SESSION['user'][0] != 'cliente'){
        header('Location: login.php');
        // echo '<script>console.log("'. $_SESSION['user'][1].'")</script>';
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
</head>

<body>
    <ul id="dropdown1" class="dropdown-content">
        <li><a href="#!" class="black-text"><i class="material-icons left">account_circle</i>David Maldonado</a></li>
        <li class="divider"></li>
        <li><a href="perfil-cliente.php" class="black-text"><i class="material-icons left">edit</i>Editar Perfil</a></li>
        <li class="divider"></li>
        <li><a href="#!" class="black-text"><i class="material-icons">power_settings_new</i>Cerrar sesión</a></li>
    </ul>
    <div class="navbar-fixed">
        <nav class="white">
            <div class="nav-wrapper">
                <div>
                    <a href="" class="brand-logo">
                        <img src="dist/img/logo.png" alt="" class="nav-image-no-circle">
                    </a>
                </div>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger black-text black-darken-4">
                    <i class="material-icons">menu</i>
                </a>
                <ul class="right hide-on-med-and-down nav-ul-options">
                    <li>
                        <a href="index-cliente.php" class="black-text bottom-hover-nav">Inicio</a>
                    </li>
                    <li>
                        <a class="black-text bottom-hover-nav" href="promos.php">Promos</a>
                    </li>
                    <li>
                        <a href="agregados.php" class="black-text bottom-hover-nav">Agregados</a>
                    </li>
                    <li>
                        <a href="mis-compras.php" class="black-text bottom-hover-nav">Mis Compras</a>
                    </li>
                    <li>
                        <a href="#" class="black-text bottom-hover-nav dropdown-trigger" data-target="dropdown1">Cuenta<i class="material-icons right">keyboard_arrow_down</i></a>
                    </li>
                    <li>
                        <a href="carrito.php" class="black-text bottom-hover-nav"><i class="material-icons">shopping_cart</i></a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <!-- Sidenav para dispositivos móviles -->
    <div>
        <ul class="sidenav" id="mobile-demo">
            <li>
                <div class="user-view background-sidenav">
                    <img src="dist/img/m-logo.png" height="200px" width="100%">
                </div>
            </li>
            <li class="">
                <a href="index-cliente.php" class="black-text">Inicio</a>
            </li>
            <li>
                <a class="black-text" href="promos.php">Promos</a>
            </li>
            <li>
                <a href="agregados.php" class="black-text">Agregados</a>
            </li>
            <li>
                <a href="mis-compras.php" class="black-text">Mis Compras</a>
            </li>
        </ul>
    </div>

    <script src="dist/js/script.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.dropdown-trigger').dropdown();
            // *Activa tabs
        });
    </script>
</body>

</html>