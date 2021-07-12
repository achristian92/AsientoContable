<tr>
    <td>
        {{ $collaborator->full_name }}<br>
        <small class="text-muted"> Código: {{ $collaborator->code }} - Nro identidad: {{ $collaborator->nro_document }} </small>
    </td>
    <td>
        {{ $collaborator->date_start_work }}
    </td>
    <td>
        {{ $collaborator->cuspp }} <br>
        <small class="text-muted">{{ $collaborator->code_cuspp }}</small>
    </td>
    <td><span class='badge badge-success'>Activo</span></td>
    <td class="text-right">
        <div class="dropdown">
            <a href="#" class="btn btn-sm"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="{{ route('admin.customers.collaborators.show', [$currentCustomer->id,$collaborator->id]) }}" class="dropdown-item" type="button">Detalle</a>
                <form action="{{ route('admin.customers.collaborators.destroy',[$currentCustomer->id,$collaborator->id]) }}" method="POST">
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
