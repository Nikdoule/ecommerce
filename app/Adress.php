<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adress extends Model
{
    protected $fillable = [
        'name', 'zipcode', 'city'
    ];

    public function user()
    {
        return $this->hasMany('App\User');
    }
}
