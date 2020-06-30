<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageUsersController extends Controller
{
    public function index()
    {
        return view('admin.users.index');
    }
    public function edit()
    {
        return view('admin.users.edit');
    }
}
