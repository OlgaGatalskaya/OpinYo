<?php
include 'func.php';



?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/d50d610183.js" crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/variables.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/tOpiniones.css">
    <link rel="stylesheet" href="css/opinion.css">
    <link rel="stylesheet" href="css/autorizacion.css">
    <link rel="stylesheet" href="css/paginaPrincipal.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon.png">
    <title>Añadir opinion</title>
</head>
<body>
<?php include 'header.php' ?>

<section class="sectionNav">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                <li class="breadcrumb-item"><a href="opinion1.php">Buscar producto</a></li>
                <li class="breadcrumb-item active" aria-current="page">Escribir opinion</li>
            </ol>
        </nav>

    </div>
</section>


<section class="section-espacioPersonal">
    <div class="container pt-5 pb-5">
        <form class="row">
            <div class="col-12 col-md-10 col-lg-7">

                <div class="card mb-5">
                    <div class="card-header text-primary fw-bold fs-5">
                        Crear nuevo producto
                    </div>
                    <div class="card-body">

                            <div class="mb-3">
                                <label for="nombreProducto" class="form-label">Nombre de Producto</label>
                                <input type="text" class="form-control mb-3" id="nombreProducto" aria-describedby="nombreHelp" name="NombreProducto" required>
                                <input type="file" name="imgProducto" id="imgProductoNuevo" class="mb-3">
                                <select class="form-select" id="subcategoria" name="subcategoria" aria-label="Default select example" required>
                                    <option selected>Elige Subcategoria</option>
                                    <?php
                                    $subcategorias = todas_subcategorias();
                                    foreach ($subcategorias as $subcategoria) {?>
                                        <option value="<?php print  $subcategoria['IDSubcategoria']?>"><?php print $subcategoria['NombreSubcategoria'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label text-primary fs-4 fw-bold">Su opinion:</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <div class="form-item row pb-3">
                    <div class="form-label text-dark fs-5 fw-bold">¿Cuándo estrellas le das?</div>
                    <div class="rating rating-set d-flex align-items-end">
                        <div class="rating-body text-dark">
                            <div class="rating-active"></div>
                            <div class="rating-items d-flex">
                                <input type="radio" class="rating-item" value="1" name="rating">
                                <input type="radio" class="rating-item" value="2" name="rating">
                                <input type="radio" class="rating-item" value="3" name="rating">
                                <input type="radio" class="rating-item" value="4" name="rating">
                                <input type="radio" class="rating-item" value="5" name="rating">
                            </div>
                        </div>
                        <div class="rating-value text-dark d-none">1</div>
                    </div>
                </div>
                <div class="error"></div>
                <div class="d-none" id="idPr"></div>
                <div class="row mt-3">
                    <div class="col-md-5 col-8">
                        <button type="button" class="btn btn-primary w-75 btn-index-tOpinion" id="btnMandarOpinionProductoNuevo">Enviar</button>
                    </div>
                </div>
        </form>
    </div>

</section>

<footer class="footer p-4 text-white fixed-bottom">
    <div class="row">
        <div class="col-12 text-center">
            <p class="m-auto">©  2024 | All Rights Reserved | Developed <i class="fa-solid fa-heart"></i> with Volha Hatalskaya</p>

        </div>
    </div>
</footer>
<script src="js/bootstrap.bundle.js"></script>

<script>

    document.addEventListener("DOMContentLoaded", function() {

        CKEDITOR.replace('exampleFormControlTextarea1');
    });
</script>
<script src="js/ajax.js"></script>
</body>
</html>
