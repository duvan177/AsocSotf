 <div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li @click="menu=0" class="nav-item">
                        <a class="nav-link active " href="#"><i class="icon-speedometer"></i> Escritorio</a>
                    </li>
                    <li class="nav-title">
                        Mantenimiento
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-bag"></i>Productos</a>
                        <ul class="nav-dropdown-items">
                            <li @click=" menu=1"  class="nav-item mobile-sidebar-toggler">
                                <a class="nav-link" href="#"><i class="icon-bag"></i> inventario</a>
                            </li>
                            <li @click="menu=2"  class="nav-item mobile-sidebar-toggler">
                                <a class="nav-link" href="#"><i class="icon-bag"></i> Gestion de inventario</a>
                            </li>
                        </ul>
                    </li>
                  
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-basket"></i> Ventas</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=5"  class="nav-item mobile-sidebar-toggler">
                                <a class="nav-link" href="#"><i class="icon-basket-loaded"></i>Favturas</a>
                            </li>
                            <li @click="menu=6"  class="nav-item mobile-sidebar-toggler">
                                <a class="nav-link" href="#"><i class="icon-notebook"></i> Nueva venta</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle " href="#"><i class="icon-people"></i> Compras</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=7"  class="nav-item mobile-sidebar-toggler ">
                                <a class="nav-link" href="#"><i class="icon-user"></i> Agregar</a>
                            </li>
                            <li @click="menu=8" class="nav-item mobile-sidebar-toggler">
                                <a class="nav-link" href="#"><i class="icon-user-following"></i> Gestion de compras</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-pie-chart"></i> Usuarios</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=9"  class="nav-item mobile-sidebar-toggler ">
                                <a class="nav-link" href="#"><i class="icon-chart"></i> Roles</a>
                            </li>
                            <li  @click="menu=10" class="nav-item mobile-sidebar-toggler">
                                <a class="nav-link" href="#"><i class="icon-chart"></i> Gestion</a>
                            </li>
                        </ul>
                    </li>
                  
        
                </ul>
            </nav>
            <button class="sidebar-minimizer brand-minimizer" type="button"></button>
        </div>