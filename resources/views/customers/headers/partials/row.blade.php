<tr>
    <td>
        <a href="#">
            {{ $header->name }}
            @if($header->is_required)
                (*)
            @endif
        </a>
    </td>
    <td> {{ $header->order }} </td>
    <td>
        @if ($header->has_account || $header->account_plan_id)
            @if (!$header->account_plan_id)
                <span class="fa fa-circle text-warning mr-2"> Pendiente!</span>
            @else
                @if ($header->is_account_main)
                    [{{ $header->account->code }}] - {{ $header->account->name }}
                @else
                    [{{ $header->account->code }}] - {{ $header->name }}
                @endif
            @endif
        @endif
    </td>
    <td>
        {{ $header->present()->currentStatus() }}
    </td>
    <td class="text-right">
        <a href="{{ route('admin.customers.headers.edit',[customerID(),$header->id]) }}" class="btn btn-outline-light btn-sm mr-1">
            <small><i class="ti-pencil"></i></small>
        </a>
        <a href="" class="btn btn-outline-light btn-sm mr-1">
            <small><i class="ti-close"></i></small>
        </a>
    </td>
</tr>
