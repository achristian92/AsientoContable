<?php


namespace App\AsientoContable\Customers\Presenters;


use App\AsientoContable\Tools\Presenter;
use Illuminate\Support\HtmlString;

class CustomerPresenter extends Presenter
{
    public function showAccess()
    {
        if ($this->model->notified)
            return new HtmlString("<span><i class='fa fa-check text-success mr-1 ml-2'></i>Acceso</span>");
        else
            return new HtmlString("<span><i class='fa fa-window-close-o text-danger mr-1 ml-2'></i>Sin Acceso</span>");
    }
    public function showContact()
    {
        if (!$this->model->contact_name)
            return '';

        return new HtmlString("<span><i class='fa fa-user-circle'></i> {$this->model->contact_name} </span>");
    }
    public function showPhones()
    {
        if (!$this->model->phones)
            return '';

        return new HtmlString("<span class='ml-2'><i class='fa fa-phone'></i> {$this->model->phones} </span>");
    }
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
