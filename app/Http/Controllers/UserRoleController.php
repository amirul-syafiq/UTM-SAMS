<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    //
    public function index()
    {
        $user = auth()->user();
        $role = $user->role;
        return view('user_role.index', compact('role'));
    }
}
