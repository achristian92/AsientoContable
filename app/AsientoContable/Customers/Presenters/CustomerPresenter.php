<?php


namespace App\AsientoContable\Customers\Presenters;


use App\AsientoContable\Tools\Presenter;
use Illuminate\Support\HtmlString;

class CustomerPresenter extends Presenter
{

    public function currentStatus()
    {
        if ($this->model->is_active)
            return new HtmlString("<span class='badge badge-success'>Activo</span>");
        else
            return new HtmlString("<span class='badge badge-danger'>Desactivado</span>");
    }

    public function hasOneContact(): bool
    {
        return $this->model->contacts->count() === 1;
    }

}
