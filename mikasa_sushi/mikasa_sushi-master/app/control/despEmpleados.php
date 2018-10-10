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
        }
}