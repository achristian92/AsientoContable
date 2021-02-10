<?php


namespace App\Voucher\Customers\Presenters;


use App\Voucher\Tools\Presenter;
use Illuminate\Support\HtmlString;

class CustomerPresenter extends Presenter
{
    public function contactName()
    {
        if ($this->hasOneContact())
            return $this->model->contacts->first()->full_name;
        else
            return $this->model->contacts->count().' contactos';
    }

    public function contactPhone()
    {
        if ($this->hasOneContact())
            return new HtmlString("<small class='text-muted'>Teléf: ". $this->model->contacts->first()->phone."</small>");
        else
            return '';
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
