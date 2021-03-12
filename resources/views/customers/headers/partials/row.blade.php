<tr>
    <td>
        @if ($header->is_required)
            <span class="text-muted">{{ $header->name }}</span>
        @else
            {{ $header->name }}
        @endif

    </td>
    <td>
        {{ $header->order }}
    </td>
    <td>
        {{ $header->name_account_slug }}
    </td>
    <td class="text-right">
        @if (!$header->is_required)
            <a href="{{ route('admin.customers.headers.edit',[$currentCustomer->id,$header['id']]) }}" data-toggle="tooltip" title="" data-original-title="Editar">
                <i class="fa fa-pencil ml-1"></i>
            </a>
        @endif
        <div class="dropdown">
            <a href="#" class="btn btn-sm"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="{{ route('admin.customers.headers.edit', [$currentCustomer->id,$header->id]) }}" class="dropdown-item" type="button">Editar</a>
                <form action="{{ route('admin.customers.headers.destroy',[$currentCustomer->id,$header->id]) }}" method="POST">
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
