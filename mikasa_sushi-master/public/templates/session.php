<?php

session_start();

//* Comprueba si existe una sesión iniciada y redirecciona al menú principal correspondiente

if(isset($_SESSION['user'])){
    switch ($_SESSION['user']) {
        case 'cliente':
                header('Location: index-cliente.php');
            break;
        case 'admin':
                header('Location: index-admin.php');
            break;
        case 'repartidor':
                header('Location: index-repartidor.php');
            break;
    }
}else{
    header('Location: login.php');
}