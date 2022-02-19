<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
            $users = User::where('id', '!=', Auth::user()->id)->paginate(10);
            return Inertia::render('Dashboard', ['users' => $users]);
    }
}
