<tr>
    <td>{{ $currency->name }}</td>
    <td>{{ $currency->code }}</td>
    <td>{{ $currency->symbol }}</td>
    <td>{{ $currency->buy }}</td>
    {{--<td>{{ $currency->sell }}</td>--}}
    <td>{{ formatDate($currency->created_at) }}</td>
    <td class="text-right">
        <a href="{{ route('admin.currencies.edit',$currency->id) }}" data-toggle="tooltip" title="" data-original-title="Editar">
            <i class="fa fa-pencil"></i>
        </a>
    </td>
</tr>
