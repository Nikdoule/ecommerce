<?php

namespace App\Http\Controllers\Products;
use App\Product;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function VIEW_INDEX()
    {
        return view('products.index');
        
    }
    public function VIEW_SHOW()
    {
        return view('products.show');
        
    }
    public function VIEW_CATEGORY()

    {
        
        return view('products.category');
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $products = Product::inRandomOrder()->with('categories')->take(6)->get();

        $categories = Category::all();

        return response()->json(['products' => $products, 'categories' => $categories], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        return ['product' => $product];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function getCategory($slug) {

        $categories = Category::all();
        
        $categoryWithSlug = Category::where('slug', $slug)->firstOrFail();

        $productByCategories = $categoryWithSlug->products()->with('categories')->get();

        return response()->json(['productByCategories' => $productByCategories, 'categories' => $categories], 200);
    }
}
