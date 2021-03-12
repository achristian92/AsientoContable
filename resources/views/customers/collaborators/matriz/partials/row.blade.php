<tr>
    <td>
        {{ $collaborator->full_name }}<br>
        <small class="text-muted"> Código: {{ $collaborator->code }} - Nro identidad: {{ $collaborator->nro_document }} </small>
    </td>
    <td>
        {{ $collaborator->date_start_work }}
    </td>
    <td><span class='badge badge-success'>Activo</span></td>
    <td class="text-right">
        <div class="dropdown">
            <a href="#" class="btn btn-sm"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
            </a>
        </div>
    </td>
</tr>
