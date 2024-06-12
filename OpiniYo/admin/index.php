<?php
include '../func.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/d50d610183.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/variables.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/admin.css">

    <title>Panel administrativa</title>
</head>
<body class="admin-body d-flex align-items-center">
    <div class="container d-flex justify-content-center">
        <div class="admin-container ">
            <form action="admin.php" method="post" class="form form-admin">
                <div class="text-center ">
                    <h4 class="text-white">Hola.</h4>
                    <p class="text-white">¡Nos alegra volver a verte por aquí!</p>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control text-dark" id="floatingInput" placeholder="name@example.com" name="email" required>
                    <label for="floatingInput">Correo electrónico</label>

                </div>
                <div class="form-floating mb-4">
                    <input type="password" class="form-control text-dark" id="floatingPassword" placeholder="Password" name="password" required>
                    <label for="floatingPassword">Contraseña</label>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary w-100" name="submit">LOGIN</button>
                </div>

            </form>
        </div>
        <!-- Модальное окно ошибки входа -->
        <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="errorModalLabel">Error</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>No existe administrador con este login o email</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <?php if (isset($_SESSION['error']) && $_SESSION['error'] == true) { ?>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    let errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                    errorModal.show();
                });
            </script>
            <?php unset($_SESSION['error']); ?>
        <?php } ?>
    </div>

    <script src="../js/bootstrap.bundle.js"></script>

</body>
</html>



