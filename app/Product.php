<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = ['category_id','title', 'slug','subtitle','description','price','image', 'images'];

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    public function getPrice()
    {
        $price = $this->price / 100;

        return number_format($price, 2, ',', ' ') . '€';
    }
    
}
