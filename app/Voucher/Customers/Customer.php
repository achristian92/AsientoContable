<?php


namespace App\Voucher\Customers;


use App\Voucher\Customers\Presenters\CustomerPresenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;


    protected $fillable = [
        'company_id',
        'name','type_document','nro_document',
        'address','email','phones', 'is_active'
    ];


    public function present(): CustomerPresenter
    {
        return new CustomerPresenter($this);
    }

}
