<?php


namespace App\Models;


use App\AsientoContable\Customers\Customer;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $table = 'history';

    protected $guarded = ['id'];

    CONST IMPORT_TYPE = 'Import';
    CONST EXPORT_TYPE = 'Export';
    CONST LOGIN_TYPE = 'Login';
    CONST CREATED_TYPE = 'Created';
    CONST UPDATED_TYPE = 'Update';

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function customer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

}
