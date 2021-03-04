<tr>
    <td>
        {{ $customer->ruc }}
    </td>
    <td>
         {{ $customer->name }}
    </td>
    <td>
        {{ $customer->present()->currentStatus() }} <br>
    </td>
    <td class="text-right">
        @if ($customer->is_active)
            <a href="{{ route('admin.customers.collaborators.index',$customer->id) }}" data-toggle="tooltip" title="" data-original-title="Entrar">
                <i class="fa fa-arrow-right ml-2 mr-2"></i>
            </a>
        @endif
        <a href="{{ route('admin.customers.edit',$customer->id) }}" data-toggle="tooltip" title="" data-original-title="Editar">
            <i class="fa fa-pencil ml-2"></i>
        </a>
        <div class="dropdown">
            <a href="#" class="btn btn-sm"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="{{ route('admin.customers.edit', $customer->id) }}" class="dropdown-item" type="button">Editar</a>
                <form action="{{ route('admin.customers.destroy', $customer->id) }}" method="POST">
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
