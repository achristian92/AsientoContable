<?php


namespace App\Voucher\Tools;


use Illuminate\Database\Eloquent\Model;

abstract class Presenter //No lo podemos instanciarlo, solo extender
{

    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }
}
