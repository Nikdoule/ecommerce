<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UsersController extends Controller
{
    public function VIEW_INDEX()
    {
       return view('admin.users.index');
    }
    public function VIEW_EDIT()
    {
       return view('admin.users.edit');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $auth = Auth::user();

        $role_auth = $auth->roles->pluck('name');

        $users = User::with('roles')->get();
        
        return ['users' => $users,'auth' => $role_auth];
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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($user_id)
    {
        $user = User::find($user_id);
        if (Gate::denies('edit-users')) {
            
            return redirect()->route('admin.users.index');
        }
        $roles = Role::all();

        $auth = Auth::user();
        
        $rolesUser = $user->roles->pluck('id');

        $role_auth = $auth->roles->pluck('name');


        return ['user' => $user,'roles' => $roles,'rolesUser' => $rolesUser,'auth' => $role_auth];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user_id)
    {
        $user = User::find($user_id);

        $user->roles()->sync($request->roles);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id)
    {
        $user = User::find($user_id);
        
        if (Gate::denies('delete-users')) {

        }
        $user->roles()->detach();
        $user->delete();
        
    }
}
