<div class="col-md-3 app-sidebar">
    <div class="card">
        <div class="card-body">
            <div class="text-center">
                <button class="btn btn-outline-facebook"
                        data-toggle="modal"
                        data-target="#importModalMonthCost">
                    <i class="fa fa-plus mr-2"></i> Nuevo Mes
                </button>
            </div>
        </div>
        <div class="app-sidebar-menu" tabindex="1" style="overflow: hidden; outline: none;">
            <div class="list-group list-group-flush">
                @foreach($months as $month)
                    <a href="{{ route('admin.customers.month-costs.show',[$currentCustomer->id,$month->id]) }}"
                       class="list-group-item d-flex align-items-center {{ (int) request()->segment(5) === $month->id ? 'text-primary' : '' }}">
                        <i class="fa fa-calendar-minus-o mr-2"></i>
                        {{ $month->name }}
                        <span class="small ml-auto">{{ $month->assigns->count() }}</span>
                    </a>
                @endforeach
            </div>
            @if (count($months) === 0)
                <div class="card-body">
                    <h6 class="mb-4 text-muted">Aún no tienes centros de costos asignados</h6>
                    <div class="align-items-center">
                        <div class="card">
                            <img src="{{ asset('img/upload_fle.png') }}" style="object-fit: cover" class="card-img-top" alt="...">
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
