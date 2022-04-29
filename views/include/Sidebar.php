<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo SERVERURL?> ">
       <!--  <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-cannabis"></i>
        </div>
        <div class="sidebar-brand-text mx-3">S-App <sup>2</sup></div> -->
        <img src="<?php echo SERVERURL?>views/img/logo_empresa.png" class="img-fluid "alt="" srcset="">
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="<?php echo SERVERURL?>home/">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Home</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Cliente
    </div>

    <!-- Nav Item - CLIENTES -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-user-friends"></i>
            <span> Clientes</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Gestion Cliente</h6>
                <a class="collapse-item" href="<?php echo SERVERURL?>Clientes/">Clientes</a>
                <a class="collapse-item" href="<?php echo SERVERURL?>Separados/">Separados Cliente</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - PRODUCTOS -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTree" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-tshirt"></i>
            <span> Productos</span>
        </a>
        <div id="collapseTree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Gestion Productos</h6>
                <a class="collapse-item" href="<?php echo SERVERURL?>Productos/">Productos</a>
                <a class="collapse-item" href="#">Reportes Productos</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - USUARIOS -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUser" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-user"></i>
            <span> Usuarios</span>
        </a>
        <div id="collapseUser" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Gestion Usuarios</h6>
                <a class="collapse-item" href="<?php echo SERVERURL?>Usuarios/">Usuarios</a>
                <a class="collapse-item" href="<?php echo SERVERURL?>usuario-nuevo/">Nuevo Usuario</a>
                <a class="collapse-item" href="#">Reportes Usuarios</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - FACTURACION -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFac" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-cash-register"></i>
            <span> Facturacion</span>
        </a>
        <div id="collapseFac" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Gestion Facturacion</h6>
                <a class="collapse-item" href="<?php echo SERVERURL?>registrar-factura/">Registrar Factura</a>
                <a class="collapse-item" href="<?php echo SERVERURL?>facturas-emitidas/">Factura Emitidas</a>
                <a class="collapse-item" href="<?php echo SERVERURL?>facturas-buscar/">Factura por Fecha</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - CAJA -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCaja" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-coins"></i>
            <span> Movimientos Caja</span>
        </a>
        <div id="collapseCaja" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Movimientos de Caja</h6>
                <a class="collapse-item" href="<?php echo SERVERURL?>caja-hoy/">Caja</a>
                <a class="collapse-item" href="<?php echo SERVERURL?>caja-periodica/">Caja Periodica</a>
            </div>
        </div>
    </li>


    
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>