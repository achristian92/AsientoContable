<div class="navigation-menu-body">
    <!-- begin::navigation-logo -->
    <div>
        <div id="navigation-logo">
            <a href="{{ route('admin.customers.index') }}">
                <img class="logo" src="{{ \App\Models\Setting::first()->url_logo }}" style="width: 150px; object-fit: contain" alt="logo">
            </a>
        </div>
    </div>
    <!-- end::navigation-logo -->

    <div class="navigation-menu-group">

        <div id="dashboards" class="{{ isOpenRoute(2,'customers') }} || {{ isOpenRoute(2,'users') }} ||
                                    {{ isOpenRoute(2,'pensions') }} || {{ isOpenRoute(2,'currencies') }}">
            <ul>
                <li class="navigation-divider">Dashboard</li>
                <li><a href="{{ route('admin.customers.index') }}" class="{{ isActiveRoute(2,'customers') }}">Clientes</a></li>
                @if ($userCurrent->isAdmin())
                <li><a href="{{ route('admin.users.index') }}" class="{{ isActiveRoute(2,'users') }}">Usuarios</a></li>
                @endif
                <li><a href="{{ route('admin.currencies.index') }}" class="{{ isActiveRoute(2,'currencies') }}">Moneda</a></li>
            </ul>
        </div>
    </div>
</div>
