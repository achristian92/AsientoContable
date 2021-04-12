<?php


namespace App\AsientoContable\Customers;


use App\AsientoContable\Collaborators\Collaborator;
use App\AsientoContable\Customers\Presenters\CustomerPresenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = 'customer';

    protected $with = ['collaborators'];

    protected $guarded = ['id'];

    public function collaborators(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Collaborator::class);
    }

    public function present(): CustomerPresenter
    {
        return new CustomerPresenter($this);
    }

    public function imgUser()
    {
        return asset('img/user-default.png');
    }

    public function imgCompany()
    {
        return asset('img/jga.png');
    }

}
