<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <!-- Messages Dropdown Menu -->
            <a class="nav-link text-primary" title="Editar Perfil de Usuario" href="panel.php?modulo=perfilUsuario">
                <i class="fas fa-user"></i>
            </a>
            <a class="nav-link text-danger" href="panel.php?modulo=cerrar" title="Cerrar sesion">
                <i class="fas fa-sign-out-alt"></i>
            </a>
        </ul>
    </nav>
    <!-- /.navbar -->


    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="panel.php" class="brand-link">
            <img src="images/logo.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Panel de Control</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="dist/img/usuario.png" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="panel.php?modulo=perfilUsuario" title="Perfin de Usuario" class="d-block"><?php echo $_SESSION['nombre']; ?></a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                    <li class="nav-item has-treeview menu-open">
                        <a href="#" class="nav-link active">
                            <i class="fas fa-list nav-icon" aria-hidden="true"></i>
                            <p>
                                Menú
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="panel.php?modulo=inicio" class="nav-link <?php echo ($modulo == "inicio" || $modulo == "") ? " active " : " "; ?>">
                                    <i class="fa fa-chart-bar nav-icon" aria-hidden="true"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link <?php echo ($modulo == "movimientos" || $modulo == "flujocaja" || $modulo == "caja") ? " active " : " "; ?>">
                                    <i class="nav-icon fas fa-cash-register"></i>
                                    <p>
                                        Flujo de Caja
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview ml-3">
                                    <li class="nav-item">
                                        <a href="panel.php?modulo=movimientos" class="nav-link <?php echo ($modulo == "movimientos") ? " active " : " "; ?>">
                                            <i class="fas fa-exchange-alt nav-icon" aria-hidden="true"></i>
                                            <p>Movimientos</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="panel.php?modulo=caja" class="nav-link <?php echo ($modulo == "caja") ? " active " : " "; ?>">
                                            <i class="fas fa-money-bill nav-icon" aria-hidden="true"></i>
                                            <p>Caja</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="panel.php?modulo=flujocaja" class="nav-link <?php echo ($modulo == "flujocaja") ? " active " : " "; ?>">
                                            <i class="fas fa-chart-line nav-icon" aria-hidden="true"></i>
                                            <p>Flujo</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item">
                                <a href="panel.php?modulo=proveedores" class="nav-link <?php echo ($modulo == "proveedores") ? " active " : " "; ?>">
                                    <i class="ion ion-person nav-icon" aria-hidden="true"></i>
                                    <p>Proveedores</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="panel.php?modulo=clientes" class="nav-link <?php echo ($modulo == "clientes") ? " active " : " "; ?>">
                                    <i class="fas fa-user-circle nav-icon" aria-hidden="true"></i>
                                    <p>Clientes</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="panel.php?modulo=trabajadores" class="nav-link <?php echo ($modulo == "trabajadores") ? " active " : " "; ?>">
                                    <i class="ion ion-ios-people nav-icon" aria-hidden="true"></i>
                                    <p>Trabajadores</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="panel.php?modulo=insumos" class="nav-link <?php echo ($modulo == "insumos") ? " active " : " "; ?>">
                                    <i class="fas fa-flask nav-icon" aria-hidden="true"></i>
                                    <p>Insumos</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="panel.php?modulo=plantas" class="nav-link <?php echo ($modulo == "plantas") ? " active " : " "; ?>">
                                    <i class="fas fa-seedling nav-icon" aria-hidden="true"></i>
                                    <p>Plantas</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="panel.php?modulo=compras" class="nav-link <?php echo ($modulo == "compras" || $modulo == "generar-compra") ? " active " : " "; ?>">
                                    <i class="fas fa-shopping-cart nav-icon" aria-hidden="true"></i>
                                    <p>Compras</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="panel.php?modulo=ventas" class="nav-link <?php echo ($modulo == "ventas") ? " active " : " "; ?>">
                                    <i class="fas fa-shopping-basket nav-icon" aria-hidden="true"></i>
                                    <p>Ventas</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link <?php echo ($modulo == "tipoactividades" || $modulo == "actividades" || $modulo == "gestion-actividades" || $modulo == "control-actividades") ? " active " : " "; ?>">
                                    <i class="nav-icon fas fa-paste"></i>
                                    <p>
                                        Gestión de Actividad
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview ml-3">
                                    <li class="nav-item">
                                        <a href="panel.php?modulo=tipoactividades" class="nav-link <?php echo ($modulo == "tipoactividades") ? " active " : " "; ?>">
                                            <i class="fas fa-clipboard-list nav-icon" aria-hidden="true"></i>
                                            <p>Tipo de Actividades</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="panel.php?modulo=actividades" class="nav-link <?php echo ($modulo == "actividades") ? " active " : " "; ?>">
                                            <i class="fas fa-book nav-icon" aria-hidden="true"></i>
                                            <p>Actividades</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="panel.php?modulo=gestion-actividades" class="nav-link <?php echo ($modulo == "gestion-actividades") ? " active " : " "; ?>">
                                            <i class="fas fa-list-ul nav-icon" aria-hidden="true"></i>
                                            <p>Gestionar Actividad</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="panel.php?modulo=control-actividades" class="nav-link <?php echo ($modulo == "control-actividades") ? " active " : " "; ?>">
                                            <i class="fas fa-bars nav-icon" aria-hidden="true"></i>
                                            <p>Control Actividad</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link <?php echo ($modulo == "fases" || $modulo == "generar-produccion" || $modulo == "control-produccion" || $modulo == "planta-produccion" || $modulo == "control-perdida") ? " active " : " "; ?>">
                                    <i class="fas fa-tractor nav-icon" aria-hidden="true"></i>
                                    <p>Producción
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>

                                <ul class="nav nav-treeview ml-3">
                                    <li class="nav-item">
                                        <a href="panel.php?modulo=fases" class="nav-link <?php echo ($modulo == "fases") ? " active " : " "; ?>">
                                            <i class="fas fa-arrow-circle-right nav-icon" aria-hidden="true"></i>
                                            <p>Fases</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="panel.php?modulo=generar-produccion" class="nav-link <?php echo ($modulo == "generar-produccion") ? " active " : " "; ?>">
                                            <i class="fas fa-sitemap nav-icon" aria-hidden="true"></i>
                                            <p>Generar Producción</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="panel.php?modulo=control-produccion" class="nav-link <?php echo ($modulo == "control-produccion") ? " active " : " "; ?>">
                                            <i class="fas fa-project-diagram nav-icon" aria-hidden="true"></i>
                                            <p>Control Producción</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="panel.php?modulo=planta-produccion" class="nav-link <?php echo ($modulo == "planta-produccion") ? " active " : " "; ?>">
                                            <i class="fas fa-leaf nav-icon" aria-hidden="true"></i>
                                            <p>Inventario</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="panel.php?modulo=control-perdida" class="nav-link <?php echo ($modulo == "control-perdida") ? " active " : " "; ?>">
                                            <i class="fas fa-exclamation-triangle nav-icon" aria-hidden="true"></i>
                                            <p>Control Pérdida</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
</div>