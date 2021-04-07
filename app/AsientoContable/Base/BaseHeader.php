<?php


namespace App\AsientoContable\Base;


use Illuminate\Database\Eloquent\Model;

class BaseHeader extends Model
{
    protected $table = 'base_header';

    protected $guarded = ['id'];
}
