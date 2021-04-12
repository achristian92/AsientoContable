<div class="navigation-menu-tab">
    <div>
        <div class="navigation-menu-tab-header" data-toggle="tooltip" title="JGA CONSULTORES" data-placement="right">
            <a href="#" class="nav-link" data-toggle="dropdown" aria-expanded="false">
                <figure class="avatar avatar-sm">
                    @if($userCurrent)
                        <img src="{{ $userCurrent->imgUser() }}" class="rounded-circle" alt="avatar">
                    @else
                        <img src="{{ $currentCustomer->imgUser() }}" class="rounded-circle" alt="avatar">
                    @endif
                </figure>
            </a>
        </div>
    </div>
    <div class="flex-grow-1">
        <ul>

            <li>
                <a href="#" data-toggle="tooltip" data-placement="right" title="Clientes"
                   data-nav-target="#customers2">
                    <i data-feather="layers"></i>
                </a>
            </li>
        </ul>
    </div>
    <div>
        <ul>
            @if ($userCurrent)
                <li>
                    <a href=""
                       onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                       data-toggle="tooltip"
                       data-placement="right"
                       title="Salir">
                        <i data-feather="log-out"></i>
                    </a>
                    <form action="{{ route('logout') }}" id="logout-form" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            @else
                <li>
                    <a href=""
                       onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                       data-toggle="tooltip"
                       data-placement="right"
                       title="Salir">
                        <i data-feather="log-out"></i>
                    </a>
                    <form action="{{ route('customer.logout') }}" id="logout-form" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            @endif
        </ul>
    </div>
</div>
