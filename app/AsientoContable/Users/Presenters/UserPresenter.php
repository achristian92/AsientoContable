<?php


namespace App\AsientoContable\Users\Presenters;


use App\AsientoContable\Tools\Presenter;
use Carbon\Carbon;
use Illuminate\Support\HtmlString;

class UserPresenter extends Presenter
{
    public function currentStatus()
    {
        if ($this->model->is_active)
            return new HtmlString("<span class='badge badge-success'>Activo</span>");
        else
            return new HtmlString("<span class='badge badge-danger'>Desactivado</span>");
    }

    public function roles()
    {
        return $this->model->roles()->pluck('name')->implode(' | ');
    }

    public function lastLogin()
    {
        return $this->model->last_login ? Carbon::parse($this->model->last_login)->format('d/m H:i')." última conexión" : "Aún no ingresa al sistema";
    }

}
