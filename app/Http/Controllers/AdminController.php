<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // function checkisAdmin()
    // {
    //     if (auth()->user()->role_code !== 'UR04') {

    //         return redirect()->route('dashboard');
    //     }
    // }

    // This function is used to display the user list
    public function userList()
    {
        // Check if user is admin or not, if not redirect to not-authorized page
        if (auth()->user()->role_code !== 'UR04') {

            return view('not-authorized');
        }

        // Get all users from database and paginate it by 9
        $users = User::select('id', 'name', 'utm_id', 'email', 'address', 'phone', 'role_code')
            ->orderBy('name')
            ->paginate(9);

        // Get all roles from database
        $roles = UserRole::pluck('role_name', 'role_code');

        // Check for every user, if the role_code is in the roles collection, replace it with the role_name
        foreach ($users as $user) {
            if ($roles->has($user->role_code)) {
                $user->role_code = $roles->get($user->role_code);
            }
        }

        return view('userManagement.user-list', compact('users', 'roles'));
    }


    public function filterUserList(Request $request)
    {
        // Check if user is admin
        if (auth()->user()->role_code !== 'UR04') {
            return view('not-authorized');
        }

        // Filter user list based on role
        if ($request->role != 'all') {
            $users = User::select('id', 'name', 'utm_id', 'email', 'role_code')->where('role_code', $request->role)->paginate(9);
        }

        $users = User::select('id', 'name', 'utm_id', 'email', 'address', 'phone', 'role_code')
        ->where('name', 'like', '%'.$request->user_search_keyword.'%')
        ->where('role_code', 'like', '%'.$request->role_code.'%')
        ->paginate(9);
        $roles = UserRole::pluck('role_name', 'role_code');
        $roles = $roles->sort();
        $roles->prepend('SHOW ALL', '');


        $keyword = $request->user_search_keyword;
        $selected_role = $request->role_code;

        // Replace role_code with role_name for display purpose only
        foreach ($users as $user) {
            if ($roles->has($user->role_code)) {
                $user->role_code = $roles->get($user->role_code);
            }
        }


        return view('userManagement.user-list', compact('users', 'roles','keyword','selected_role'))->with('filter', 'Showing search result');
    }

    public function edit($user_id)
    {
        $user = User::find($user_id);
        $roles = UserRole::pluck('role_name', 'role_code');


        return view('userManagement.edit-user', compact('user', 'roles'));
    }

    public function update(Request $request, $user_id)
    {
        $user = User::find($user_id);
        // Validate input

        $request->validate([
            'user_name' => 'required',
            'user_utm_id' => 'required|unique:users,utm_id,' . $user_id,
            'email' => 'required|email|regex:/(.*)\.utm\.my$/i|unique:users,email,' . $user_id,
            'user_address' => 'required',
            'user_phone' => 'required',
            'user_role' => 'required',
        ]);

        $user->name = $request->user_name;
        $user->email = $request->email;
        $user->address = $request->user_address;
        $user->phone = $request->user_phone;
        $user->role_code = $request->user_role;
        $user->utm_id = $request->user_utm_id;


        $user->save();

        return redirect()->route('admin.userList')->with('success', 'User updated successfully');
    }
}
