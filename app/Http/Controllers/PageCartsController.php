<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class PageCartsController extends Controller
{
    public function index() 
    {
        $countCarts = Cart::count();
        
        return $countCarts > 0 ? view('cart.index') : redirect()->route('products.index');
    }
}
