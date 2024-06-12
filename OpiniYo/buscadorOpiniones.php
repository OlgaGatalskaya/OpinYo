<?php include 'func.php';
global $db;
$limit = 4;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

$sql2 = "SELECT count(IDOpinion) as total FROM opinion";
$objeto2 = $db->Execute($sql2);
$resultado2 = [];
if ($objeto2 -> RecordCount() > 0){
    while (!$objeto2 -> EOF){
        $total = $objeto2->fields["total"];
        $resultado2 [] = [
            "total" =>  $total,
        ];
        $objeto2->MoveNext();
    }
    $objeto2->Close();
}
$total = $resultado2[0]['total'];
$pages = ceil($total/$limit);
if ($page >= $pages) {
    $Next = $page; // Задаем, что следующая страница не изменяет текущую
}
$Previous = $page - 1;
$Next = $page + 1;

if (isset($_POST['btn-buscadorOpiniones'])) {
    $elementoBuscado  = $_POST['elementoBuscado'];

    $buscador = mysqli_real_escape_string($db->cnx, $elementoBuscado);
    $buscador = strtolower($buscador);
    $_SESSION['buscador'] = $buscador;
    $todas_opiniones = buscasOpinion($buscador, $start, $limit);


}

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
                <li class="breadcrumb-item active" aria-current="page">Todas opiniones</li>
            </ol>
        </nav>
        <h2>Todas las opiniones</h2>
        <p>Una lista de las reseñas más recientes sobre productos de todos las categorias que han sido escritas por los usuarios.</p>
    </div>
</section>

<section class="section-tOpiniones pt-5 pb-5">
    <div class="container">
        <div class="row">
            <div class="columna-categorias d-none d-lg-block col-lg-4">
                <div class="cards-div">
                    <?php
                    $categorias_subcategorias = categorias_subcategorias();
                    foreach ($categorias_subcategorias as $categoria) { ?>
                        <div class="card mb-3 p-3" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title"><?php print $categoria['NombreCategoria']; ?></h5>
                                <div class="links d-flex flex-column">
                                    <?php foreach ($categoria['Subcategorias'] as $subcategoria) { ?>
                                        <a href="subcategoria.php?IDSubcategoria=<?php print $subcategoria['IDSubcategoria']?>" class="card-link m-0"><?php print $subcategoria['NombreSubcategoria']; ?></a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php }?>
                </div>
            </div>

            <div class="columna-opiniones col-12 col-lg-8">
                <div class="row mb-3">
                    <div class="links-subcategorias fs-5 w-100">
                        <?php
                        $resultado = todas_categorias();
                        foreach
                        ($resultado as $categoria) { ?>
                            <a href="categoria.php?IDCategoria=<?php print $categoria['IDCategoria']?>" class="card-link m-0 me-2 pe-md-3 "><?php print $categoria['NombreCategoria'] ?></a>
                        <?php } ?>

                    </div>
                </div>
                <?php if(count($todas_opiniones) > 0) { ?>
                    <div class="row title mb-3">
                        <div class="col-12">
                            <div class=" row justify-content-between ">
                                <p class="col-12 col-sm-4 col-md-6 col-lg-6 title-filtr mb-0">Opiniones</p>
                                <div class="col-12 col-sm-8 col-md-6 col-lg-6 divFiltr row align-items-center">
                                    <div class="row align-items-center">
                                        <div class="col-3 "><p class="">Ordenar:</p></div>
                                        <div class="col-9">
                                            <div class="row text-end">
                                                <div class="col-5">
                                                    <button data-type="fecha" type="button" id="fFecha" class="btn btn-link filtr p-0">por fecha</button>
                                                </div>
                                                <div class="col-7">
                                                    <button data-type="puntuacion" type="button" id="fPuntuacion" class="btn btn-link filtr p-0">por puntuación</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- todas las opiniones -->

                    <div class="cards" id="cards">
                        <?php
                        foreach ($todas_opiniones as $opinion) { ?>

                            <div class="card div-producto p-3 mb-3 p-md-4" id="card">
                                <div class="row">
                                    <h5 class="col-12 card-title"><?php print $opinion['NombreProducto'] ?></h5>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-2 me-md-3 c-img"><img src="imgProductos/<?php print $opinion['ImagenProducto'] ?>" alt="producto"></div>
                                    <div class="col-8 col-md-8">
                                        <div class="row mb-2">
                                            <!--<div class="col-4"><img w-100 src="img/Ellipse 1.png" alt=""></div>-->
                                            <div class="d-flex justify-content-between flex-column">
                                                <div class="rating rating-set d-flex align-items-end">
                                                    <div class="rating-body text-dark">
                                                        <div class="rating-active"></div>
                                                    </div>
                                                    <div class="rating-value text-dark d-none"><?php print $opinion['Rating'] ?></div>
                                                </div>
                                                <div class="fs-5 fw-bold"><?php print $opinion['LoginUsuario'] ?></div>
                                            </div>
                                        </div>
                                        <div class="row"><hr></div>
                                        <div class=""><?php print $opinion['FechaOpinion'] ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 text-carusel1 comentario text-block">
                                            <?php print $opinion['ComentarioOpinion'] ?>
                                            <a href="leerTodaOpinion.php?IDOpinion=<?php print $opinion['IDOpinion'] ?>" class="block-text-more">Leer toda la opinion</a></div>
                                    </div>
                                </div>
                            </div>

                        <?php } ?>

                    </div>

                    <?php if(count($todas_opiniones) > 4){?>
                    <div class="pagination d-flex justify-content-center">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                                <li class="page-item disabled">
                                    <a class="page-link" href="buscadorOpiniones.php?page=<?php print $Previous ?>" tabindex="-1" aria-disabled="true">Anterior</a>
                                </li>
                                <?php for($i = 1; $i <= $pages; $i++) { ?>
                                    <li class="page-item"><a class="page-link" href="buscadorOpiniones.php?page=<?php print $i ?>"><?php print $i ?></a></li>
                                <?php } ?>
                                <li class="page-item">
                                    <a class="page-link" href="buscadorOpiniones.php?page=<?php print $Next ?>">Siguiente</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                        <?php } ?>
                <?php } else { ?>
                    <div class="card">
                        <div class="card-header">
                            ¡Ups!
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">¡Parece que este producto aún no tiene opiniones!</h5>
                            <p class="card-text">Sé el primero en compartir tu experiencia y ayudar a otros usuarios con tu reseña.</p>
                        </div>
                    </div>

                <?php } ?>
            </div>
        </div>
    </div>

</section>

<footer class="footer p-4">
    <div class="row">
        <div class="col-12 text-center">
            <p class="m-auto">©  2023 | All Rights Reserved | Developed <i class="fa-solid fa-heart"></i> with Volha Hatalskaya</p>

        </div>
    </div>
</footer>
<script src="js/bootstrap.bundle.js"></script>
<script src="js/filtrarBuscados.js"></script>
<script src="js/stars.js"></script>





</body>
</html>
