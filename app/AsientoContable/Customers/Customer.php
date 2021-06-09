<?php


namespace App\AsientoContable\Customers;


use App\AsientoContable\Collaborators\Collaborator;
use App\AsientoContable\Customers\Presenters\CustomerPresenter;
use App\AsientoContable\Files\File;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Nicolaslopezj\Searchable\SearchableTrait;

class Customer extends Authenticatable
{
    use HasFactory, Notifiable, SearchableTrait;

    protected $guard = 'customer';

    protected $with = ['collaborators'];

    protected $guarded = ['id'];

    protected $searchable = [
        'columns' => [
            'customers.name' => 10,
            'customers.ruc' => 8
        ]
    ];

    public function files(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(File::class);
    }

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

    public function searchCustomer(string $term) : Collection
    {
        return self::search($term)->get();
    }

}
