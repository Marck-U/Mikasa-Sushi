<?php

require_once "../clases/tipoContacto.php"; //*Clase tipoContacto
require_once "../clases/inputValidate.php"; //*Clase Input para validación de campos

session_start();
$validate = new Input();
    
$tipoContacto = new tipoContacto();
if ($_SERVER['REQUEST_METHOD'] === 'POST') { //*Se valida que el método de solicitud sea 'POST'
 // se instancia la clase tipoContacto

    //!Falta validar campos que podrán quedar vacíos
    switch($_REQUEST['action']){//*Comprueba que los campos no estén vacíos
        case 'Registro_tipo_contacto':
            if($validate->check(['txt_descripcionCon'], $_REQUEST)){
                $descripcionCon = $validate->str($_POST['txt_descripcionCon'], '45', '3');
                //*Llama al método str, y pasa parámetros (*campo, *maxLength, *minLength)
                //*Setea parámetros en la clase tipo contacto
                $tipoContacto->setDescripcionTipoC($descripcionCon);

                switch($tipoContacto->RegistroTipoC()){
                    //*Ejecución y respuesta del método registro de clase tipo contacto
                    case '1':
                        echo '1';
                        //*El correo ya está registrado
                    break;
                    case '2':
                        echo '2';
                        //*Registro exitoso
                        // $array_session = array('cliente', $cliente->getCorreo());
                        // if(!isset($_SESSION['user']) || $_SESSION['user'] == ''){
                        //     $_SESSION['user'] = $array_session;
                        break;
                    }
                    break;
                }
            case 'CargarTablaTipoC':
                echo $tipoContacto->cargarTablaTipoC();
                break;
            case 'EliminarTipoContacto':
                echo $tipoContacto->eliminarTipoContacto($_REQUEST['id']);
                break;
            case 'CargatipoC':
                $tipoContacto->setIdTipoContacto($_POST['id']);
                echo $tipoContacto->cargaTipoC($_REQUEST['id']);
                break;
            case 'actualizaTipoContacto':
                $id = $_POST['idContacto'];
                $tipoContacto->setIdTipoContacto($id);
                $tipoContacto->setDescripcionTipoC($_POST['descripcionTipoC']);
                echo $tipoContacto->ActualizarTipoC();
                break;
            case 'cargaComboTipoContacto';
            // echo "<script>alert($result);</script>";
                echo $tipoContacto->cargaComboTipoContacto();
            break;
            }
        }    

