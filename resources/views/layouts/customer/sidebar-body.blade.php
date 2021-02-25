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

        <div id="customers2" class="
            {{ isOpenRoute(4,'collaborators') }} || {{ isOpenRoute(4,'monthly-payroll') }} ||
            {{ isOpenRoute(4,'cost-center') }} || {{ isOpenRoute(4,'cost-center2') }} ||
            {{ isOpenRoute(4,'accounting-plan') }} || {{ isOpenRoute(4,'accounting-seat') }}">
            <ul>
                <li class="navigation-divider">Cliente</li>
                <li class="{{ isOpenRoute(4,'collaborators') }} || {{ isOpenRoute(4,'monthly-payroll') }} || {{ isOpenRoute(4,'accounting-seat') }}">
                    <a href="#">Colaboradores</a>
                    <ul>
                        <li><a href="{{ route('admin.customers.collaborators.index',$currentCustomer->id) }}" class="{{ isActiveRoute(4,'collaborators') }}">Matriz</a></li>
                        <li><a href="{{ route('admin.customers.monthly-payroll.index',$currentCustomer->id) }}" class="{{ isActiveRoute(4,'monthly-payroll') }}">Planilla mensual</a></li>
                        <li><a href="{{ route('admin.customers.accounting-seat.index',$currentCustomer->id) }}" class="{{ isActiveRoute(4,'accounting-seat') }}">Asiento contable</a></li>
                        <li><a href="">Asignación de costos</a></li>
                        <li><a href="">Gestión boleta</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('admin.customers.cost-center.index',[$currentCustomer->id]) }}" class="{{ isActiveRoute(4,'cost-center') }}">Centro costos</a></li>
                <li><a href="{{ route('admin.customers.cost-center2.index',[$currentCustomer->id]) }}" class="{{ isActiveRoute(4,'cost-center2') }}">Centro costos 2</a></li>
                <li><a href="{{ route('admin.customers.accounting-plan.index',$currentCustomer->id) }}" class="{{ isActiveRoute(4,'accounting-plan') }}">Plan contable</a></li>
            </ul>
        </div>
    </div>
</div>
