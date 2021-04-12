<?php


namespace App\AsientoContable\Headers\Presenters;


use App\AsientoContable\Tools\Presenter;
use Illuminate\Support\HtmlString;

class HeaderPresenter extends Presenter
{
    public function currentStatus()
    {
        if ($this->model->is_active)
            return new HtmlString("<span class='badge badge-success'>Activo</span>");
        else
            return new HtmlString("<span class='badge badge-danger'>Desactivado</span>");
    }
}
