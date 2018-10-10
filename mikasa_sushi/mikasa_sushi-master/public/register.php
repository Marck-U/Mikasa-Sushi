<!DOCTYPE html>
<html lang="es">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mikasa Sushi</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="dist/img/m-logo.ico" />
    <link rel="stylesheet" type="text/css" media="screen" href="dist/css/style.min.css">
</head>

<body>
    <div class="full-page row">
        <!-- Navbar index -->
        <div class="navbar navbar-login">
        <nav class="transparent z-depth-0">
            <div class="nav-wrapper">
                <div>
                    <a href="#" class="brand-logo">
                        <img src="src/img/logo.png" class="nav-image-no-circle">
                    </a>
                </div>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger black-text black-darken-4">
                    <i class="material-icons">menu</i>
                </a>
                <ul class="right hide-on-med-and-down nav-ul-options">
                    <li class="">
                        <a href="index.php" class="white-text normal-hover-nav">Inicio</a>
                    </li>
                    <li>
                        <a href="login.php" class="white-text normal-hover-nav">Iniciar Sesión</a>
                    </li>
                    <li>
                        <a href="register.php" class="white-text normal-hover-nav">Registro</a>
                    </li>
                    <li>
                        <a href="carta.php" class="white-text normal-hover-nav">Carta</a>
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
                <a href="index.php" class="black-text">Inicio</a>
            </li>
            <li>
                <a class="black-text" href="login.php">Iniciar Sesión</a>
            </li>
            <li>
                <a href="register.php" class="black-text">Registro</a>
            </li>
            <li>
                <a href="carta.php" class="black-text">Carta</a>
            </li>
            <li>
                <a href="about.php" class="black-text">Saber más</a>
            </li>
        </ul>
    </div>
        <!-- Login form content -->
        <div id="contentWrapper" class="left col s12 l5 white">
            <div class="content-form">
                <form action="" id="form_registro">
                    <h5 class="">Regístrate</h5>
                    <div class="input-div">
                        <div class="input-field">
                            <input id="txt_nombre" name="txt_nombre" type="text">
                            <label for="txt_nombre">Nombre</label>
                        </div>
                        <div class="input-field">
                            <input id="txt_apellidos" name="txt_apellidos" type="text">
                            <label for="txt_apellidos">Apellido(s)</label>
                        </div>
                        <div class="input-field">
                            <input id="txt_email" name="txt_email" type="email">
                            <label for="txt_email">Email</label>
                        </div>
                        <div class="input-field">
                            <input id="txt_password" name="txt_password" type="password">
                            <label for="txt_password">Contraseña</label>
                        </div>
                        <div class="right">
                            <a href="#">Ver términos y condiciones.</a>
                        </div>
                        <div class="botones-registro">
                            <div class="btn-div">
                                <input type="submit" class="btn black btn-registro" value="Registrar cuenta">
                            </div>
                            <div class="linea">
                                <hr class="hr2 black">
                                <div class="header-line">ó</div>
                                <hr class="hr1 black">
                            </div>
                            <div class="btn-div">
                                <button class="btn blue btn-registro">
                                    <i class="fa fa-facebook"></i>
                                    Continuar con Facebook
                                </button>
                            </div>
                        </div>
                        <div class="center-align">
                            <p>¿Ya tienes cuenta? Haz clic
                                <a href="login.php" class="modal-trigger">Aquí</a>
                            </p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Contenido derecha -->
        <div id="contentWrapper" class="right col l7 hide-on-med-and-down div-info">
            <div class="right-background">
                <div class="content-info">
                    <p class="content-tittle">Mikasa</p>
                    <div class="content-text white-text">
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eius porro pariatur, accusantium molestias
                            mollitia saepe reprehenderit dolor quia ad quos. A, soluta dolores velit neque obcaecati exercitationem
                            quia quo molestias.</p>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quidem, nemo facilis? Ab dolore culpa non
                            minima minus quia recusandae impedit odit deleniti aut iure error, temporibus, laboriosam amet
                            ducimus officia.</p>
                    </div>
                    <div class="right">
                        <a class="btn red" href="about.php">Saber más.</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- ----------------------------------------------------------- -->
        <script src="dist/js/script.min.js"></script>
</body>

</html>