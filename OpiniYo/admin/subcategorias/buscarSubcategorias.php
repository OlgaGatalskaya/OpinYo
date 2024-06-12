<?php include '../../func.php';

if (!isset($_SESSION['loginAdmin']))
{
    header('Location: ../index.php');
}

global $db;
$limit = 5;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

$sql2 = "SELECT count(IDSubcategoria) as total FROM subcategoria";
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
    $todas_subcategorias = buscarSubcategoria($buscador, $start, $limit);

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/d50d610183.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../css/bootstrap.css">
    <link rel="stylesheet" href="../../css/variables.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/admin.css">
    <title>Subcategoría</title>
</head>
<body class="body">
<?php include '../admin-header.php'?>

<div class="container pt-5 pb-3 pe-0 ps-0">
    <!-- Modal -->
    <div class="modal fade mi-modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Editar Categoría</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="nombreSubcategoria" class="form-label">Nombre de Subcategoria</label>
                            <input type="text" class="form-control mb-3" id="nombreSubcategoria" aria-describedby="nombreHelp" name="nombreSubcategoria" required>
                            <select class="form-select" id="categoria" name="categoria" aria-label="Default select example" required>
                                <option selected>Elige Categoria</option>
                                <?php
                                $categorias = todas_categorias();
                                foreach ($categorias as $categoria) {?>
                                    <option value="<?php print  $categoria['IDCategoria']?>"><?php print $categoria['NombreCategoria'] ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <button type="button" class="btn btn-primary" id="btn-anadir">Añadir cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row ps-3 pe-3 ps-sm-0 pe-sm-0">
        <div class="sidebar col-md-3 col-12 mb-4">
            <ul class="list-group">
                <li class="list-group-item">
                    <a href="../categorias/index.php">Categorias</a>
                </li>
                <li class="list-group-item">
                    <a href="#">Subcategorias</a>
                </li>
                <li class="list-group-item">
                    <a href="../productos/index.php">Productos</a>
                </li>
            </ul>
        </div>
        <div class="col-12 col-md-9">
            <div class="w-100 text-center d-flex justify-content-center mb-4">
                <form class="d-flex w-75" role="search" method="post" action="buscarSubcategorias.php">
                    <input class="form-control me-1" type="search" placeholder="Buscar" aria-label="Search" name="elementoBuscado">
                    <button class="btn btn-outline-success btn-search" type="submit" name="btn-buscadorOpiniones">Buscar</button>
                </form>
            </div>
            <?php if(count($todas_subcategorias) > 0) {?>
            <table class="table col-9 table-hover border shadow p-3 mb-5 bg-body rounded" >
                <thead>
                <tr>
                    <th scope="col" class="nombre p-3">Nombre</th>
                    <th scope="col" class="categoria p-3">Categoría</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody id="tbody">
                <?php

                foreach ($todas_subcategorias as $subcategoria){?>
                    <tr data-id="<?php print $subcategoria['IDSubcategoria'] ?>">
                        <td class="nombreRow p-3 fs-5"><?php print $subcategoria['NombreSubcategoria'] ?></td>
                        <td class="categoriaRow p-3 fs-5"><?php print $subcategoria['NombreCategoria'] ?></td>
                        <td class="text-center"><button id="btn-modificar" class="btn-modificar btn btn-outline-primary" data-id="<?php print $subcategoria['IDSubcategoria'] ?>"><i class="fa-solid fa-file-pen"></i></button></td>
                        <td class="text-center"><button id="btn-borrar" class="btn-borrar btn btn-outline-danger"><i class="fa-solid fa-trash-can"></i></button></td>
                    </tr>
                <?php }
                ?>
                </tbody>
            </table>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Crear elemento +
                </button>
            <?php } else {?>
                <div class="card">
                    <div class="card-body">
                        <p class="card-text fs-4">La Subcategoria buscada no existe</p>
                        <a href="index.php" class="btn btn-primary">Ver todas subcategorias</a>
                    </div>
                </div>
            <?php } ?>


            <div class="row text-center mt-4">
                <?php if(count($todas_subcategorias) > 5){?>
                    <div class="pagination d-flex justify-content-center">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                                <li class="page-item disabled">
                                    <a class="page-link" href="buscarSubcategorias.php?page=<?php print $Previous ?>" tabindex="-1" aria-disabled="true">Anterior</a>
                                </li>
                                <?php for($i = 1; $i <= $pages; $i++) { ?>
                                    <li class="page-item"><a class="page-link" href="buscarSubcategorias.php?page=<?php print $i ?>"><?php print $i ?></a></li>
                                <?php } ?>
                                <li class="page-item">
                                    <a class="page-link" href="buscarSubcategorias.php?page=<?php print $Next ?>">Siguiente</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                <?php } ?>
            </div>
        </div>

    </div>

</div>
<script src="../../js/bootstrap.bundle.js"></script>
<script src="ajax.js"></script>

</body>
</html>

