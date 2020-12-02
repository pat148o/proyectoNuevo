<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link active" href="main.html"><i class="icon-speedometer"></i> Escritorio</a>
            </li>
            <li class="nav-title">
                Maestras
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-bag"></i> Cafeteria</a>
                <ul class="nav-dropdown-items">

                <li @click="menu=1" class="nav-item">
                    <a class="nav-link" href="#"><i class="icon-bag"></i>Cargos</a>
                </li>
            
                    <li @click="menu=2" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-bag"></i>Clientes</a>
                    </li>

                    <li @click="menu=3" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-bag"></i>Empleados</a>
                    </li>

                    <li @click="menu=4" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-bag"></i>Empresa</a>
                    </li>
                    
                    <li @click="menu=5" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-bag"></i>Entrada Productos</a>
                    </li>

                    <li @click="menu=6" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-bag"></i>Factura</a>
                    </li>

                    <li @click="menu=7" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-bag"></i>Mesas</a>
                    </li>
                    
                    <li @click="menu=8" class="nav-item">
                        <a class="nav-link" href="i#"><i class="icon-wallet"></i> Pedidos</a>
                    </li>

                    <li @click="menu=9" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-bag"></i>Productos</a>
                    </li>

                    <li @click="menu=10" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-notebook"></i>Proveedor Productos</a>
                    </li>

                    <li @click="menu=11" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-bag"></i>Proveedores </a>
                    </li>

                    <li @click="menu=12" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-bag"></i>Salida Productos</a>
                    </li>
                    
                    <li @click="menu=13" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-bag"></i>Tipo Productos</a>
                    </li>

                    <li @click="menu=14" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-notebook"></i>Usuarios</a>
                    </li>




                </ul>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-wallet"></i> Solicitudes</a>
                <ul class="nav-dropdown-items">
                    <li @click="menu=15" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-notebook"></i>Detalle Salida</a>
                    </li>
                    <li @click="menu=16" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-notebook"></i>Detalle Entrada</a>
                    </li>
                    
                    <li  @click="menu=17" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-notebook"></i>Detalle Pedidos</a>
                    </li>
                    <li @click="menu=18" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-notebook"></i>Detalle Factura</a>
                    </li>
                </ul>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="main.html"><i class="icon-book-open"></i> Ayuda <span class="badge badge-danger">PDF</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="main.html"><i class="icon-info"></i> Acerca de...<span class="badge badge-info">IT</span></a>
            </li>
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>