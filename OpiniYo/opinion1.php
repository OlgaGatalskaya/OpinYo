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
    <link rel="stylesheet" href="css/tOpiniones.css">
    <link rel="stylesheet" href="css/opinion.css">
    <link rel="stylesheet" href="css/paginaPrincipal.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon.png">
    <title>Añadir opinion</title>
</head>
<body>
<?php include 'header.php' ?>
    <?php if (revisarEstado()) { ?>
        <section class="sectionNav">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Escribir opinion</li>
                    </ol>
                </nav>
                <h2>Escriba su opinion</h2>
                <p>Cada opinión es muy importante para tomar la decisión correcta.</p>
            </div>
        </section>

        <section class="opinion overflow-auto pt-5">
            <div class="container">
                <div class="card w-100" >
                    <div class="card-body">
                        <p class="opinion-text1 mb-3 fs-5">En primer lugar, debe decidir sobre qué producto o servicio desea escribir una reseña.</p>
                        <form class="d-flex mb-3" role="search">
                            <input class="form-control me-1" type="search" placeholder="Buscar" aria-label="Search" id="buscarAñadirOpinion">
                            <button class="btn btn-outline-success btn-search" type="button" id="buscarElemento">Buscar</button>
                        </form>

                        <div class="containerElementoEncontrado mb-3">

                        </div>

                        <p class="opinion-text2">¿No ha encontrado lo que buscaba?</p>
                        <a class="btn btn-an-catalogo btn-index-tOpinion" href="productoNuevoOpinion.php">Añadir al catalogo</a>
                    </div>
                </div>
            </div>
        </section>

    <?php } else {
        header('Location: autorizacion.php');
    } ?>

    <footer class="footer p-4 text-white fixed-bottom" >
        <div class="row">
            <div class="col-12 text-center">
                <p class="m-auto">©  2024 | All Rights Reserved | Developed <i class="fa-solid fa-heart"></i> with Volha Hatalskaya</p>
                
            </div>
        </div>
    </footer>

<script src="js/ajax.js"></script>
<script src="js/bootstrap.bundle.js"></script>

</body>
</html>