<?php

namespace App\Http\Controllers;
use App\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carts = Cart::content();

        $subTotal = Cart::subtotal();
        $subTotal = floatval($subTotal);
        $subTotal = number_format($subTotal, 2, '.', '') / 100;
        
        return view('cart.index',[
            'carts' => $carts,
            'subTotal' => $subTotal
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $duplicata = Cart::search(function ($cartItem , $rowId) use ($request) { 
            return $cartItem->id == $request->product_id; 
        });

        if ($duplicata->isNotEmpty()) {
            return redirect()->route('products.index')->with('success', 'le produit a deja ete ajouté');
        }
        $prod = Product::find($request->product_id);

        Cart::add($prod->id, $prod->title, 1, $prod->price)->associate('App\Product');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function destroy($rowId)
    {
       $cart = Cart::remove($rowId);

       return back()->with('success', 'Le produit à bien été supprimé');
    }
}
