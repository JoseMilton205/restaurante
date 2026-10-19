
<?php 
include("admin/bd.php");
$sentencia=$conexion->prepare("SELECT * FROM tbl_banners ORDER BY id DESC limit 1 ");
$sentencia->execute();
$lista_banner=$sentencia->fetchAll(PDO::FETCH_ASSOC);

$sentencia=$conexion->prepare("SELECT * FROM tbl_colaboradores ORDER BY titulo DESC");
$sentencia->execute();
$lista_colaboradores=$sentencia->fetchAll(PDO::FETCH_ASSOC);

$sentencia=$conexion->prepare("SELECT * FROM tbl_testimonios ORDER BY id DESC limit 2");
$sentencia->execute();
$lista_testimonios=$sentencia->fetchAll(PDO::FETCH_ASSOC);

$sentencia=$conexion->prepare("SELECT * FROM tbl_menu ORDER BY id DESC limit 4");
$sentencia->execute();
$lista_menu=$sentencia->fetchAll(PDO::FETCH_ASSOC);

if($_POST){
    $nombre=filter_var($_POST["nombre"], FILTER_SANITIZE_STRING);
    $correo=filter_var($_POST["correo"], FILTER_VALIDATE_EMAIL);
    $mensaje=filter_var($_POST["mensaje"], FILTER_SANITIZE_STRING);

    if($nombre && $correo && $mensaje){
        $sql="INSERT INTO
        tbl_comentarios (nombre, correo, mensaje)
        VALUES (:nombre, :correo, :mensaje)";

        $resultado = $conexion->prepare($sql);
        $resultado ->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $resultado ->bindParam(':correo', $correo, PDO::PARAM_STR);
        $resultado ->bindParam(':mensaje', $mensaje, PDO::PARAM_STR);
        $resultado->execute();
    }

    header("Location:index.php");

}
?>

<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />
        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
        <link
        rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    crossorigin="anonymous"
    referrerpolicy="no-referrer" />
    </head>
    <body>
        <!--seccion de menu de navegacion-->
        <header>
            <!-- place navbar here -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                    <a class="navbar-brand" href="#"><i class="fas fa-utensils"></i> Restaurant La Orureña</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle Navegation">
                <span class="navbar-toggler-icon"></span>
            </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="nav navbar-nav ms-auto">
                    
                    <li class="nav-item">
                        <a class="nav-link" href="#inicio">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#menu">Menu del dia</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#chefs">Chefs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#testimonios">Testimonios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contactos">Contactos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#Horario">Horario</a>
                    </li>
                    </ul>
                </div>
            <div>
        </nav>
        <section id="banner" class="container-fluid p-0">
            <div class="banner-img" style="posiion:relative;
                        background:url('images/img2.jpeg')
                        center/cover no-repeat; height:400px;">
            <div class="banner-text" style="position:absolute; top:50%; left:50%;
                        transform:translate(-50%, -50%); text-align:center;color:#fff;">
                        
                    <!--seccioin de banner-->

            <?php
            foreach($lista_banner as $banner){

            ?>
                <h1><?php echo $banner['titulo'];?></h1>
                <p><?php echo $banner['descripcion'];?></p>
                <a href="#menu" class="btn btn-primary">Ver menu</a>
                <?php } ?>
            </div>
            <div>
        </section>
        <section id="bienvenida" class="container-fluid p-4">
            <div class="text-center text-white d-flex align-items-center justify-content-center" 
                style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), 
                url('images/image3.jpg'); 
                background-position: center;
                center/cover no-repeat;
                height: 200px;">
        
        <div class="container">
            <h1 class="display-3 fw-bold">¡ Bienvenidos al Restaurant La Orureña !</h1>
            <p class="lead italic">Descubre una experiencia culinaria única.</p>
        </div>
    </div>
</section>
<!--seccion de chefs-->
        <section id="chefs" class="container mt-4 text-center">
            <h2>Nuestros Chefs</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <img src="images/colaboradores/image3.jpeg" 
                        class="card-img-top" 
                        alt="Chef 1"
                        />
                        <div class="card-body">
                            <h5 class="card-title">Chef 1</h5>
                            <p class="card-text">El Chef Mario Kertapen</p>
                            <div class="social-icons mt-3">
                                <a href="#"class="text-dark me-2"><i class="fab fa-facebook"></i></a>
                                <a href="#"class="text-dark me-2"><i class="fab fa-instagram"></i></a>
                                <a href="#"class="text-dark me-2"><i class="fab fa-linkedin"></i></a>
                                <a href="#"class="text-dark me-2"><i class="fab fa-whatsapp"></i></a>
                                <a href="#"class="text-dark me-2"><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="images/colaboradores/image4.jpeg" 
                        class="card-img-top" 
                        alt="Chef 1"
                        />
                        <div class="card-body">
                            <h5 class="card-title">Chef 2</h5>
                            <p class="card-text">La Chef Marisa </p>
                            <div class="social-icons mt-3">
                                <a href="#"class="text-dark me-2"><i class="fab fa-facebook"></i></a>
                                <a href="#"class="text-dark me-2"><i class="fab fa-instagram"></i></a>
                                <a href="#"class="text-dark me-2"><i class="fab fa-linkedin"></i></a>
                                <a href="#"class="text-dark me-2"><i class="fab fa-whatsapp"></i></a>
                                <a href="#"class="text-dark me-2"><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="images/colaboradores/image5.jpeg" 
                        class="card-img-top" 
                        alt="chef 1"
                        />
                        <div class="card-body">
                            <h5 class="card-title">Chef 3</h5>
                            <p class="card-text">La Chef Monica K</p>
                            <div class="social-icons mt-3">
                                <a href="#"class="text-dark me-2"><i class="fab fa-facebook"></i></a>
                                <a href="#"class="text-dark me-2"><i class="fab fa-instagram"></i></a>
                                <a href="#"class="text-dark me-2"><i class="fab fa-linkedin"></i></a>
                                <a href="#"class="text-dark me-2"><i class="fab fa-whatsapp"></i></a>
                                <a href="#"class="text-dark me-2"><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
        </section>
        <!--seccion de testimonios-->
       <section id="testimonios" class="bg-light py-5">
    <div class="container">
        <h2 class="text-center mb-4">Testimonios</h2>

        <div class="row">
            <?php foreach($lista_testimonios as $testimonio){ ?>
                <div class="col-md-6 d-flex">
                    <div class="card mb-4 w-100">
                        <div class="card-body">
                            <p class="card-text">
                                <?php echo $testimonio["opinion"]; ?>
                            </p>
                        </div>
                        <div class="card-footer text-muted">
                            <?php echo $testimonio["nombre"]; ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

    </div>
</section>

    <section id="menu" class="container mt-4">
    <h2 class="text-center mb-4">Menú (Nuestra recomendación)</h2>
    
    <div class="row row-cols-1 row-cols-md-4 g-4">
        
        <div class="col d-flex">
            <div class="card h-100">
                <img src="images/menu/imag6.jpeg" class="card-img-top" alt="Plato 1" />
                <div class="card-body">
                    <h5 class="card-title">Pique Macho</h5>
                    <p class="card-text small">
                        <strong>Ingredientes:</strong> Plato típico, trozos de carne de res, salchichas, papas fritas, cebolla, tomate y locoto.
                    </p>
                    <p class="card-text"><strong>Precio:</strong> Bs 40</p>
                </div>
            </div>
        </div>
        <div class="col d-flex">
            <div class="card h-100">
                <img src="images/menu/imag010.jpg" class="card-img-top" alt="Plato 2" />
                <div class="card-body">
                    <h5 class="card-title">Salteñas</h5>
                    <p class="card-text small">
                        <strong>Ingredientes:</strong> harina, huevo, verduras, carne.
                    </p>
                    <p class="card-text"><strong>Precio:</strong> Bs 10</p>
                </div>
            </div>
        </div>
        <div class="col d-flex">
            <div class="card h-100">
                <img src="images/menu/imag11.jpg" class="card-img-top" alt="Plato 3" />
                <div class="card-body">
                    <h5 class="card-title">Api con Buñuelo</h5>
                    <p class="card-text small">
                        <strong>Ingredientes:</strong> Api, harina, azucar,etc,.
                    </p>
                    <p class="card-text"><strong>Precio:</strong> Bs 10</p>
                </div>
            </div>
        </div>
        <div class="col d-flex">
            <div class="card h-100">
                <img src="images/menu/img9.jpg" class="card-img-top" alt="Plato 4" />
                <div class="card-body">
                    <h5 class="card-title">Rostro asado</h5>
                    <p class="card-text small">
                        <strong>Ingredientes:</strong> Cabeza de cordero, pan, locoto.
                    </p>
                    <p class="card-text"><strong>Precio:</strong> Bs 60</p>
                </div>
            </div>
        </div>
    </div> 

    </section>
    <!--seccion de contacto-->
    <section id="contactos"class="container mt-4">
        <h2>Contactos</h2>
        <p><strong>Estamos aqui para servirle</strong></p>
        <form action="?" method="post">
            <div class="mb-3">
            <label for="name">Nombre</label></br>
            <input type="text" class="form-control" name="nombre" placeholder="Escribe tu nombre.." required></br>
            </div>
            </div>
            <div class="mb-3">
            <label for="email">Correo electronico</label></br>
            <input type="email" class="form-control" name="correo" placeholder="Escribe tu nombre.." required></br>
            </div>
            <div class="mb-3">
            <label for="message">Mensaje</label></br>
            </div>
            <textarea id="message" class="form-control" name="mensaje" rows="6" cols="50"></textarea></br>
            <input type="submit" class="btn btn-primary" value="Enviar mensaje">
        </form>     
    </section> <br></br>
    <div id="Horario"class="container mt-4">
        <!--seccion de horario-->
        <div class="text-center bg-ligth P-4">
            <h3 class="mb-4"> Horarios de atencion</h3>

            <div>
                <p><strong>Lunes a Viernes</strong></p>
                <p><strong> 11:00 a.m. - 10:00 p.m</strong></p>
            </div>
            <div>
                <p><strong>Sabado</strong></p>
                <p><strong> 12:00 a.m. - 5:00 p.m</strong></p>
            </div>
            <div>
                <p><strong>Domingo</strong></p>
                <p><strong> 7:00 a.m. - 2:00 p.m</strong></p>
            </div>
        </div>
    </div>
        </header>
        <main>
        Parte Central
        </main>
        <footer class="bg-dark text-light text-center py-3">
            <p>&copy; 2027 Restaurant la orureña, todos los derechos reservados.</p>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
