<?php

require_once "../clases/empleado.php"; //*Clase empleado
require_once "../clases/inputValidate.php"; //*Clase Input para validación de campos

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') { //*Se valida que el método de solicitud sea 'POST'
    $validate = new Input();
    //*Se instancia la clase para la validación de campos

    $empleado = new Empleado();

        switch($_REQUEST['action']){//*Comprueba que campos no estén vacíos
            case 'LoginEmpleado':
            // echo '<script>alert("ascasc")</script>';
                if($validate->check(['txt_email', 'txt_password'], $_REQUEST)){
                    $correo=$validate->email($_POST['txt_email']);
                    //*El método email solo valida que el formato del campo sea email

                    $password= $validate->pass($_POST['txt_password'], '100', '1');
                    //*Recibe la acción a ejecutar

                    //*Setea parámetros en la clase empleado
                    $empleado->setCorreo($correo);
                    $empleado->setPassword($password);

                    switch($empleado->login()){
                        case '1':
                            echo '1'; 
                            //* Registro exitoso
                            if(!isset($_SESSION['user']) || $_SESSION['user'] == ''){
                                $_SESSION['user'] = 'admin';
                            }
                        break;
                        case '2':
                            echo '2'; 
                            if(!isset($_SESSION['user']) || $_SESSION['user'] == ''){
                                $_SESSION['user'] = 'repartidor';
                            }
                        break;
                        case 'error':
                            echo 'error';
                        break;
                    }
                }
            break;
    //*-------------------------------------------------------------------
    // funcion para el registro del mantenedor empleado
            case 'RegistroEmpleado':
            //!Falta validar campos que podrán quedar vacíos
                if($validate->check(['txt_nombre', 'txt_apellidos', 'txt_email', 'txt_password','combo_TipoEmpleado'], $_REQUEST)){
                    
                    $nombre = $validate->str($_POST['txt_nombre'], '45', '3');
                    //*Llama al método str, y pasa parámetros (*campo, *maxLength, *minLength)

                    $apellidos=$validate->str($_POST['txt_apellidos'], '45', '3');


                    $correo=$validate->email($_POST['txt_email']);
                    //*El método email solo valida que el formato del campo sea email

                    $password= $validate->pass($_POST['txt_password'], '100', '10');
                    // $combo_TipoEmpleado = $validate->int($_POST['combo_TipoEmpleado']);
                    //*Recibe la acción a ejecutar

                    //*Setea parámetros en la clase Cliente
                    $empleado->setIdTipoEmpleado($_POST['combo_TipoEmpleado']);
                    $empleado->setPassword($password);
                    $empleado->setCorreo($correo);
                    $empleado->setNombre($nombre);
                    $empleado->setApellidos($apellidos);

                    switch($empleado->IngresaEmpleado()){
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
        // ----------------------------------------------------------------
        // Funcion para cargar las tablas con los datos de los empleados
        case 'CargarTablaEmpleados':
                echo $empleado->cargarTablaEmpleados();
            break;
        // la funcion nos permite eliminar un registro de la tabla
        case 'EliminarEmpleado':
                echo $empleado->eliminaEmpleado($_REQUEST['id']);
            break;
        // Carga los datos del empleado al modal, para luego actualizar
        case 'cargaModalEmpleado':
                $empleado->setIdEmpleado($_POST['id']);
           echo $empleado->cargaCliente($_REQUEST['id']);
           break;
        // funcion para actualizar los empleado a través del modal
        case 'ActualizaEmpleados':
            $id = $_POST['id'];
            $empleado->setIdEmpleado($id);
            $empleado->setNombre($_POST['nombre']);
            $empleado->setApellidos($_POST['apellidos']);
            $empleado->setCorreo($_POST['email']);
            $empleado->setIdEstado($_POST['idEstado']);
            $empleado->setIdTipoEmpleado($_POST['idTipoEmp']);
            echo $empleado->ActualizaEmpleado();
            break;
    }
}