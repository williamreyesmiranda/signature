<!-- Preloader -->
<!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="../img/expertosip-logo.svg" alt="AdminLTELogo" width="300">
</div> -->



<nav class="main-header navbar navbar-expand navbar-dark">

    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>


    <ul class="navbar-nav ml-auto ">
        <li class="nav-item my-auto" style="padding-left: 15px;">
           
                <?php echo ($_SESSION['nombre']) ?>
           

        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button" title="Pantalla Completa">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../db/logout.php" title="Salir">
                <i class="fas fa-sign-out-alt"></i>
            </a>
        </li>
    </ul>
</nav>




<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="index.php" class="brand-link text-center">
        <img src="../img/expertosip-logo.svg" alt="AdminLTE Logo" class="brand-imageelevation-3" style="opacity: .8" height="30">

    </a>


    <div class="sidebar">


        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                    <a href="registroEntrega.php" class="nav-link">
                    <i class="fas fa-sign-in-alt"></i>
                        <p>Registrar Entrega</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="listaEntregas.php" class="nav-link">
                        <i class="fas fa-table"></i>
                        <p> Entregas</p>
                    </a>
                </li>
                <hr>
                <li class="nav-header">ADMINISTRADOR</li>
                <li class="nav-item">
                    <a href="listaUsuarios.php" class="nav-link">
                    <i class="fas fa-user-friends"></i>
                        <p> Lista Usuarios</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="listaEmpresas.php" class="nav-link">
                    <i class="fas fa-building"></i>
                        <p> Lista Empresas</p>
                    </a>
                </li>
            </ul>
        </nav>

    </div>

</aside>