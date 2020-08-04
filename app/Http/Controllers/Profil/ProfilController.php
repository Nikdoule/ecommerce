<?php

namespace App\Http\Controllers\Profil;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Gloudemans\Shoppingcart\Facades\Cart;

class ProfilController extends Controller
{

    public function VIEW_EDIT()
    {
        return view('profil.users.edit');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = Auth::user();

        return ['user' => $user];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user = Auth::user();
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->civility = $request->civility;
        $user->email = $request->email;
        $user->adress = $request->adress;
        $user->zip_code = $request->zip_code;
        $user->city = $request->city;
        $user->phone = $request->phone;

        
        if(strlen($request->image) > 200)
        {
            $image = $request->get('image');
            $name = time().'.jpg';
            \Image::make($request->get('image'))->save(public_path('images/').$name);
            $user->image = '/images/'.$name;
        }
        
        $user->save();

        return response()->json('add image Image succes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
    private function storeImage(User $user)
    {
        if(request('image')){
            $user->update([
                'image' => request('image')->store('avatars', 'public')
            ]);
        }

    }
}
