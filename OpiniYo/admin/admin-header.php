
<header class="header">
    <div class="container p-sm-0">

            <nav class="navbar navbar-expand d-flex justify-content-between align-items-baseline">

                    <div class=" ">
                        <a class="navbar-brand" href="#">Opini<span>Yo</span></a>
                    </div>


                        <div class=" admin-icono">

                            <ul class="navbar-nav ms-auto  mb-2 mb-lg-0">

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle m-0" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-regular fa-circle-user" style="color: #74C0FC;"></i> <?php if(isset($_SESSION['loginAdmin'])){ print $_SESSION['loginAdmin'];} else {print "usuario sin seción";}?>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="../logout.php">Salir</a></li>
                                    </ul>
                                </li>

                            </ul>
                        </div>


            </nav>

    </div>
</header>


