<div class="navigation-menu-body">
    <!-- begin::navigation-logo -->
    <div>
        <div id="navigation-logo">
            <a href="{{ route('admin.customers.index') }}">
                <img class="logo" src="{{ $userCurrent->imgCompany() }}" style="width: 150px; object-fit: contain" alt="logo">
            </a>
        </div>
    </div>
    <!-- end::navigation-logo -->

    <div class="navigation-menu-group">

        <div id="dashboards" class="{{ isOpenRoute(2,'customers') }} || {{ isOpenRoute(2,'users') }}">
            <ul>
                <li class="navigation-divider">Dashboard</li>
                @if ($userCurrent->isAdmin())
                    <li><a href="{{ route('admin.customers.index') }}" class="{{ isActiveRoute(2,'customers') }}">Clientes</a></li>
                    <li><a href="{{ route('admin.users.index') }}" class="{{ isActiveRoute(2,'users') }}">Usuarios</a></li>
                @endif
                <li>
                    <a href="#">Configuraciones</a>
                    <ul>
                        <li><a href="">Moneda </a></li>
                        <li><a href="">Fondo pensiones</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
