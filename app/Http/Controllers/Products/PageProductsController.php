<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageProductsController extends Controller
{
    public function index()
    {
        return view('products.index');
    }
}
