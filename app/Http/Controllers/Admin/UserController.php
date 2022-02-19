<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class UserController extends Controller
{
    public function login()
    {
        return Inertia::render('AdminAuth/Login');
    }
    public function register()
    {
        return Inertia::render('AdminAuth/Register');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'max:50', 'email', 'unique:users'],
            'is_admin' => ['required'],
            'password' => ['required'],
        ]);

        $user = User::create([
            'is_admin' => $request->is_admin,
            'name' => $request->name,
            'email' => $request->email,
            'is_approved' => $request->is_approved,
            'password' => Hash::make($request->password),
        ]);

        return Redirect::route('admin.dashboard');
    }
    public function update(Request $request, $id)
    {
        $user = User::where('id', $id)->first();
        $request->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'max:50', 'email', Rule::unique('users')->ignore($user->id)],
            'is_admin' => ['required'],
            'password' => ['nullable'],
        ]);
        $user->update(['is_admin' => $request->is_admin]);
        $user->update(['name' => $request->name]);
        $user->update(['email' => $request->email]);

        if($request->password!=''||$request->password!=null){
            $user->update(['password' => Hash::make($request->password)]);

        }
        return Redirect::route('admin.dashboard');
    }
    public function detail($id)
    {
        $user = User::where('id', $id)->first();
        return Inertia::render('UserDetail', ['user' => $user]);
    }
    public function approve_user($id)
    {
        $user = User::where('id', $id)->first();
        $user->update(['is_approved' => 1]);
        return Redirect::route('admin.dashboard');
    }
    public function delete_user($id)
    {
        $user = User::where('id', $id)->first();
        $user->delete();
        return Redirect::route('admin.dashboard');
    }
}
