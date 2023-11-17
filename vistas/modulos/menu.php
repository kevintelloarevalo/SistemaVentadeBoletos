<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">
        <?php
        if($_SESSION["perfil"] == "Administrador"){
            echo'<li class="active">
                <a href="inicio">

                <i class="fa fa-home"></i>

                    <span>Inicio</span>

                </a>

            </li>

            <li>

                <a href="empleados">

                    <i class="fa fa-address-card"></i>

                    <span>Empleados</span>

                </a>

            </li>';

        }

        if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Almacenero"){

            echo'<li class="treeview">    <!-- /.manera arbol -->

                <a href="#">

                    <i class="fa fa-list-ul"></i>        

                    <span>Producción</span>

                    <span class="pull-right-container">    <!-- /.creamos una menu despegable -->

                        <i class="fa fa-angle-left pull-right"></i>

                    </span>

                </a>

                <ul class="treeview-menu">    <!-- /.crear una lista -->

                    <li>

                        <a href="productos">

                            <i class="fa fa-product-hunt"> </i>     <!-- /.lista 1 -->
                            <span>Administrar Entradas</span>

                        </a>

                    </li>

                    <li>

                        <a href="proveedores">

                            <i class="fa fa-bandcamp"> </i>    <!-- /.lista 2 no hay-->
                            <span>Productoras</span>

                        </a>

                    </li>

                    <li>

                        <a href="categorias">

                            <i class="fa fa-bandcamp"> </i>   <!-- /.lista 3 -->
                            <span>Categoria de Boleto</span>

                        </a>

                    </li>


                </ul>

            </li>';

        }



            if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Vendedor"){
                echo '<li>

                <a href="clientes">

                    <i class="fa fa-users"></i>

                    <span>Clientes</span>

                </a>

            </li>';

		    }


        if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Vendedor"){
            
            echo'<li class="treeview">    <!-- /.manera arbol -->

                <a href="#">

                    <i class="fa fa-list-ul"></i>        

                    <span>Boleteria</span>

                    <span class="pull-right-container">    <!-- /.creamos una menu despegable -->

                        <i class="fa fa-angle-left pull-right"></i>

                    </span>

                </a>

                <ul class="treeview-menu">    <!-- /.crear una lista -->

                    <li>

                        <a href="ventas">

                            <i class="fa fa-circle-o"> </i>     <!-- /.lista 1 -->
                            <span>Administrar Ventas</span>

                        </a>

                    </li>

                    <li>

                        <a href="crear-venta">

                            <i class="fa fa-circle-o"> </i>    <!-- /.lista 2 -->
                            <span>Crear Venta</span>

                        </a>

                    </li>';
                    
                    
                    if($_SESSION["perfil"] == "Administrador"){
                    
                    echo'<li>

                        <a href="reportes">

                            <i class="fa fa-circle-o"> </i>   <!-- /.lista 3 -->
                            <span>Reporte de ventas</span>

                        </a>

                    </li>';
                    
                    }

                echo'</ul>

            </li>';

            if($_SESSION["perfil"] == "Administrador"){
            echo'<li>

                <a href="usuarios">

                    <i class="fa fa-user"></i>

                    <span>Usuarios</span>

                </a>

            </li>';

            }
        
        }

        ?>
        </ul>

    </section>

</aside>