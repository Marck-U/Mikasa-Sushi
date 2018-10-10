

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mikasa Sushi</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="dist/img/m-logo.ico" />
    <link rel="stylesheet" href="dist/css/style.min.css">
</head>

<body>
    <!-- Navbar index -->
    <div class="navbar-fixed">
        <nav class="white">
            <div class="nav">
                <!-- //!Comprobar animaciones -->
                <div class="logo-nav-img brand-logo">
                    <a href="#">
                        <img src="dist/img/logo.png" class="nav-image align-center">
                    </a>
                </div>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger black-text black-darken-4">
                    <i class="material-icons">menu</i>
                </a>
                <ul class="right hide-on-med-and-down nav-ul-options">
                    <li class="">
                        <a href="index.php" class="black-text bottom-hover-nav">Inicio</a>
                    </li>
                    <li>
                        <a class="black-text bottom-hover-nav" href="login.php">Iniciar Sesión</a>
                    </li>
                    <li>
                        <a href="register.php" class="black-text bottom-hover-nav">Registro</a>
                    </li>
                    <li>
                        <a href="carta.php" class="black-text bottom-hover-nav">Carta</a>
                    </li>
                    <li>
                        <a href="about.php" class="black-text bottom-hover-nav">Saber más</a>
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
    <!--  -->
    <div class="slider">
        <div class="left-arrow-slider">
            <i class="fa fa-angle-left fa-4x"></i>
        </div>
        <div class="rigth-arrow-slider">
            <i class="fa fa-angle-right fa-4x"></i>
        </div>
        <ul class="slides">
            <li>
                <img src="dist/img/deadpool-1.jpg" class="img-slider">
                <!-- random image -->
                <div class="caption center-align">
                    <h2>This is our big Tagline!</h2>
                    <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
                </div>
            </li>
            <li>
                <img src="dist/img/darth-vader-1.jpg">
                <!-- random image -->
                <div class="caption left-align">
                    <h3>Left Aligned Caption</h3>
                    <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
                </div>
            </li>
            <li>
                <img src="dist/img/BVS-1.jpg">
                <!-- random image -->
                <div class="caption right-align">
                    <h3>Right Aligned Caption</h3>
                    <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
                </div>
            </li>
        </ul>
    </div>
    <!-- ----------------------------------------------------------------------- -->
    <!-- Información -->
    <div class="section">
        <div class="row">
            <div class="col s12 m6 l3 wow slideInLeft">
                <div class="icon-block">
                    <h2 class="center-align red-text">
                        <i class="medium material-icons">restaurant</i>
                    </h2>
                    <h5 class="center-align">Comida</h5>
                    <p class="light servicios-p-text">
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quod est, repellendus tempora aliquid magni esse necessitatibus
                        adipisci illo quos ipsum nam nulla quia odio, magnam illum beatae expedita sint ullam!
                    </p>
                </div>
            </div>
            <div class="col s12 m6 l3 wow slideInLeft">
                <div class="icon-block">
                    <h2 class="center-align red-text">
                        <i class="medium material-icons">attach_money</i>
                    </h2>
                    <h5 class="center-align">Los mejores precios</h5>
                    <p class="light servicios-p-text">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci tempora corporis, sint possimus, assumenda iusto praesentium
                        ipsam, provident nisi deleniti nesciunt atque sequi! Culpa doloremque officia illo, voluptate deserunt
                        ea?
                    </p>
                </div>
            </div>
            <div class="col s12 m6 l3 wow slideInLeft">
                <div class="icon-block">
                    <h2 class="center-align red-text">
                        <i class="medium material-icons">access_time</i>
                    </h2>
                    <h5 class="center-align">Tiempo de respuesta</h5>
                    <p class="light servicios-p-text">
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ipsa sequi culpa repellat officiis aut dolorem nesciunt deleniti
                        sapiente tenetur, facilis quis quos dolorum id est eos. Minus impedit expedita architecto.
                    </p>
                </div>
            </div>
            <div class="col s12 m6 l3 wow slideInLeft">
                <div class="icon-block">
                    <h2 class="center-align red-text">
                        <i class="medium material-icons">motorcycle</i>
                    </h2>
                    <h5 class="center-align">Delivery</h5>
                    <p class="light servicios-p-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quis tempora
                        quae culpa, impedit voluptas reprehenderit earum quaerat tenetur magni, repudiandae id officia deleniti
                        cum nostrum minus architecto corrupti, quibusdam saepe?
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!--  -->
    <div id="index-banner-two" class="parallax-container center valign-wrapper">
        <div class="container">
            <div class="row">
                <div class="parallax-text col s12 white-text">
                    <h4 class="lighten-2">Registrate y hazte parte de Mikasa</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto ducimus minus quo, harum quas perspiciatis
                        repellendus, necessitatibus dolorum id placeat magni? Natus deserunt sunt porro dolor officiis, eum
                        unde ipsum!</p>
                </div>
                <div>
                    <a class="btn black accent-4 btn-large waves-effect waves pulse" href="register.php">Registrarse</a>
                </div>
            </div>
        </div>
        <div class="parallax">
            <img src="dist/img/fondo3.jpg">
        </div>
    </div>
    <!-- -------------------------------------------------------- -->
    <div class="linea">
        <hr class="hr2 red">
        <div class="header-carta-content">Promos</div>
        <hr class="hr1 red">
    </div>
    <!-- Carta -->
    <div id="carta" class="section-menu scrollspy">
        <div class="row carta-index wow slideInLeft">
            <!-- <div class="col s12 m12 l5"> -->
            <div class="card">
                <div class="descuento">
                    <p class="center-align">-50%</p>
                </div>
                <div class="card-image">
                    <img class="activator" height="280px" src="dist/img/fondo3.jpg">
                </div>
                <div class="card-content">
                    <span class="card-title activator grey-text text-darken-4 ">Promo 1
                        <i class="material-icons right">more_vert</i>
                    </span>
                    <div class="card-action center-align">
                        <a href="#">Añadir al carro</a>
                        <a href="#">Compartir</a>
                    </div>
                </div>
                <div class="card-reveal">
                    <span class="card-title grey-text text-darken-4">Promo 1
                        <i class="material-icons right">close</i>
                    </span>
                    <p>Here is some more information about this product that is only revealed once clicked on.</p>
                </div>
            </div>
            <!-- </div> -->
            <!-- <div class="col s12 m12 l5"> -->
            <div class="card">
                <div class="card-image">
                    <img class="activator" src="dist/img/fondo3.jpg">
                </div>
                <div class="card-content">
                    <span class="card-title activator grey-text text-darken-4">Promo 2
                        <i class="material-icons right">more_vert</i>
                    </span>
                    <div class="card-action center-align">
                        <a href="#">Añadir al carro</a>
                        <a href="#">Compartir</a>
                    </div>
                </div>
                <div class="card-reveal">
                    <span class="card-title grey-text text-darken-4">Promo 2
                        <i class="material-icons right">close</i>
                    </span>
                    <p>Here is some more information about this product that is only revealed once clicked on. Lorem ipsum
                        dolor sit amet consectetur adipisicing elit.
                    </p>
                </div>
            </div>
            <!-- </div> -->
            <!-- <div class="col s12 m12 l5"> -->
            <div class="card">
                <div class="descuento">
                    <p class="center-align">-50%</p>
                </div>
                <div class="card-image">
                    <img class="activator" height="280px" src="dist/img/fondo3.jpg">
                </div>
                <div class="card-content">
                    <span class="card-title activator grey-text text-darken-4">Promo 3
                        <i class="material-icons right">more_vert</i>
                    </span>
                    <div class="card-action center-align">
                        <a href="#">Añadir al carro</a>
                        <a href="#">Compartir</a>
                    </div>
                </div>
                <div class="card-reveal">
                    <span class="card-title grey-text text-darken-4">Promo 3
                        <i class="material-icons right">close</i>
                    </span>
                    <p>Here is some more information about this product that is only revealed once clicked on.</p>
                </div>
            </div>
            <!-- </div> -->
        </div>
    </div>
    <div class="center-align btn-section-menu">
        <a class="btn blue accent-4 btn-large waves-effect waves pulse">Ver más</a>
    </div>
    <div class="linea">
        <hr class="hr2 red">
        <div class="header-carta-content">Contáctanos</div>
        <hr class="hr1 red">
    </div>
    <!-- Contacto/map-->
    <div id="contacto" class="contacto center-align">
        <div class="row">
            <div class="col s12 m12 card-panel">
                <h4>Contáctate con nosotros</h4>
                <p>Horario de atención: Lunes a Domingo 11:00 - 23:00</p>
                <div class="col m4">
                    <img src="dist/img/phone.png" alt="" class="responsive-img hide-on-small-only">
                </div>
                <div class="col m4 s12">
                    <div class="contact-rectangulo card-panel green white-text">
                        <h5>
                            <i class="fa fa-whatsapp"></i>
                            Whatsapp
                        </h5>
                        <p>+569 45652531</p>
                    </div>
                    <div class="contact-rectangulo card-panel blue white-text">
                        <h5>
                            <i class="fa fa-facebook"></i>
                            Facebook
                        </h5>
                        <p>
                            Síguenos en
                            <a href="http://www.facebook.com" class="white-text">Facebook/Mikasa-Sushi</a>
                        </p>
                    </div>
                    <div class="contact-rectangulo card-panel red white-text">
                        <h5>
                            <i class="fa fa-phone"></i>
                            Teléfono
                        </h5>
                        <p>
                            +569 52463258
                        </p>
                    </div>
                </div>
                <div class="col m4 s12">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1882.869529105411!2d-72.35467414346569!3d-37.4702484360825!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x966bdd483f9ed729%3A0xc454d56705ec587a!2zTGF1dGFybyA1ODIsIExvcyBBbmdlbGVzLCBMb3Mgw4FuZ2VsZXMsIFJlZ2nDs24gZGVsIELDrW8gQsOtbw!5e0!3m2!1ses!2scl!4v1529483339185"
                        width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
                    <p>Nos encontramos en Lautaro #583
                    </p>
                </div>
            </div>
            <div class="col s12 m4">

            </div>
        </div>
    </div>
    </div>
    <!-- Footer -->
    <footer class="page-footer red accent-4">
        <div class="red accent-4">
            <div class="row red accent-4">
                <div class="col l6 offset-l1 s12">
                    <h5 class="white-text">Conoce más</h5>
                    <ul>
                        <li>
                            <a class="grey-text text-lighten-3" href="#!">Sobre nosotros</a>
                        </li>
                        <li>
                            <a class="grey-text text-lighten-3" href="#!">Téminos y condiciones de uso</a>
                        </li>
                        <li>
                            <a class="grey-text text-lighten-3" href="#!">Preguntas frecuentes</a>
                        </li>
                    </ul>
                </div>
                <div class="col l4 s12">
                    <h5 class="white-text">Medios de pago</h5>
                    <p class="grey-text text-lighten-4">You can use rows and columns here to organize your footer content.</p>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="container">
                © 2018 Copyright
            </div>
        </div>
    </footer>
</body>


<!-- <script src="../node_modules/jquery/dist/jquery.min.js"></script>
<script src="../node_modules/materialize-css/dist/js/materialize.min.js"></script>
<script src="../node_modules/wowjs/dist/wow.min.js"></script>
<script src="../node_modules/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="src/js/es5/script.js"></script> -->
<script src="dist/js/script.min.js"></script>
<script>
    new WOW().init();
</script>

</html>