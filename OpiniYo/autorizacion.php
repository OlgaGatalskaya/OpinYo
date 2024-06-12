<?php
require_once('func.php');

$aFormHandlerResult = [];

// si formulario esta rellenado
if (!empty($_POST['sign-in']) || !empty($_POST['sign-up']))
{
    //para autorización
    if (!empty($_POST['sign-in']))
    {
        $aFormHandlerResult = usuarioAutenticado($_POST);
    }
    //para reguistrarse
    elseif (!empty($_POST['sign-up']))
    {
        $aFormHandlerResult = usuarioRegistrado($_POST);
    }
}

//si el usuario quire salir
if (!empty($_GET['action']) && $_GET['action'] == "exit" && revisarEstado())
{
    usuarioLogout();
}

$sLogin = (!empty($aFormHandlerResult['data']['login'])) ? htmlspecialchars_decode($aFormHandlerResult['data']['login']) : "";
$sEmail = (!empty($aFormHandlerResult['data']['email'])) ? htmlspecialchars_decode($aFormHandlerResult['data']['email']) : "";
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/d50d610183.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/variables.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/tOpiniones.css">
    <link rel="stylesheet" href="css/autorizacion.css">
    <link rel="stylesheet" href="css/paginaPrincipal.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon.png">

    <title>Autorización</title>

</head>

<body >
<?php include 'header.php'?>


<?php if(revisarEstado()) { ?>
<section class="sectionNav">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Perfil</li>
            </ol>
        </nav>
    </div>
</section>
<section class="section-autorizacion">
    <div class="container pt-5 pb-5 perfil">

        <div class="card w-75">
            <h3 class="card-header pt-3 pb-3">Mi perfil</h3>
            <div class="card-body">

                <?php print "<p class='fs-5'>Su login es: <strong>" . usuarioDatos()['login'] . "</strong>.</p>";?>

                <p> <?php print (revisarEstado()) ? "Usted está autorizado" : "Para dejar su opinion tiene que registrarse";?> en la página. <br /> </p>

                <?php print "<p>Usted puede <a href='autorizacion.php?action=exit'>salir</a> de su perfil.</p>"; ?>

            </div>
        </div>


        <?php } ?>
    </div>
</section>
           <?php  if (!empty($aFormHandlerResult['success']) && $aFormHandlerResult['success'] === TRUE)
            {
                ?>
                <script>
                    /*setTimeout(() => {
                        window.location.href="/";
                    }, 3000);*/
                </script>
                <?php
            }
            ?>

        <?php
        // bloque con los formularios
        if (!revisarEstado())
        {?>
            <section class="sectionNav">
                <div class="container">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Autorización</li>
                        </ol>
                    </nav>
                </div>
            </section>
        <section class="section-autorizacion overflow-auto">
            <div class="container pt-5 pb-5 perfil">
            <ul class="nav nav-tabs my-3 tabs-titles" id="user-action-tabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link tab-title <?php print (empty($aFormHandlerResult) || $aFormHandlerResult['type'] == 'auth') ? "active" : "";?>" id="user-auth-tab" data-bs-toggle="tab" data-bs-target="#user-auth-tab-pane" type="button" role="tab" aria-controls="user-auth-tab-pane" aria-selected="true">Autorización</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link tab-title  <?php print (!empty($aFormHandlerResult) && $aFormHandlerResult['type'] == 'reg') ? "active" : "";?>" id="user-reg-tab" data-bs-toggle="tab" data-bs-target="#user-reg-tab-pane" type="button" role="tab" aria-controls="user-reg-tab-pane" aria-selected="false">Registro</button>
                </li>
            </ul>
            <div class="tab-content pb-5" id="user-action-tabs-content">
                <div class="tab-pane fade px-3 <?php print (empty($aFormHandlerResult) || $aFormHandlerResult['type'] == 'auth') ? "show active" : "";?>" id="user-auth-tab-pane" role="tabpanel" aria-labelledby="user-auth-tab-pane" tabindex="0">
                    <div class="row">
                        <div class="col-xxl-8 col-md-10 rounded text-dark p-3 bg-light">
                            <?php
                            if (!empty($aFormHandlerResult) && $aFormHandlerResult['type'] == 'auth')
                            {
                                if ($aFormHandlerResult['success']) {
                                    $sClass = "my-3 alert alert-success";
                                } else {
                                    $sClass = "my-3 alert alert-danger";
                                }
                                ?>
                                <div class="<?=$sClass?>">
                                    <?=$aFormHandlerResult['message'];?>
                                </div>
                                <?php
                            }
                            ?>
                            <h3 class="my-3">Autorización del usuario</h3>
                            <form id="form-auth" class="needs-validation" name="form-auth" action="autorizacion.php" method="post" autocomplete="off" novalidate>
                                <div class="my-3 mb-4">
                                    <label for="auth-login" class="mb-2">Login o correo electrónico:</label>
                                    <input type="text" id="auth-login" name="login" class="form-control" placeholder="Su login o correo electrónico" required value="<?php print (empty($aFormHandlerResult) || $aFormHandlerResult['type'] == 'auth') ? $sLogin : "";?>" />
                                    <div class="error invalid-feedback" id="auth-login_error"></div>

                                </div>
                                <div class="my-3">
                                    <label for="auth-password" class="mb-2">Contraseña:</label>
                                    <input type="password" id="auth-password" name="password" class="form-control" placeholder="Escriba su contraseña" required />
                                    <div class="error invalid-feedback" id="auth-password_error"></div>

                                </div>
                                <div class="my-3">
                                    <input type="submit" class="btn btn-primary btn-index-tOpinion" id="auth-submit" name="sign-in" value="Entrar" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade px-3 <?php print (!empty($aFormHandlerResult) && $aFormHandlerResult['type'] == 'reg') ? "show active" : "";?>" id="user-reg-tab-pane" role="tabpanel" aria-labelledby="user-reg-tab-pane" tabindex="0">
                    <div class="row">
                        <div class="col-xxl-8 col-md-10 rounded text-dark p-3 bg-light">
                            <?php
                            if (!empty($aFormHandlerResult) && $aFormHandlerResult['type'] == 'reg')
                            {

                                if ($aFormHandlerResult['success']) {
                                    $sClass = "my-3 alert alert-success";
                                } else {
                                    $sClass = "my-3 alert alert-danger";
                                }

                                ?>
                                <div class="<?=$sClass?>">
                                    <?=$aFormHandlerResult['message'];?>
                                </div>
                                <?php
                            }
                            ?>
                            <h3 class="my-3">Registro del usuario</h3>
                            <form id="form-reg" class="needs-validation" name="form-reg" action="autorizacion.php" method="post" autocomplete="off" novalidate>
                                <div class="row gy-2 mb-3">
                                    <div class="col-md">
                                        <label for="reg-login" class="mb-2">Login:</label>
                                        <input type="text" id="reg-login" name="login" class="form-control" placeholder="Su login para registrarse" required value="<?php print (!empty($aFormHandlerResult) && $aFormHandlerResult['type'] == 'reg') ? $sLogin : "";?>" />
                                        <div class="error invalid-feedback" id="reg-login_error">Login introducido incorrectamente</div>
                                    </div>
                                    <div class="col-md">
                                        <label for="reg-email" class="mb-2">Correo electrónico:</label>
                                        <input type="email" id="reg-email" name="email" class="form-control" placeholder="Su correo electrónico" required value="<?php print (!empty($aFormHandlerResult) && $aFormHandlerResult['type'] == 'reg') ? $sEmail : "";?>" />
                                        <div class="error invalid-feedback" id="reg-email_error"></div>
                                    </div>
                                </div>
                                <div class="row gy-2 mb-3">
                                    <div class="col-md">
                                        <label for="reg-password" class="mb-2">Contraseña:</label>
                                        <input type="password" id="reg-password" name="password" class="form-control" placeholder="Su contraseña" required />
                                        <div class="error invalid-feedback" id="reg-password_error"></div>

                                    </div>
                                    <div class="col-md">
                                        <label for="reg-password2" class="mb-2">Confirmación de contraseña:</label>
                                        <input type="password" id="reg-password2" name="password2" class="form-control" placeholder="Repita su contraseña" required />
                                        <div class="error invalid-feedback" id="reg-password2_error"></div>
                                    </div>
                                </div>
                                <div class="my-3 d-flex">
                                    <input type="submit" class="btn btn-success me-3 btn-index-tOpinion" id="reg-submit" name="sign-up" value="Registrarse" />
                                    <input type="reset" class="btn btn-danger btn-borrar-aut" id="reg-reset" name="reset" value="Borrar" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

    </div>

</section>
            <?php
        }
        ?>
<footer class="footer fixed-bottom p-4 text-white">
    <div class="row">
        <div class="col-12 text-center">
            <p class="m-auto">©  2024 | All Rights Reserved | Developed <i class="fa-solid fa-heart"></i> with Volha Hatalskaya</p>

        </div>
    </div>
</footer>

<script>
    (() => {
        'use strict'
        document.addEventListener('DOMContentLoaded', (event) => {
            let forms = document.querySelectorAll('.needs-validation');

            if (forms)
            {
                Array.from(forms).forEach(form => {
                    form.addEventListener('submit', event => {
                        if (!form.checkValidity()) {
                            event.preventDefault();
                            event.stopPropagation();
                        }

                        form.classList.add('was-validated')
                    }, false);
                });
            }
        });
    })();
</script>
<script src="js/bootstrap.bundle.js"></script>

</body>
</html>
