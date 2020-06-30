<?php

namespace App\Http\Controllers\Products;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;

class PageProductController extends Controller
{
    public function show()
    {
        return view('products.show');
    }
}
