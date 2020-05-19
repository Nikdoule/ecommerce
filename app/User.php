<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'last_name', 'civility', 'phone', 'adress', 'city', 'zip_code'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    //relation
    public function roles()
    {
        return $this->belongsToMany('App\Role');

    }
    //function for roles
    public function isSuperAdmin()
    {
        return $this->roles()->where('name', 'super-admin')->first();
    }

    public function hasAnyRole(array $roles)
    {
        return $this->roles()->whereIn('name', $roles)->first();
    }

    public function adresses()
    {
        return $this->belongsTo('App\Adress');
    }
}
