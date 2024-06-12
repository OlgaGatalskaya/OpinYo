<?php
include 'func.php';

global $db;

if (isset($_GET["IDCategoria"])) {
    $IDCategoria = intval($_GET["IDCategoria"]);
}

$sql = "SELECT * FROM categoria cat
        JOIN subcategoria sub ON sub.CategoriaSubcategoria = cat.IDCategoria
        WHERE IDCategoria = " . $IDCategoria;
$objeto = $db->Execute($sql);
$resultado = [];
if($objeto -> RecordCount() > 0){
    while (!$objeto ->EOF){
        $IDCategoria = $objeto ->fields["IDCategoria"];
        $NombreCategoria = $objeto ->fields["NombreCategoria"];
        $IDSubcategoria = $objeto ->fields["IDSubcategoria"];
        $NombreSubcategoria = $objeto ->fields["NombreSubcategoria"];
        $resultado [] = [

            "IDCategoria" => $IDCategoria,
            "NombreCategoria" =>  $NombreCategoria,
            "IDSubcategoria" => $IDSubcategoria,
            "NombreSubcategoria" => $NombreSubcategoria,
        ];


        $objeto->MoveNext();
    }

    $objeto->Close();
}
//SELECT COUNT(*) FROM my_table;
$limit = 4;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

$sql2 = "SELECT count(IDOpinion) as total FROM opinion o
         JOIN producto pr ON pr.IDProducto = o.ProductoOpinion
         JOIN usuario u ON u.IDUsuario = o.UsuarioOpinion
         JOIN subcategoria sc ON sc.IDSubcategoria = pr.SubcategoriaProducto
         JOIN categoria cat ON cat.IDCategoria = sc.CategoriaSubcategoria
         WHERE cat.IDCategoria = $IDCategoria";

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

$showPagination = $pages > 1;

$Previous = max(1, $page - 1);
$Next = min($page + 1, $pages);


$previousDisabled = ($page <= 1) ? 'disabled' : '';
$nextDisabled = ($page >= $pages) ? 'disabled' : '';


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
    <title>Categoria</title>
</head>
<body>

<?php include 'header.php'?>

    <section class="sectionNav">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="todasOpiniones.php">Todas las opiniones</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php print $resultado[0]['NombreCategoria'] ?></li>
                </ol>
            </nav>
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
                        <h2><?php print $resultado[0]['NombreCategoria'] ?></h2>
                    </div>
                    <div class="row">
                        <hr>
                    </div>
                    <div class="row mb-3">
                        <div class="links-subcategorias">
                            <?php foreach ($resultado as $subcategoria) { ?>
                                <a href="subcategoria.php?IDSubcategoria=<?php print $subcategoria['IDSubcategoria']?>" class="card-link m-0 me-2"><?php print $subcategoria['NombreSubcategoria'] ?></a>
                            <?php } ?>

                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="fs-5 fw-bold">Total opiniones: <?php print $numTotalOpiniones = (calcularTotalOpinienesCategoria($IDCategoria)); ?></div>
                    </div>
                    <div class="cards" id="cards">
                        <?php $todas_opiniones = todas_opinionesCategoria($IDCategoria, $start, $limit);
                        shuffle($todas_opiniones);
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
                                            <div class="d-flex flex-column">
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
                    <?php if($showPagination){ ?>
                        <div class="pagination d-flex justify-content-center">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center">
                                    <li class="page-item <?= $previousDisabled ?>">
                                        <a class="page-link" href="categoria.php?IDCategoria=<?= $resultado[0]['IDCategoria'] ?>&page=<?= $Previous ?>" tabindex="-1">Anterior</a>
                                    </li>
                                    <?php for($i = 1; $i <= $pages; $i++) { ?>
                                        <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                                            <a class="page-link" href="categoria.php?IDCategoria=<?= $resultado[0]['IDCategoria'] ?>&page=<?= $i ?>"><?= $i ?></a>
                                        </li>
                                    <?php } ?>
                                    <li class="page-item <?= $nextDisabled ?>">
                                        <a class="page-link" href="categoria.php?IDCategoria=<?= $resultado[0]['IDCategoria'] ?>&page=<?= $Next ?>">Siguiente</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    <?php  } ?>
                </div>
            </div>
        </div>
        
    </section>
<footer class="footer p-4 text-white">
    <div class="row">
        <div class="col-12 text-center">
            <p class="m-auto">©  2024 | All Rights Reserved | Developed <i class="fa-solid fa-heart"></i> with Volha Hatalskaya</p>

        </div>
    </div>
</footer>
<script src="js/bootstrap.bundle.js"></script>
<script src="js/stars.js"></script>
</body>
</html>