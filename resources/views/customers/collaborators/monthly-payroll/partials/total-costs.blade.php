<div class="row mt-3">
    <div class="col-md-3">
        <div class="card mb-0">
            <div class="card-body p-3">
                <div class="d-flex align-items-center">
                    <div class="icon-block icon-block-floating mr-3 icon-block-lg icon-block-outline-twitter text-success">
                        <i class="fa fa-plus"></i>
                    </div>
                    <div>
                        <h6 class="text-uppercase font-size-11">Total ingresos</h6>
                        <h4 class="mb-0 font-weight-bold">{{ $income }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card mb-0">
            <div class="card-body p-3">
                <div class="d-flex align-items-center">
                    <div class="icon-block icon-block-floating mr-3 icon-block-lg icon-block-outline-danger  text-danger">
                        <span class="font-weight-800">-</span>
                    </div>
                    <div>
                        <h6 class="text-uppercase font-size-11">Total Descuentos</h6>
                        <h4 class="mb-0 font-weight-bold">{{ $expense }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card mb-0">
            <div class="card-body p-3">
                <div class="d-flex align-items-center">
                    <div class="icon-block icon-block-floating mr-3 icon-block-lg icon-block-outline-success text-warning">
                        <i class="fa fa-hospital-o"></i>
                    </div>
                    <div>
                        <h6 class="text-uppercase font-size-11">Total Aportes</h6>
                        <h4 class="mb-0 font-weight-bold">{{ $contribution }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card mb-0">
            <div class="card-body p-3">
                <div class="d-flex align-items-center">
                    <div class="icon-block icon-block-floating mr-3 icon-block-lg icon-block-outline-instagram text-warning">
                        <i class="fa fa-dollar"></i>
                    </div>
                    <div>
                        <h6 class="text-uppercase font-size-11">Neto</h6>
                        <h4 class="mb-0 font-weight-bold">{{ $net }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
