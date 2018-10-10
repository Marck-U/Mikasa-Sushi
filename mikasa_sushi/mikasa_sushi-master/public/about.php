<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inicio de sesión</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="screen" href="dist/css/style.min.css">
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="dist/img/m-logo.ico" />
</head>

<body>
    <!-- Navbar index -->
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
    <div class="row content-about">
        <div class="col s12 m12 l12">
            <ul class="tabs">
                <li class="tab col s4">
                    <a href="#test1">¿Quiénes somos?</a>
                </li>
                <li class="tab col s4">
                    <a class="active" href="#test2">Preguntas frecuentes</a>
                </li>
                <li class="tab col s4">
                    <a href="#test3">Contacto</a>
                </li>
            </ul>
        </div>
        <div id="test1" class="col s12">
            <div class="quienes-somos">
                <div class="col s12 m4 l4">
                    <img src="dist/img/mikasa-logo.jpg" alt="" class="responsive-img">
                </div>
                <div class="col s12 m8 l8 right">
                    <p class="tittle-about">Somos Mikasa Sushi</p>
                    <p class="content-quienes-somos">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae error tenetur eos tempore ea autem repellendus
                        laudantium nostrum esse at eius voluptatibus, molestiae assumenda distinctio dolorem cumque facilis
                        deleniti officiis? Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat, quae. Dolorum
                        doloremque saepe dignissimos libero nobis nulla deleniti esse, provident officiis vel iusto consequuntur
                        corporis dolore nemo placeat ipsum eaque. Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Provident exercitationem sapiente optio magnam odit molestiae soluta dolor magni, esse, similique
                        reprehenderit cumque eius alias nesciunt consequatur enim voluptate autem reiciendis! Lorem ipsum
                        dolor sit amet consectetur adipisicing elit. Cum vel voluptatem amet id numquam, totam corrupti earum?
                        At suscipit unde, earum architecto nulla possimus magnam quia nostrum, voluptas quibusdam corporis.
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde saepe accusamus, ad corporis magnam
                        debitis error temporibus nobis quod recusandae ut beatae dolore? Tenetur illum aliquam molestias
                        inventore officia ducimus!
                    </p>
                </div>
            </div>
        </div>
        <div id="test2">
            <div class="preguntas-frecuentes">
                <div class="col s12">
                    <div>
                        <p class="tittle-about">Preguntas frecuentes</p>
                    </div>
                    <ul class="collapsible">
                        <li>
                            <div class="collapsible-header">
                                ¿Dónde nos encontramos?
                            </div>
                            <div class="collapsible-body">
                                <span>Lorem ipsum dolor sit amet.</span>
                            </div>
                        </li>
                        <li>
                            <div class="collapsible-header">
                                ¿Cómo puedo realizar mi pago?
                            </div>
                            <div class="collapsible-body">
                                <span>Lorem ipsum dolor sit amet.</span>
                            </div>
                        </li>
                        <li>
                            <div class="collapsible-header">
                                ¿Cuánto demora mi envío?
                            </div>
                            <div class="collapsible-body">
                                <span>Lorem ipsum dolor sit amet.</span>
                            </div>
                        </li>
                        <li>
                            <div class="collapsible-header">
                                ¿El envío es gratis?
                            </div>
                            <div class="collapsible-body">
                                <span>Lorem ipsum dolor sit amet.</span>
                            </div>
                        </li>
                        <li>
                            <div class="collapsible-header">
                                ¿Puedo ordenar bebidas?
                            </div>
                            <div class="collapsible-body">
                                <span>Lorem ipsum dolor sit amet.</span>
                            </div>
                        </li>
                        <li>
                            <div class="collapsible-header">
                                ¿Debo estar registrado para realizar una compra?
                            </div>
                            <div class="collapsible-body">
                                <span>Lorem ipsum dolor sit amet.</span>
                            </div>
                        </li>
                        <li>
                            <div class="collapsible-header">
                                ¿Cuánto demora mi envío?
                            </div>
                            <div class="collapsible-body">
                                <span>Lorem ipsum dolor sit amet.</span>
                            </div>
                        </li>
                        <li>
                            <div class="collapsible-header">
                                ¿Desde qué ciudades puedo comprar?
                            </div>
                            <div class="collapsible-body">
                                <span>Lorem ipsum dolor sit amet.</span>
                            </div>
                        </li>
                        <li>
                            <div class="collapsible-header">
                                ¿Cómo puedo realizar un pedido?
                            </div>
                            <div class="collapsible-body">
                                <span>Lorem ipsum dolor sit amet.</span>
                            </div>
                        </li>
                        <li>
                            <div class="collapsible-header">
                                ¿Existe un límite de compras?
                            </div>
                            <div class="collapsible-body">
                                <span>Lorem ipsum dolor sit amet.</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="test3" class="col s12">
            <div class="quienes-somos">
                <div class="col s12 m4 l4">
                    <img src="src/img/mikasa-logo.jpg" alt="" class="responsive-img">
                </div>
                <div class="col s12 m8 l8 right">
                    <p class="tittle-quienes-somos center-align">Somos Mikasa Sushi</p>
                    <p class="content-quienes-somos">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae error tenetur eos tempore ea autem repellendus
                        laudantium nostrum esse at eius voluptatibus, molestiae assumenda distinctio dolorem cumque facilis
                        deleniti officiis? Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat, quae. Dolorum
                        doloremque saepe dignissimos libero nobis nulla deleniti esse, provident officiis vel iusto consequuntur
                        corporis dolore nemo placeat ipsum eaque. Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Provident exercitationem sapiente optio magnam odit molestiae soluta dolor magni, esse, similique
                        reprehenderit cumque eius alias nesciunt consequatur enim voluptate autem reiciendis! Lorem ipsum
                        dolor sit amet consectetur adipisicing elit. Cum vel voluptatem amet id numquam, totam corrupti earum?
                        At suscipit unde, earum architecto nulla possimus magnam quia nostrum, voluptas quibusdam corporis.
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde saepe accusamus, ad corporis magnam
                        debitis error temporibus nobis quod recusandae ut beatae dolore? Tenetur illum aliquam molestias
                        inventore officia ducimus!
                    </p>
                </div>
            </div>
        </div>
    </div>
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

<script src="dist/js/script.min.js"></script>

</html>