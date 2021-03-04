<?php


namespace App\AsientoContable\PensionFund\Presenters;


use App\AsientoContable\Tools\Presenter;
use Illuminate\Support\HtmlString;

class PensionFundPresenter extends Presenter
{
    public function currentStatus()
    {
        if ($this->model->is_active)
            return new HtmlString("<span class='badge badge-success'>Activo</span>");
        else
            return new HtmlString("<span class='badge badge-danger'>Desactivado</span>");
    }
}
