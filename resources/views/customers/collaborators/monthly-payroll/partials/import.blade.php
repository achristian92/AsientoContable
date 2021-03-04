<div class="modal fade" id="importModalPayroll" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Importar Planilla</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('admin.customers.payroll-import',$currentCustomer->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                        <div class="form-group">
                            <label for="payroll-mont" class="col-form-label text-muted">Mes de planilla</label>
                            <input type="month" class="form-control" name="month" id="payroll-mont" required>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label text-muted">Cargar excel:</label>
                            <label class="btn btn-outline-light" for="my-file-selector">
                                <input type="file" name="file_upload" id="my-file-selector"  class="d-none" required>
                                <small><i class="fa fa-file-excel-o mr-2 text-success"></i> cargar archivo</small>
                            </label>
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
