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
    <link rel="stylesheet" href="css/footer.css">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon.png">
    <title>Opinion2</title>
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="row">
                <nav class="navbar navbar-expand-lg">
                    <div class="container-fluid">
                        <div class="col-lg-2">
                            <a class="navbar-brand" href="#">Opini<span>Yo</span></a>
                        </div>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class=""><i class="fa-solid fa-bars fa-lg" style="color: #ffffff;"></i></span> 
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <div class="col-lg-8">
                                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                    <li class="nav-item">
                                        <a class="nav-link active" aria-current="page" href="#">Inicio</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Todas opiniones</a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link" href="#" >
                                            Añadir opinion
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Entrar</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-4">
                                <form class="d-flex" role="search">
                                    <input class="form-control me-1" type="search" placeholder="Buscar" aria-label="Search">
                                    <button class="btn btn-outline-success btn-search" type="submit">Buscar</button>
                                </form>
                            </div>
                        
                        </div>
                    </div>
                </nav>
            </div>
        </div> 
    </header>

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

    <section class="opinion pt-5">
        <div class="container">
            <button class="btn btn-an-opinion mb-3">Anadir opinion nueva</button>
            <div class="card w-100" >
                <div class="card-body">
                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                        <ol class="breadcrumb mb-3 breadcrumb-pasos">
                            <li class="breadcrumb-item active"><a href="#">Paso 1. seleccione una categoría </a></li>
                            <li class="breadcrumb-item " aria-current="page"> Paso 2. añada un producto, servicio o prestación</li>
                            <li class="breadcrumb-item " aria-current="page"> Paso 3. escriba una opinión</li>
                        </ol>
                    </nav>
                    <p>Encontrar categoria</p>
                    <form class="d-flex mb-5" role="search">
                        <input class="form-control me-1" type="search" placeholder="Introduzca algunas letras" aria-label="Search">
                        <button class="btn btn-outline-success btn-search" type="submit">Buscar</button>
                    </form>
                    
                    <hr>

                    <div class="columna-categorias d-none d-lg-block col-lg-4">
                        <div class="cards-div">
                            <div class="card mb-3 p-3" style="width: 18rem">
                                <div class="card-body">
                                    <h5 class="card-title">Belleza</h5>
                                    <div class="links d-flex flex-column">
                                        <a href="#" class="card-link m-0">Subcategoria</a>
                                        <a href="#" class="card-link m-0">Subcategoria</a>
                                        <a href="#" class="card-link m-0">Subcategoria</a>
                                        <a href="#" class="card-link m-0">Subcategoria</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3 p-3" style="width: 18rem;">
                                <div class="card-body">
                                    <h5 class="card-title">Belleza</h5>
                                    <div class="links d-flex flex-column">
                                        <a href="#" class="card-link m-0">Subcategoria</a>
                                        <a href="#" class="card-link m-0">Subcategoria</a>
                                        <a href="#" class="card-link m-0">Subcategoria</a>
                                        <a href="#" class="card-link m-0">Subcategoria</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3 p-3" style="width: 18rem;">
                                <div class="card-body">
                                    <h5 class="card-title">Belleza</h5>
                                    <div class="links d-flex flex-column">
                                        <a href="#" class="card-link m-0">Subcategoria</a>
                                        <a href="#" class="card-link m-0">Subcategoria</a>
                                        <a href="#" class="card-link m-0">Subcategoria</a>
                                        <a href="#" class="card-link m-0">Subcategoria</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3 p-3" style="width: 18rem;">
                                <div class="card-body">
                                    <h5 class="card-title">Belleza</h5>
                                    <div class="links d-flex flex-column">
                                        <a href="#" class="card-link m-0">Subcategoria</a>
                                        <a href="#" class="card-link m-0">Subcategoria</a>
                                        <a href="#" class="card-link m-0">Subcategoria</a>
                                        <a href="#" class="card-link m-0">Subcategoria</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3 p-3" style="width: 18rem;">
                                <div class="card-body">
                                    <h5 class="card-title">Belleza</h5>
                                    <div class="links d-flex flex-column">
                                        <a href="#" class="card-link m-0">Subcategoria</a>
                                        <a href="#" class="card-link m-0">Subcategoria</a>
                                        <a href="#" class="card-link m-0">Subcategoria</a>
                                        <a href="#" class="card-link m-0">Subcategoria</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3 p-3" style="width: 18rem;">
                                <div class="card-body">
                                    <h5 class="card-title">Belleza</h5>
                                    <div class="links d-flex flex-column">
                                        <a href="#" class="card-link m-0">Subcategoria</a>
                                        <a href="#" class="card-link m-0">Subcategoria</a>
                                        <a href="#" class="card-link m-0">Subcategoria</a>
                                        <a href="#" class="card-link m-0">Subcategoria</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
    
                    </div>
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
</body>
</html>