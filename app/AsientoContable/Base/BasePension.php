<?php


namespace App\AsientoContable\Base;


use Illuminate\Database\Eloquent\Model;

class BasePension extends Model
{
    protected $table = 'base_pension';

    protected $guarded = ['id'];
}

