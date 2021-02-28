<?php


namespace App\AsientoContable\Customers;


use App\AsientoContable\Collaborators\Collaborator;
use App\AsientoContable\Customers\Presenters\CustomerPresenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $with = ['collaborators'];

    protected $guarded = ['id'];

    public function collaborators()
    {
        return $this->hasMany(Collaborator::class);
    }

    public function present(): CustomerPresenter
    {
        return new CustomerPresenter($this);
    }

}
