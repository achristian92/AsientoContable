<div class="modal fade" id="importModalMonthCost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Mes a asignar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('admin.customers.month-costs.store',$currentCustomer->id) }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="payroll-mont" class="col-form-label text-muted">Mes a asignar</label>
                        <input type="month" class="form-control" name="month" id="payroll-mont" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
