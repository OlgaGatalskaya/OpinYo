<?php include '../../func.php';

if (!isset($_SESSION['loginAdmin']))
{
    header('Location: ../index.php');
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
    <title>Categoría</title>
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
                                <label for="nombreCategoria" class="form-label">Nombre de categoría</label>
                                <input type="text" class="form-control" id="nombreCategoria" aria-describedby="nombreHelp" name="nombreCategoria" required>
                            </div>

                            <button type="button" class="btn btn-primary" id="btn-añadir">Añadir cambios</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row ps-3 pe-3 ps-sm-0 pe-sm-0">
            <div class="sidebar col-md-3 col-sm-12 mb-4">
                <ul class="list-group">
                    <li class="list-group-item">
                        <a href="#">Categorias</a>
                    </li>
                    <li class="list-group-item">
                        <a href="../subcategorias/index.php">Subcategorias</a>
                    </li>
                    <li class="list-group-item">
                        <a href="../productos/index.php">Productos</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-9 col-sm-12">
                <table class="table col-9 table-hover border shadow p-3 mb-5 bg-body rounded" >
                    <thead >
                    <tr>
                        <th scope="col" class="nombre p-3">Nombre</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody id="tbody">
                    <?php
                        $categorias = todas_categorias();
                        foreach($categorias as $categoria){?>
                            <tr data-id="<?php print $categoria['IDCategoria'] ?>">
                                <td class="nombreRow p-3 fs-5"><?php print $categoria['NombreCategoria'] ?></td>
                                <td class="text-center"><button id="btn-modificar" class="btn-modificar btn btn-outline-primary" data-id="<?php print $categoria['IDCategoria'] ?>"><i class="fa-solid fa-file-pen"></i></button></td>
                                <td class="text-center"><button id="btn-borrar" class="btn-borrar btn btn-outline-danger"><i class="fa-solid fa-trash-can"></i></button></td>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
                <button type="button" class="btn btn-primary admin-btn-crear" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Crear elemento +
                </button>
            </div>

        </div>

    </div>

    <script src="../../js/bootstrap.bundle.js"></script>
    <script src="ajax.js"></script>

</body>
</html>