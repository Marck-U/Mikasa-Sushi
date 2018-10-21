<?php

require_once '../clases/tipoEmpleado.php';
require_once '../clases/inputValidate.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $validate = new Input();
    //*Se instancia la clase para la validación de campos

    $tipoEmpleado = new tipoEmpleado();

    switch($_REQUEST['action']){
        case 'CargaTipoEmpleado';
            echo $tipoEmpleado->comboboxTipoEmpleado();
        break;
     
    }
}