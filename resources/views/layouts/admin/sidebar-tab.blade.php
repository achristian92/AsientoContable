<div class="navigation-menu-tab">
    <div>
        <div class="navigation-menu-tab-header" data-toggle="tooltip" title="{{ $userCurrent->full_name }}" data-placement="right">
            <a href="#" class="nav-link" data-toggle="dropdown" aria-expanded="false">
                <figure class="avatar avatar-sm">
                    <img src="{{ $userCurrent->imgUser() }}" class="rounded-circle" alt="avatar">
                </figure>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-big">
                <div class="p-3 text-center" data-backround-image="{{ asset('img/profile_background.jpg') }}">
                    <figure class="avatar mb-3">
                        <img src="{{ $userCurrent->imgUser() }}" class="rounded-circle" alt="image">
                    </figure>
                    <h6 class="d-flex align-items-center justify-content-center">
                        {{ $userCurrent->name }}
                        <a href="" class="btn btn-primary btn-sm ml-2" data-toggle="tooltip" title="Editar perfil">
                            <i data-feather="edit-2"></i>
                        </a>
                    </h6>
                    <small>Rol: <strong>{{ $userCurrent->rolesAssigned() }}</strong></small>
                </div>
                <div class="dropdown-menu-body">
                    <div class="list-group list-group-flush">
                        <a href="" class="list-group-item">Cuenta</a>
                        <a href="#" class="list-group-item" data-sidebar-target="#settings">Necesitas ayuda?</a>
                        <a href="#"
                           onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                           class="list-group-item text-danger"
                           data-sidebar-target="#settings">
                            Salir !
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="flex-grow-1">
        <ul>
            <li>
                <a href="#" data-toggle="tooltip" data-placement="right" title="Dashboard"
                   data-nav-target="#dashboards">
                    <i data-feather="bar-chart-2"></i>
                </a>
            </li>
        </ul>
    </div>
    <div>
        <ul>
            <li>
                <a class="{{ isActiveRoute('2','setup') }}" href="#" data-toggle="tooltip" data-placement="right" title="Configuraciones" data-nav-target="#settings">
                    <i data-feather="settings"></i>
                </a>
            </li>
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
        </ul>
    </div>
</div>
