<?php
include 'func.php';
$IDOpinion = intval($_GET["IDOpinion"]);
$opinion = leerOpinion($IDOpinion);

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
    <link rel="stylesheet" href="css/tOpiniones.css">
    <link rel="stylesheet" href="css/opinion.css">
    <link rel="stylesheet" href="css/starts.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon.png">
    <title>Todos opiniones</title>
</head>
<body>
<?php include 'header.php'?>

<section class="sectionNav">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                <li class="breadcrumb-item"><a href="todasOpiniones.php">Todas las opiniones</a></li>
                <li class="breadcrumb-item active" aria-current="page" ></li>Leer opinion
            </ol>
        </nav>
    </div>
</section>

<section class="opinion-section">
    <div class="card-container pt-5">
        <div class="container">
            <div class="card mb-3" style="max-width: 740px;">
                <div class="row g-0 p-3">
                    <div class="col-md-4">
                        <img src="imgProductos/<?php print $opinion[0]['ImagenProducto'] ?>" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?php print $opinion[0]['NombreProducto'] ?></h5>
                            <div class="rating rating-set d-flex align-items-end mb-3">
                                <div class="rating-body text-dark">
                                    <div class="rating-active"></div>
                                </div>
                                <div class="rating-value text-dark d-none"><?php print $opinion[0]['Rating'] ?></div>
                            </div>
                            <div class="enlaceCrearOpinion w-50 text-center pt-1 pb-1 rounded mb-3"><a href="opinion1.php" class="text-white">Añadir opinion</a></div>
                            <p class="card-text">Categoria: <span class="text-primary"><?php print $opinion[0]['NombreCategoria'] ?></span> </p>
                            <p class="card-text">Subcategoria: <span class="text-primary"><?php print $opinion[0]['NombreSubcategoria'] ?></span> </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="opinion-container pb-5">
        <div class="container">
            <div class="card" style="max-width: 740px;">
                <div class="card-header p-4">
                    <h4><?php print $opinion[0]['LoginUsuario'] ?></h4>
                    <div class="rating rating-set d-flex align-items-end mb-3">
                        <div class="rating-body text-dark">
                            <div class="rating-active"></div>
                        </div>
                        <div class="rating-value text-dark d-none"><?php print $opinion[0]['Rating'] ?></div>
                    </div>
                    <div>Fecha de la publicación: <span class="text-primary"><?php print $opinion[0]['FechaOpinion'] ?></span> </div>
                </div>

                <div class="card-body p-4">
                    <div class="card-text leerOpinion-comentario"><?php print $opinion[0]['ComentarioOpinion'] ?></div>
                    <a href="todasOpiniones.php" class="btn btn-primary">Volver a ver todas las opiniones </a>
                </div>
            </div>
        </div>

    </div>

</section>


<footer class="footer p-4 text-white">
    <div class="row">
        <div class="col-12 text-center">
            <p class="m-auto">©  2023 | All Rights Reserved | Developed <i class="fa-solid fa-heart"></i> with Volha Hatalskaya</p>

        </div>
    </div>
</footer>
<script src="js/bootstrap.bundle.js"></script>
<script src="js/stars.js"></script>

</body>
</html>




