<?php
$seeker = 1;
$finder = 0;
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="EUREKA - Plataforma para la recuperación de elementos perdidos y encontrados." />
        <meta name="author" content="Jack Antony Hernandez Gonzalez" />
        <title>EUREKA</title>
        <link rel="icon" type="image/x-icon" href="img/icon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link rel="stylesheet" href="css/styles.css">    
        <style>
        #scrollBtn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 50px;
            height: 50px;
            background-color: #333;
            color: #fff;
            border-radius: 50%;
            text-align: center;
            line-height: 50px;
            cursor: pointer;
            display: none;
        }
    </style>
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#page-top">EUREKA!</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        
                        <li class="nav-item"><a class="nav-link" href="<?php echo "src/login.php?seekfind=" . $seeker?>" onclick="window.open(this.href, '_self'); return false;">Elemento extraviado</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo "src/login.php?seekfind=" . $finder?>" onclick="window.open(this.href, '_self'); return false;">Elemento encontrado</a></li>
                        <li class="nav-item"><a class="nav-link" href="#footer">Acerca de</a></li>
                        <a class="nav-link" href="src/login.php">Ingresar</a>
                    </ul>
                </div>
                
            </div>
        </nav>
        <!-- head-->
        <header class="masthead">
            <div class="container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center">
                <div class="d-flex justify-content-center">
                    <div class="text-center">
                        <h1 class="mx-auto my-0 text-uppercase">EUREKA</h1>
                        <h2 class="text-white-50 mx-auto mt-2 mb-5">You lose it, we find it for you.!</h2>
                        <a class="btn btn-primary" href="#about">Conócenos</a>
                    </div>
                </div>
            </div>
        </header>
        <!-- About-->
        <section class="about-section text-center" id="about">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8">
                        <h2 class="text-white mb-4">Bienvenido a EUREKA</h2>
                        <p class="text-white">
                            EUREKA es una plataforma diseñada para ayudarte a recuperar tus objetos perdidos de manera rápida y 
                            eficiente. Sabemos lo frustrante que puede ser perder algo importante, y estamos aquí para hacer que 
                            el proceso de recuperación sea lo más sencillo posible.
                            <br><br>
                            Nuestra plataforma conecta a personas que han perdido objetos valiosos con aquellas que los han 
                            encontrado. Ya sea un teléfono, una billetera, un documento importante o cualquier otro objeto, 
                            EUREKA te brinda las herramientas para reunirte con tus pertenencias de nuevo.
                            <br><br>
                            ¡Únete a EUREKA y sé parte de nuestra misión de devolver sonrisas a aquellos que han perdido algo 
                            especial!
                        </p>
                    </div>
                </div>
                <img class="img-fluid pb-5" src="img/imagenes/intercambio.png" alt="..." />
            </div>
        </section>
        <!-- Projects-->
        <section class="projects-section bg-light" id="projects">
            <div class="container px-4 px-lg-5">
                <h2 class="display-4 text-center">Comunidad de Eureka</h2>
                <!-- Project One Row-->
                <div class="row gx-0 mb-5 mb-lg-0 justify-content-center">
                    <div class="col-lg-6"><img class="img-fluid" src="img/imagenes/seeker.png" alt="..." /></div>
                    <div class="col-lg-6">
                        <div class="bg-black text-center h-100 project">
                            <div class="d-flex h-100">
                                <div class="project-text w-100 my-auto text-center text-lg-left">
                                    <h4 class="text-white">Seeker</h4>
                                    <p class="mb-0 text-white-50">Un "Seeker" en el contexto de la plataforma EUREKA se refiere a un usuario 
                                que está "buscando" un elemento perdido. Es la parte activa del proceso que utiliza la 
                                plataforma para encontrar objetos, elementos o mascotas que han sido extraviados. El "Seeker" 
                                utiliza la plataforma para publicar detalles sobre el objeto perdido y establecer un punto de 
                                contacto con posibles "Finders" (personas que pueden haber encontrado el objeto). La función 
                                principal del "Seeker" es iniciar la búsqueda y facilitar la recuperación de los elementos perdidos 
                                al interactuar con otros usuarios de la plataforma.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Project Two Row-->
                <div class="row gx-0 justify-content-center">
                    <div class="col-lg-6"><img class="img-fluid" src="img/imagenes/finder.png" alt="..." /></div>
                    <div class="col-lg-6 order-lg-first">
                        <div class="bg-black text-center h-100 project">
                            <div class="d-flex h-100">
                                <div class="project-text w-100 my-auto text-center text-lg-right">
                                    <h4 class="text-white">Finders</h4>
                                    <p class="mb-0 text-white-50">
                                        Un "Finder" en el contexto de la plataforma EUREKA se refiere a un usuario que ha encontrado 
                                        o "encontrado" un objeto perdido. Es la parte receptora del proceso en la plataforma, que puede 
                                        identificar o haber hallado un objeto perdido y utiliza la plataforma para publicar detalles sobre 
                                        el elemento encontrado. El "Finder" busca conectar con los "Seekers" (personas que han perdido el 
                                        objeto) a través de la plataforma para facilitar la devolución del elemento extraviado a su propietario 
                                        legítimo. Su función principal es proporcionar información sobre el objeto encontrado y establecer 
                                        contacto con los "Seekers" para ayudar en su recuperación.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- project three row -->
                <div class="row gx-0 mb-5 mb-lg-0 justify-content-center">
                    <div class="col-lg-6"><img class="img-fluid" src="img/imagenes/IFC.png" alt="..." /></div>
                    <div class="col-lg-6">
                        <div class="bg-black text-center h-100 project">
                            <div class="d-flex h-100">
                                <div class="project-text w-100 my-auto text-center text-lg-left">
                                    <h4 class="text-white">International Finders Comunity (IFC)</h4>
                                    <p class="mb-0 text-white-50">
                                        International Finders Community" es una comunidad internacional de personas que se dedican a encontrar y 
                                        devolver objetos perdidos a sus propietarios legítimos. Esta comunidad está conformada por individuos 
                                        ubicados en distintas partes del mundo que comparten un interés común en ayudar a recuperar elementos extraviados. 
                                        A través de esta red global, los miembros colaboran para encontrar y devolver objetos perdidos, utilizando 
                                        recursos, tecnología y contactos disponibles para maximizar las posibilidades de éxito en la recuperación de 
                                        estos elementos. La comunidad se basa en la colaboración, la honestidad y el deseo de ayudar a otros a recuperar 
                                        sus pertenencias perdidas.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="footer bg-black small text-center text-white-50 text-white py-5" id="footer">
    <div class="container">
        <div class="row">
        <div class="col-md-3">
        <h5>Legal</h5>
        <ul class="list-unstyled">
          <li><a href="poli_priv.html" class="text-white">Política de privacidad</a></li>
          <li><a href="term_cond.html" class="text-white">Términos y condiciones</a></li>
          <li><a href="prot_datos.html" class="text-white">Protección de datos</a></li>
        </ul>
      </div>
      <div class="col-md-3">
        <h5>Información</h5>
        <ul class="list-unstyled">
          <li><a href="const.php" class="text-white">¿Quiénes somos?</a></li>
          <li><a href="const.php" class="text-white">Perfil de la empresa</a></li>
          <li><a href="const.php" class="text-white">¿Cómo funciona Eureka?</a></li>
        </ul>
      </div>
      <div class="col-md-3">
        <h5>¿Necesita ayuda?</h5>
        <ul class="list-unstyled">
          <li><a href="src/form_contacto.php" class="text-white">Contáctenos</a></li>
        </ul>
      </div>
      <div class="col-md-3">
        <h5>Contacto</h5>
        <ul class="list-unstyled">
          <li class="text-white">Puedes encontrarnos en:</li>
          <li><a href="#" class="text-white">Facebook</a></li>
          <li><a href="#" class="text-white">Twitter</a></li>
          <li><a href="#" class="text-white">Instagram</a></li>
        </ul>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-md-12 text-center">
        <p class="text-white">Copyright &copy; EUREKA 2023 | Todos los derechos reservados</p>
        <p class="text-white">SENA, Centro de Servicios Empresariales y Turisticos (CSET) Bucaramanga, Santander, Colombia</p>
        <p class="text-white">Hecho en Colombia</p>
      </div>
    </div>
 </div>
<!-- Agrega este código en la sección del footer -->
    <button id="scrollBtn" onclick="scrollToTop()">&#8593;</button>

</footer>    
    <script>
        window.onscroll = function() { showScrollButton() };

        function showScrollButton() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                document.getElementById("scrollBtn").style.display = "block";
            } else {
                document.getElementById("scrollBtn").style.display = "none";
            }
        }

        function scrollToTop() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    </script>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
