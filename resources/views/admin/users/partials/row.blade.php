<tr>
    <td>
        {{ $user->full_name }} <br>
        <small class="text-muted"> {{ $user->present()->lastLogin() }} </small>
    </td>
    <td>{{ $user->present()->roles() }}</td>
    <td>{{ $user->customers->count() }} clientes</td>
    <td>{{ $user->present()->currentStatus()  }}</td>
    <td class="text-right">
        <div class="dropdown">
            <a href="#" class="btn btn-sm"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="{{ route('admin.users.edit', $user->id) }}" class="dropdown-item" type="button">Editar</a>
                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="dropdown-item" onClick="javascript: return confirm('¿Estas seguro de elimarlo?');">
                        <span>Eliminar</span>
                    </button>
                </form>
            </div>
        </div>
    </td>
</tr>
