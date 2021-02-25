<tr>
    <td>
        {{ $pension->code }} <br>
    </td>
    <td>
        {{ $pension->short }} <br>
    </td>
    <td>
        {{ $pension->name }} <br>
    </td>
    <td>
        {{ $pension->present()->currentStatus() }} <br>
    </td>
    <td class="text-right">
        <a href="{{ route('admin.pensions.edit',$pension->id) }}" data-toggle="tooltip" title="" data-original-title="Editar">
            <i class="fa fa-pencil ml-1"></i>
        </a>
        <div class="dropdown">
            <a href="#" class="btn btn-sm"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="{{ route('admin.pensions.edit', $pension->id) }}" class="dropdown-item" type="button">Editar</a>
                <form action="{{ route('admin.pensions.destroy', $pension->id) }}" method="POST">
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
