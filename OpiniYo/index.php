<?php
include 'func.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/d50d610183.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/variables.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/paginaPrincipal.css">
    <link rel="stylesheet" href="css/tOpiniones.css">
    <link rel="stylesheet" href="css/starts.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon.png">

    <title>Pagina principal</title>
</head>
<body>

<?php include 'header.php'?>

    <section class="hero">
        <div class="container hero-container">
            <div class="row hero-row align-items-lg-center justify-content-between">
                <div class="hero-column1 col-lg-5 col-md-8 d-md-flex align-items-md-center m-md-auto">
                    <h1 class="hero-title text-lg-start text-center">Reseñas y opiniones <br> <span>de productos y servicios por varias categorías.</span></h1>
                </div>
                <div class="hero-column2 col-lg-7 d-lg-flex d-xl-flex d-xxl-flex justify-content-end d-none ">
                    <img src="img/hero-img 1.png" alt="hero" width="550px">
                </div>
            </div>

            <div class="categorias-section m-auto">
                <div class="row row-categorias bg-white ">
                    <?php
                    $categorias = todas_categorias();

                    for($i = 0; $i < count($categorias); $i++){?>
                        <div class="col-6 col-sm-4 col-lg categorias"><a class="nav-link link-categorias" href="categoria.php?IDCategoria=<?php print $categorias[$i]['IDCategoria'] ?>"><?php print $categorias[$i]['NombreCategoria'] ?></a></div>
                    <?php }
                    ?>

                </div>
            </div>
        </div>
        <div class="lines"><img src="img/lines.png" width="250px" alt=""></div>
        <div class="lines2"><img src="img/lines.png" width="250px" alt=""></div>
        <div class="line"><img src="img/line.png" width="70px" alt=""></div>
        <div class="line2"><img src="img/line.png" width="70px" alt=""></div>
    </section>

<section class="section-carusel1 ">
    <div class="carusel1-container m-3">
        <h2 class="title-carusel1 mb-3 text-center">Opiniones de los usuarios del Opini<span class="text-primary fw-bold">Yo</span>.es</h2>
        <p class="suttitle-carusel1 mb-5 text-center text-primary fs-5"><a href="todasOpiniones.php">Ver todas las opiniones <i class="fa-solid fa-arrow-right"></i></a> </p>

        <div id="carouselExampleControls1" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php
                $first = true;
                $products = opinionesInicioFecha1();
                foreach ($products as $index => $product) {
                    if ($index % 4 == 0) {
                        if ($first) {
                            echo '<div class="carousel-item active"><div class="row flex-nowrap">';
                            $first = false;
                        } else {
                            echo '</div></div><div class="carousel-item"><div class="row flex-nowrap">';
                        }
                    }
                    ?>
                    <div class="col-12 col-sm-6 col-md-5 col-lg-4 col-xl-3">
                        <div class="card div-producto p-3 ">
                            <div class="row">
                                <div class="col-12 card-title fw-bold"><?php echo $product['NombreProducto']; ?></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-2 c-img"><img src="imgProductos/<?php echo $product['ImagenProducto']; ?>" alt="producto" class="w-100"></div>
                                <div class="col-8">
                                    <div class="row mb-2">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="rating rating-set d-flex align-items-end">
                                                    <div class="rating-body text-dark">
                                                        <div class="rating-active"></div>
                                                    </div>
                                                    <div class="rating-value text-dark d-none"><?php print $product['Rating'] ?></div>
                                                </div>
                                            </div>
                                            <div class="row ms-2 text-primary" ><?php echo $product['LoginUsuario']; ?></div>
                                        </div>
                                    </div>
                                    <div class="row"><hr></div>
                                    <div class="row"><?php echo $product['FechaOpinion']; ?></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 text-carusel1 comentario text-block">
                                    <?php echo $product['ComentarioOpinion']; ?>
                                    <a href="leerTodaOpinion.php?IDOpinion=<?php print $product['IDOpinion'] ?>" class="block-text-more ">Leer toda la opinion</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                echo '</div></div>';
                ?>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls1" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon " aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls1" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </a>
        </div>
    </div>
</section>

    <section class="section3">
        <div class="container">
            <div class="row">
                <div class="section3-img col-12 col-md-6 mb-4">
                    <img src="img/section3.png" alt="">
                </div>
                <div class="col-12 col-md-6 m-auto">
                    <div class="row mb-2"><h2 class="index-h2">Plataforma gratuita para revisar diferentes productos</h2></div>
                    <div class="row mb-3"><p class="fs-5">Comparta sus experiencias con diferentes productos para ayudar a otros a tomar la decisión correcta.</p></div>
                    <div class="row m-auto">
                        <a href="todasOpiniones.php" class="col-5 btn-1 me-2 p-2 text-center text-decoration-none btn-index-tOpinion">Todas opiniones</a>
                        <a href="opinion1.php" class="col-5 btn-2 p-2 text-center text-decoration-none btn-index-crOpinion">Añadir opinion</a>
                    </div>
                </div>
            </div>
        </div>
    </section>


<section class="section-carusel1 ">
    <div class="carusel1-container m-3">
        <h2 class="title-carusel1 mb-3 text-center">Las opiniones más populares del Opini<span class="text-primary fw-bold">Yo</span>.es</h2>
        <p class="suttitle-carusel1 mb-5 text-center text-primary fs-5"><a href="todasOpiniones.php">Ver todas las opiniones <i class="fa-solid fa-arrow-right"></i></a> </p>

        <div id="carouselExampleControls2" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php
                $first = true;
                $products = opinionesInicioRating();
                foreach ($products as $index => $product) {
                    if ($index % 4 == 0) {
                        if ($first) {
                            echo '<div class="carousel-item active"><div class="row flex-nowrap">';
                            $first = false;
                        } else {
                            echo '</div></div><div class="carousel-item"><div class="row flex-nowrap">';
                        }
                    }
                    ?>
                    <div class="col-12 col-sm-6 col-md-5 col-lg-4 col-xl-3">
                        <div class="card div-producto p-3 ">
                            <div class="row">
                                <div class="col-12 card-title fw-bold"><?php echo $product['NombreProducto']; ?></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-2 c-img"><img src="imgProductos/<?php echo $product['ImagenProducto']; ?>" alt="producto" class="w-100"></div>
                                <div class="col-8">
                                    <div class="row mb-2">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="rating rating-set d-flex align-items-end">
                                                    <div class="rating-body text-dark">
                                                        <div class="rating-active"></div>
                                                    </div>
                                                    <div class="rating-value text-dark d-none"><?php print $product['Rating'] ?></div>
                                                </div>
                                            </div>
                                            <div class="row ms-2 text-primary" ><?php echo $product['LoginUsuario']; ?></div>
                                        </div>
                                    </div>
                                    <div class="row"><hr></div>
                                    <div class="row"><?php echo $product['FechaOpinion']; ?></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 text-carusel1 comentario text-block">
                                    <?php echo $product['ComentarioOpinion']; ?>
                                    <a href="leerTodaOpinion.php?IDOpinion=<?php print $product['IDOpinion'] ?>" class="block-text-more ">Leer toda la opinion</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                echo '</div></div>';
                ?>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls2" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls2" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </a>
        </div>
    </div>
</section>


<section class="section-search p-5 text-white">
        <div class="container">
            <div class="row">
                <div class="col col-sm-10 col-md-8 col-lg-6 m-auto">
                    <h1 class="hero-title text-center mb-4">Reseñas y opiniones <br> <span>de productos y servicios por varias categorías.</span></h1>
                </div>
            </div>
            <div class="row">
                <div class="col col-sm-10 col-md-8 col-lg-6 m-auto">
                    <p class="text-center mb-4">Habla. Escucha. Conecta.</p>
                </div>
            </div>
            <div class="row"> 
                <div class="col col-sm-10 col-md-8 col-lg-6 m-auto">
                    <form class="d-flex" role="search" method="post" action="buscadorOpiniones.php">
                        <input class="form-control me-1" type="search" placeholder="Buscar" aria-label="Search" name="elementoBuscado">
                        <button class="btn btn-outline-success btn-search2" type="submit" name="btn-buscadorOpiniones">Buscar</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer p-4">
        <div class="row">
            <div class="col-12 text-center">
                <p class="m-auto text-white">©  2024 | All Rights Reserved | Developed <i class="fa-solid fa-heart"></i> with Volha Hatalskaya</p>
                
            </div>
        </div>
    </footer>

    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/stars.js"></script>


</body>
</html>