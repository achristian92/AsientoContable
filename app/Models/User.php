<?php

namespace App\Models;

use App\AsientoContable\Customers\Customer;
use App\Notifications\UserResetPasswordNotification;
use App\AsientoContable\Images\Image;
use App\AsientoContable\Users\Presenters\UserPresenter;
use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles,HasFactory,Notifiable;

    protected $guarded = ['id'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function history(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(History::class);
    }

    public function image(): \Illuminate\Database\Eloquent\Relations\MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function customers(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Customer::class);
    }

    public function getFullNameAttribute()
    {
        return ucwords("{$this->name} {$this->last_name}");
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new UserResetPasswordNotification($token));
    }

    public function rolesAssigned()
    {
        return implode("|",Auth::user()->getRoleNames()->toArray());
    }

    public function imgUser()
    {
        return asset('img/user-default.png');
    }

    public function imgCompany()
    {
        return asset('img/jga.png');
    }

    public function isAdmin(): bool
    {
        return $this->hasRole('Administrador');
    }

    public function present(): UserPresenter
    {
        return new UserPresenter($this);
    }
}
