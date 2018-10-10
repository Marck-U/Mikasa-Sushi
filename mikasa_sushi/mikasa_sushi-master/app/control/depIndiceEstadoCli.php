<?php

require_once '../clases/IndiceEstadoCliente.php';
require_once '../clases/inputValidate.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $validate = new Input();
    //*Se instancia la clase para la validación de campos

    $indiceEstadoCliente = new indiceEstadoCliente();

    switch($_REQUEST['action']){
        case 'CargaEstadoCliente';
            echo $indiceEstadoCliente->cargaEstadoCliente();
        break;
    }
}