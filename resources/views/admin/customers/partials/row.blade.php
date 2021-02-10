<tr>
    <td>
        {{ $customer->name }} <br>
        <small class="text-muted">ID: {{ $customer->nro_document }} | Teléf: {{ $customer->phones }}</small>
    </td>
    <td>
        {{ $customer->present()->contactName()  }} <br>
        {{ $customer->present()->contactPhone() }}
    </td>
    <td>{{ $customer->present()->currentStatus()  }}</td>
    <td class="text-right">
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
