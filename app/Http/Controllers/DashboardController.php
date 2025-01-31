<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();

        $allSessions = Session::all(); 

        $loggedInUsers = collect($allSessions)->keys()->filter(function ($key) {
            return strpos($key, 'user_online_') === 0;
        })->count();

        return view('dashboard', compact('totalUsers', 'loggedInUsers'));
    }
}
