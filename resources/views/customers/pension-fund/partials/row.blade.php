<tr>
    <td>
        {{ $pension->short }} <br>
    </td>
    <td>
        {{ $pension->name }} <br>
    </td>
    <td>
        @if (!$pension->account_plan_id)
            <span class="fa fa-circle text-warning mr-2"> Pendiente!</span>
        @else
            {{ $pension->account->code ?? '' }} - {{ $pension->account->name ?? '' }}
        @endif
    </td>
    <td class="text-right">
        <a href="{{ route('admin.customers.pensions.edit',[$currentCustomer->id,$pension->id]) }}" data-toggle="tooltip" title="" data-original-title="Editar">
            <i class="fa fa-pencil ml-1"></i>
        </a>
    </td>
</tr>
