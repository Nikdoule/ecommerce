<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageProductController extends Controller
{
    public function index()
    {
        return view('products.show');
    }
}
