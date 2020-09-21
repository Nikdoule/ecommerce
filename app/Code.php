<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Code extends Model
{

    protected $fillable = ['name', 'discount'];

    public function remise($subtotal)
    {
        return ($subtotal * ($this->discount / 100));
    }
}

