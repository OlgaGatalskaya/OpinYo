
    <header class="header pt-md-3 pb-md-3">
        <div class="container">
            <div class="row">
                <nav class="navbar navbar-expand-lg">
                    <div class="container-fluid">
                        <div class="col-lg-2">
                            <a class="navbar-brand" href="index.php">Opini<span>Yo</span></a>
                        </div>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class=""><i class="fa-solid fa-bars fa-lg" style="color: #ffffff;"></i></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <div class="col-lg-7">
                                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                    <?php
                                    global $db;
                                    $sql = "SELECT * FROM navmenu ORDER BY OrdenNavmenu ASC";
                                    $object = $db -> Execute($sql);
                                    if($object -> RecordCount() > 0){
                                        while(!$object -> EOF){
                                            $IDNavMenu = $object->fields["IDNavmenu"];
                                            $NombreNavMenu = $object->fields["NombreNavmenu"];
                                            $URLNavMenu = $object->fields["UrlNavmenu"];
                                            $OrdenNavMenu = $object->fields["OrdenNavmenu"];
                                    ?>
                                    <li class="nav-item">
                                        <a class="nav-link underline-one" href="<?php print $URLNavMenu ?>"><?php print $NombreNavMenu ?></a>
                                    </li>
                                    <?php
										$object->MoveNext();

                                        }
                                    }
                                            $object->Close();
                                    ?>

                                </ul>
                            </div>
                            <div class="col-lg-4 me-4">
                                <form class="d-flex" role="search" method="post" action="buscadorOpiniones.php">
                                    <input class="form-control me-1" type="search" placeholder="Buscar" aria-label="Search" name="elementoBuscado">
                                    <button class="btn btn-outline-success btn-search" type="submit" name="btn-buscadorOpiniones">Buscar</button>
                                </form>
                            </div>
                            <div class="collapse navbar-collapse col-1 " id="navbarSupportedContent">
                                <div class="col-lg-2">

                                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                                            <?php if (revisarEstado()){?>
                                                <li class="nav-item dropdown">
                                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa-regular fa-circle-user" style="color: #74C0FC;"></i> <?php print usuarioDatos()['login'];?>
                                                    </a>

                                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                    <li><a class="dropdown-item" href="autorizacion.php">Perfil</a></li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item" href="autorizacion.php?action=exit">Salir</a></li>
                                                </ul>
                                                </li>

                                            <?php } else { ?>

                                            <li class="nav-item">
                                                <a class="nav-link " href="autorizacion.php">Entrar</a>
                                            </li>
                                            <?php } ?>

                                    </ul>
                                </div>

                            </div>

                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </header>



