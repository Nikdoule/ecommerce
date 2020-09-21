<?php

namespace App\Http\Controllers;

use App\Code;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CodeController extends Controller
{
    public function VIEW_CREATE()
    {
        return view('code.index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    //    $code = $request->validate([
    //         'name' => 'required',
    //         'discount' => 'required'
    //    ]);
    //    Code::create([
    //     'name' => $request->name,
    //     'discount' => $request->discount
    //    ]);
        $code = $request->get('code');
        $coupon = Code::where('name', $code)->first();

        if(!$coupon) {
            return response()->json('le coupon est invalide'); 
        }else {
            $request->session()->put('coupon', [
                'code' => $coupon->name,
                'remise' => $coupon->remise(Cart::subtotal())
            ]);
            return response()->json($coupon->name); 
        }
           

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
    public function destroy($id)
    {
        //
    }
}
