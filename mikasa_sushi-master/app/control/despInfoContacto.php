<?php

require_once "../clases/infoContacto.php"; //*Clase info Contacto
require_once "../clases/empleado.php"; //*Clase  empleado
require_once "../clases/inputValidate.php"; //*Clase Input para validación de campos

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') { //*Se valida que el método de solicitud sea 'POST'

    $validate = new Input();
    //*Se instancia la clase para la validación de campos
    $infoContacto = new infoContacto();

        switch($_REQUEST['action']){//*Comprueba que los campos no estén vacíos
            case 'RegistroinfoContacto':
            //!Falta validar campos que podrán quedar vacíos
                if($validate->check(['txt_info_contacto'], $_REQUEST)){
                    
                    $descripcionCont = $validate->str($_POST['txt_info_contacto'], '45', '3');
                    //*Llama al método str, y pasa parámetros (*campo, *maxLength, *minLength)
                    //*Recibe la acción a ejecutar
                    //*Setea parámetros en la clase Cliente
                    $infoContacto->setDescripcionContacto($descripcionCont);
                    $infoContacto->setIdTipoContacto($_POST['combo_info_contacto']);

                    switch($infoContacto->IngresaInfoContacto()){
                        //*Ejecución y respuesta del método registro de clase Cliente
                        case '1':
                            echo '1';
                            //*El correo ya está registrado
                        break;
                        case '2':
                            echo '2';
                            //*Registro exitoso
                            $array_session = array('empleado', $empleado->getCorreo());
                            if(!isset($_SESSION['user']) || $_SESSION['user'] == ''){
                                $_SESSION['user'] = $array_session;
                            }
                        break;
                        //!Añadir acceso denegado por baneo
                    }
                }else{
                    echo 'Error';
                }
            break;

            // --------------------------------------------------------------------------
            case 'CargarTablaInfoContacto':
                echo $infoContacto->cargaTablaInfoContacto();
            break;
            // *--------------------------------------------------
            // s
            case 'eliminarInfoContacto':
            echo $infoContacto->eliminarInfoContacto($_REQUEST['id']);
           break; 
           // *----------------------------------------------------
           case 'CargaModalInfoC':
           $infoContacto->getIdContacto($_POST['id']);
           echo $infoContacto->cargaModalInfoContacto($_REQUEST['id']);
           break;
           // *----------------------------------------------------
           case 'ActualizaInfoContacto':
           $id = $_POST['idContacto'];
           $infoContacto->setIdContacto($id);
           $infoContacto->setDescripcionContacto($_POST['descripcionC']);
           $infoContacto->setIdTipoContacto($_POST['TipoContacto']);
           echo $infoContacto->ActualizaInfoContacto();
           break;
}}