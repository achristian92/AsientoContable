<?php


namespace App\AsientoContable\AccountsHeaders;


use Illuminate\Database\Eloquent\Model;

class AccountHeader extends Model
{
    protected $table = 'accounts_headers';

    protected $guarded = ['id'];
}
