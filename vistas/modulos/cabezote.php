<header class="main-header">
    <!--=====================================
                   LOGOTIPO
    ======================================-->
    <a href="inicio" class="logo">
        <!-- logo mini -->
        <span class="logo-mini">
            <img class="img-responsive" style="padding:10px">
        </span>
 
        <!-- logo normal -->
        <span class="logo-lg">
            <img src="vistas/img/plantilla/logoo.png" class="img-responsive" style="width: 70%;">
 
        </span>
    </a>
    
    <!-- BARRA DE NAVEGACIÓN -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a href="#" class="navbar-toggler-icon" data-toggle="push-menu" role="button" ></a>
            
            <div class="navbar-custom-menu " id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class=" dropdown">
                        <a  class="nav-link dropdown-toggle d-flex align-items-center" 
                            href="#" 
                            role="button" 
                            data-toggle="dropdown" 
                            aria-expanded="false">

                            <?php                         
                                echo '<img src="'.$_SESSION["foto"].'" class="rounded-circle" height="40" alt="Avatar" loading="lazy">';
                            ?>
                            <span class="hidden-xs">
                                    <?php  
                                        echo $_SESSION["nombre"]; 
                                    ?>
                            </span>
                        </a>
                        <ul class="dropdown-menu " aria-labelledby="navbarDropdownMenuLink">
                            <li>
                                <div class="card-body">
                                    <div class="">
                                        <?php                         
                                            if($_SESSION["foto"] != ""){
                                                echo '<img src="'.$_SESSION["foto"].'" class="rounder align-center" height="160" alt="Avatar" loading="lazy">';
                                            }
                                        ?>
                                    </div>
                                    <div>
                                        <h4><?php echo ucfirst($_SESSION['nombre']); ?></h4>
                                        <p class="text-muted">
                                            <?php echo ($_SESSION['perfil']) ?>
                                        </p>
                                        <a href="#" class="btn btn-dark">
                                            Ver perfil
                                        </a>
                                    </div>         
                                </div>
                            </li>
                            <li>
                                <div class="dropdown-divider"></div>
                                <a href="salir" class="dropdown-item">
                                    Salir
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
