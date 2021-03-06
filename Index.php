<?php 
include "./Bd_index.php";    
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Ferreteria Caride</title>
        <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700|Oswald&display=swap" rel="stylesheet">
        <link rel="stylesheet" href=".//css/fullpagejs.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		<script src="js/jquery-1.12.0.js"></script>
        <link rel="stylesheet" href="css/estilos.css">
    </head>

    <body>
        <nav class="nav">
            <a href="#inicio" class="marca">Ferreteria Caride</a>
            <ul id="menu" class="menu">
                <li data-menuanchor="inicio" class="active">
                    <a href="#inicio">Inicio</a>
                </li>
                <li data-menuanchor="productos">
                    <a href="#productos">Productos</a>
                </li>
                <li data-menuanchor="novedades">
                    <a href="#novedades">Novedades</a>
                </li>
                <li data-menuanchor="contacto">
                    <a href="#contacto">Contacto</a>
                </li>
            </ul>
        </nav>

        <main id="fullpage">
            <!--Seccion Pagina Inicio -->
            <header class="section productos">

                <article class="slide">
                    <div class="informacion-producto">
                        <p class="modelo">
                            <span class="texto-blanco">Ferreteria</span>
                        </p>
                        <p class="descripcion texto-blanco">Gran variedad de herramientas</p>
                    </div>
                </article>
                <article class="slide">
                    <div class="informacion-producto">
                        <p class="modelo">
                            <span class="texto-blanco">Fontaner??a</span>
                        </p>
                        <p class="descripcion texto-blanco">Gran variedad de diametros y longitudes.</p>
                    </div>
                </article>
                <article class="slide">
                    <div class="informacion-producto">
                        <p class="modelo">
                            <span class="texto-blanco">Pinturas</span>
                        </p>
                        <p class="descripcion texto-blanco">Todo tipo de pinturas y colores</p>
                    </div>
                </article>
                <!--Seccion Productos -->
            </header>
            <section class="section productos2" id="Productos">
                <nav class="navbar navbar-expand-lg  navbar-dark bg-dark " style="padding-top: 3.5%">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#"></a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Navegaci??n de palanca">
						<span class="navbar-toggler-icon"></span>
					</button>
                        <div class="collapse navbar-collapse" id="navbarColor01">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item" id="Ferreteria">
                                    <a id="aFerreteria" class="nav-link active" aria-current="page">
									Ferreteria
								</a>
                                </li>
                                <li class="nav-item" id="Fontaneria">
                                    <a id="aFontaneria" class="nav-link">Fontaneria
								</a>
                                </li>
                                <li class="nav-item" id="Pintura">
                                    <a id="aPintura" class="nav-link">
									Pintura
								</a>
                                </li>
                                <li class="nav-item" id="Electrico">
                                    <a id="aElectrico" class="nav-link">
									Material Electrico
								</a>
                                </li>
                                <li class="nav-item" id="Hogar">
                                    <a id="aHogar" class="nav-link">
									Hogar
								</a>
                                </li>
                                <li class="nav-item" id="Construccion">
                                    <a id="aConstruccion" class="nav-link">
									Material de Construccion
								</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>

                <!--Seccion lista-->
                <div style="display: flex; flex-direction:row">
                    <div class="lista-contenedor">
                        <ul id="lista" class="lista "></ul>
                    </div>
                    <div class="imagenes_productos">
                        <!--Carousel con las imagenes de los productos-->
                        <article class="slide">
                            <div class="informacion-producto">
                                <p class="modelo">
                                    <span class="texto-blanco">Ferreteria</span>
                                </p>
                                <p class="descripcion texto-blanco">Gran variedad de herramientas</p>
                            </div>
                        </article>
                        <article class="slide">
                            <div class="informacion-producto">
                                <p class="modelo">
                                    <span class="texto-blanco">Fontaner??a</span>
                                </p>
                                <p class="descripcion texto-blanco">Gran variedad de diametros y longitudes.</p>
                            </div>
                        </article>
                        <article class="slide">
                            <div class="informacion-producto">
                                <p class="modelo">
                                    <span class="texto-blanco">Pinturas</span>
                                </p>
                                <p class="descripcion texto-blanco">Todo tipo de pinturas y colores</p>
                            </div>
                        </article>
                    </div>
            </section>
            <section class="section novedades">

                <div id="contenedor-novedades" class="contenedor-novedades">
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        <?php 
                    $post=cargar_post();
                    for($i = 0; $i < count($post); ++$i) {
                       echo '<div class="col">
                            <div class="card">
                                <img src="'.$post[$i][5].'" style="height: 230px;" class="card-img-top" alt="..." />
                                <div class="card-body">
                                    <h5 class="card-title">'.$post[$i][3].'</h5>
                                    <p class="card-text">
                                        '.$post[$i][4].'
                                        <br>
                                        <a href="#" class="btn btn-primary">Seguir leyendo</a>
                                    </p>
                                </div>
                            </div>
                        </div>';
                    };
                        ?>
                    </div>

                </div>

            </section>
            <!--Seccion Redes Sociales  -->
            <footer class="section footer">
                <h2 class="texto-azul">Siguenos en Redes Sociales</h2>
                <p class="redes-sociales">
                    <a href="#" class="facebook"><i class="fab fa-facebook-square"></i></a>
                    <a href="#" class="twitter"><i class="fab fa-twitter-square"></i></a>
                    <a href="#" class="instagram"><i class="fab fa-instagram"></i></a>
                </p>
            </footer>
        </main>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/3.0.7/fullpage.js"></script>
        <script src="js/app.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		
        <!-- Script para cabiar los textos de productos -->

        <script>
            $(document).ready(function() {
                $("#lista").append(
                    "<li id='Ferreteria1'>Herramienta Manual</li><li id='Ferreteria2'>Herramienta Electrica y Accesorios</li><li id='Ferreteria3'>Complementos de Trabajo y Proteccion </li><li id='Ferreteria4'>Plasticos,felpudos y corchos</li><li id='Ferreteria5'>Botellas Camping Gas</li><li id='Ferreteria6'>Escaleras</li><li id='Ferreteria7'>Herrajes de Carpinter??a</li><li id='Ferreteria8'>Mangera y Accesorios de Riego</li> <li id='Ferreteria9'>Buzones y Cajas de Herramientas </li>"
                );
                $("#Ferreteria").click(cargar_categoria);
                $("#Fontaneria").click(cargar_categoria);
                $("#Pintura").click(cargar_categoria);
                $("#Electrico").click(cargar_categoria);
                $("#Hogar").click(cargar_categoria);
                $("#Construccion").click(cargar_categoria);
                /*Escuchadores de los productos Ferreteria*/
                $("#Ferreteria1").click(herramienta_manual);
                $("#Ferreteria2").click(herramienta_electrica);
                $("#Ferreteria3").click(complementos);
                $("#Ferreteria4").click(plasticos);
                $("#Ferreteria5").click(botellas_camping);
                $("#Ferreteria6").click(escaleras);
                $("#Ferreteria7").click(carpinteria);
                $("#Ferreteria8").click(mangeras);
                $("#Ferreteria9").click(buzones);


            });

            function cargar_categoria() {
                $("#lista li").remove();
                var tipo = $(this).attr("id");
                $("#aFerreteria").removeClass("nav-link active");
                $("#aFontaneria").removeClass("nav-link active");
                $("#aPintura").removeClass("nav-link active");
                $("#aElectrico").removeClass("nav-link active");
                $("#aHogar").removeClass("nav-link active");
                $("#aConstruccion").removeClass("nav-link active");

                $("#aFerreteria").addClass("nav-link");
                $("#aFontaneria").addClass("nav-link");
                $("#aPintura").addClass("nav-link");
                $("#aElectrico").addClass("nav-link");
                $("#aHogar").addClass("nav-link");
                $("#aConstruccion").addClass("nav-link");
                $("#a" + tipo).removeClass("nav-link active");

                $("#a" + tipo).addClass("nav-link active");

                if (tipo === "Ferreteria") {
                    $("#lista").append(
                        "<li id='Ferreteria1'>Herramienta Manual</li><li id='Ferreteria2'>Herramienta Electrica y Accesorios</li><li id='Ferreteria3'>Complementos de Trabajo y Proteccion </li><li id='Ferreteria4'>Plasticos,felpudos y corchos</li><li id='Ferreteria5'>Botellas Camping Gas</li><li id='Ferreteria6'>Escaleras</li><li id='Ferreteria7'>Herrajes de Carpinter??a</li><li id='Ferreteria8'>Mangera y Accesorios de Riego</li> <li id='Ferreteria9'>Buzones y Cajas de Herramientas </li>"
                    );
                    $("#Ferreteria1").click(herramienta_manual);
                    $("#Ferreteria2").click(herramienta_electrica);
                    $("#Ferreteria3").click(complementos);
                    $("#Ferreteria4").click(plasticos);
                    $("#Ferreteria5").click(botellas_camping);
                    $("#Ferreteria6").click(escaleras);
                    $("#Ferreteria7").click(carpinteria);
                    $("#Ferreteria8").click(mangeras);
                    $("#Ferreteria9").click(buzones);
                }
                if (tipo === "Fontaneria") {
                    $("#lista").append(
                        "<li id='Fontaneria1'>Tuber??a extracci??n gases y calentadores.</li><li id='Fontaneria2'>Tuber??a cobre, polietileno, Pb, multicapa y racorer??a en lat??n.</li><li id='Fontaneria3'>Tuber??a PVC, canal??n y accesorios</li><li id='Fontaneria4'>Grifer??a</li><li id='Fontaneria5'>Motores y bombas pozo</li><li id='Fontaneria6'>Accesorios Ba??o, manuales, soportes, barras y alfombras ducha</li>"
                    );
                }
                if (tipo === "Pintura") {
                    $("#lista").append(
                        "<li id='pintura1'>Pinturas pl??sticas de interior y exterior.</li><li id='pintura2'>Pinturas en spray</li><li id='pintura3'>Tratamientos para la madera</li><li id='pintura4'>Disolventes y gran variedad de productos complementarios</li><li id='pintura5'>Rodillos, pinceles, cintas y lija entre otros</li>"
                    );
                }
                if (tipo === "Electrico") {
                    $("#lista").append(
                        "<li  id='electrico1'>Elementos el??ctricos Simon-27</li><li id='electrico2'>Cajas de montaje y derivaci??n</li><li id='electrico3'>Corrugados</li><li id='electrico4'>Cable de linea hasta 10mm y mangueras de dos, tres o cuatro hilos</li><li id='electrico5'>Canaleta</li><li id='electrico6'>Magnetot??rmicos y diferenciales</li><li id='electrico7'>Peque??o material para la mayor??a de las necesidades habituales</li>"
                    );
                }
                if (tipo === "Hogar") {
                    $("#lista").append(
                        "<li id='hogar1'>Menaje de cocina met??lico y pl??stico</li><li id='hogar2'>Vinilos adhesivos</li><li id='hogar3'>Hules</li><li id='hogar4'>Amplio surtido de tendales de ropa</li>"
                    );
                }
                if (tipo === "Construccion") {
                    $("#lista").append(
                        "<li id='construccion1'>Morteros, cementos cola y escayolas</li><li  id='construccion2'>Ladrillo</li><li  id='construccion3'>Telas asf??lticas, poliexpand</li><li  id='construccion4'>Planchas fibra cubiertas y sujecciones</li>"
                    );
                }
            }
            /*Funcion que cabia las imagenes del carousel de productos*/
            function cambiar_imagenes(imagen1, imagen2, imagen3) {
                console.log("entra");
                let imagenes = [imagen1, imagen2, imagen3]
                for (let index = 1; index < 4; index++) {
                    console.log(imagenes[index - 1]);
                    $("#Productos article:nth-child(" + index + ")").css('background-image', "url('" + imagenes[index - 1] + "')");

                }
            }
            /*Cambio de las imagenes  de los productos de la ferreter??a*/
            function herramienta_manual() {
                cambiar_imagenes("https://cdn.pixabay.com/photo/2015/12/02/23/48/screwdrivers-1073515__340.jpg", "https://cdn.pixabay.com/photo/2012/02/22/20/02/tools-15539_960_720.jpg", "https://cdn.pixabay.com/photo/2017/04/04/17/26/hacksaw-2202309_960_720.jpg")
                $("#lista li").removeClass("producto_activo")
                $(this).addClass("producto_activo");
            }

            function herramienta_electrica() {
                cambiar_imagenes("https://cdn.pixabay.com/photo/2014/09/13/21/47/taps-444506_960_720.jpg", "https://cdn.pixabay.com/photo/2020/03/04/07/27/car-4900733_960_720.jpg", "https://cdn.pixabay.com/photo/2017/03/31/23/36/chainsaw-2192639_960_720.jpg");
                $("#lista li").removeClass("producto_activo")
                $(this).addClass("producto_activo");
            }

            function complementos() {
                cambiar_imagenes("https://cdn.pixabay.com/photo/2018/01/11/06/26/construction-3075498_960_720.jpg", "https://blog.bextok.com/wp-content/uploads/2017/07/iStock-91502297-e1500727396458.jpg", "https://cdn.pixabay.com/photo/2015/11/11/12/34/occupational-safety-and-health-1038550_960_720.jpg")
                $("#lista li").removeClass("producto_activo")
                $(this).addClass("producto_activo");
            }

            function plasticos() {
                cambiar_imagenes("https://cdn.pixabay.com/photo/2015/05/22/23/56/wine-bottle-780102_960_720.jpg", "https://cdn.pixabay.com/photo/2014/09/03/06/56/welcome-434118_960_720.png", "http://www.tiendadeplasticos.es/ControlIntegral/imagenes/articulos/rollo-15-kgs-200-metros-polietileno-tubo-80-cm-color-azul-material-industrial-plastico-por-metros-plastics-pujol-s-l-art.jpg ")
                $("#lista li").removeClass("producto_activo")
                $(this).addClass("producto_activo");
            }

            function botellas_camping() {
                cambiar_imagenes("https://cdn.pixabay.com/photo/2017/08/05/20/57/portable-2585538_960_720.jpg", "https://cdn.pixabay.com/photo/2016/08/11/08/00/gas-1584988_960_720.jpg", "https://cdn.pixabay.com/photo/2014/01/24/00/30/light-250848_960_720.jpg")
                $("#lista li").removeClass("producto_activo")
                $(this).addClass("producto_activo");
            }

            function escaleras() {
                cambiar_imagenes("https://images.pexels.com/photos/5691661/pexels-photo-5691661.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260", "https://cdn.pixabay.com/photo/2015/03/20/16/13/head-682484_960_720.jpg", "https://images.pexels.com/photos/5767931/pexels-photo-5767931.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260")
                $("#lista li").removeClass("producto_activo")
                $(this).addClass("producto_activo");
            }

            function carpinteria() {
                cambiar_imagenes("https://lh3.googleusercontent.com/proxy/QeHTN5uWoDfI3FhG6xg0Hy2LCMHD4xUcV7U8OjlXgQ0weB1E3b2KXu16OJl2po8oU3eMyysDfxKGl6hyh_DxtNT0U3T_0-95qrIkekQjXFTtiwn0", "https://www.ikea.com/es/es/images/products/utrusta-herrajes__0624701_pe691988_s5.jpg", "https://bullimporter.com/wp-content/uploads/2016/08/herrajes-para-muebles-1.png")
                $("#lista li").removeClass("producto_activo")
                $(this).addClass("producto_activo");
            }

            function mangeras() {
                $("#lista li").removeClass("producto_activo")
                $(this).addClass("producto_activo");
            }

            function buzones() {
                $("#lista li").removeClass("producto_activo")
                $(this).addClass("producto_activo");
            }
        </script>

    </body>

    </html>
    <p