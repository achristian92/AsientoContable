<div class="modal fade" id="importModalCenterCost2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Importar Centro de costos2</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('admin.customers.center-cost2.import',$currentCustomer->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <input type="file"
                               name="file_upload"
                               class="form-control-file"
                               required>
                    </div>
                    <div class="row col-md-12 mt-5">
                        <a href="{{ asset('files/Plantilla-CentroCostos.xlsx') }}" class="text-primary font-size-15"><u>Descargar plantilla</u></a>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
