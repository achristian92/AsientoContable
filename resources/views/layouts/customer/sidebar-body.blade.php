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
            {{ isOpenRoute(4,'collaborators') }} || {{ isOpenRoute(4,'payrolls') }} ||
            {{ isOpenRoute(4,'month-costs') }} || {{ isOpenRoute(4,'vouchers') }}
            {{ isOpenRoute(4,'cost-center') }} || {{ isOpenRoute(4,'cost-center2') }} ||
            {{ isOpenRoute(4,'accounting-plan') }} || {{ isOpenRoute(4,'accounting-seat') }} ||
            {{ isOpenRoute(4,'headers') }} || {{ isOpenRoute(4,'pensions') }}">
            <ul>
                <li class="navigation-divider text-center mb-0">{{ \Illuminate\Support\Str::limit($currentCustomer->name,20) }}</li>
                <hr class="mt-0">
                <li class="navigation-divider m-0 text-light font-weight-bold">Planilla</li>
                <li><a href="{{ route('admin.customers.collaborators.index',$currentCustomer->id) }}" class="{{ isActiveRoute(4,'collaborators') }} ml-3">Colaboradores</a></li>
                <li><a href="{{ route('admin.customers.payrolls.index',$currentCustomer->id) }}" class="{{ isActiveRoute(4,'payrolls') }} ml-3">Planilla mensual</a></li>
                <li><a href="{{ route('admin.customers.accounting-seat.index',$currentCustomer->id) }}" class="{{ isActiveRoute(4,'accounting-seat') }} ml-3">Asiento contable</a></li>
                <li><a href="{{ route('admin.customers.month-costs.index',$currentCustomer->id) }}" class="{{ isActiveRoute(4,'month-costs') }} ml-3">Asignación de costos</a></li>
                <li><a href="{{ route('admin.customers.vouchers.index',$currentCustomer->id) }}" class="{{ isActiveRoute(4,'vouchers') }} ml-3">Gestión boleta</a></li>

                <li class="navigation-divider m-0 text-light font-weight-bold">Configuración</li>
                <li><a href="{{ route('admin.customers.cost-center.index',[$currentCustomer->id]) }}" class="{{ isActiveRoute(4,'cost-center') }} ml-3">Centro costos</a></li>
                <li><a href="{{ route('admin.customers.cost-center2.index',[$currentCustomer->id]) }}" class="{{ isActiveRoute(4,'cost-center2') }} ml-3">Centro costos 2</a></li>
                <li><a href="{{ route('admin.customers.accounting-plan.index',$currentCustomer->id) }}" class="{{ isActiveRoute(4,'accounting-plan') }} ml-3">Plan contable</a></li>
                <li><a href="{{ route('admin.customers.headers.index',$currentCustomer->id) }}" class="{{ isActiveRoute(4,'headers') }} ml-3">Cabeceras</a></li>
                <li><a href="{{ route('admin.customers.pensions.index',$currentCustomer->id) }}" class="{{ isActiveRoute(4,'pensions') }} ml-3">Pensiones</a></li>
            </ul>
        </div>
    </div>
</div>
