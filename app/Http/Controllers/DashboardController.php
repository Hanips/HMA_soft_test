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

        $loggedInUsers = 0;
        foreach (Session::all() as $key => $value) {
            if (strpos($key, 'user_online_') === 0) {
                $loggedInUsers++;
            }
        }

        return view('dashboard', compact('totalUsers', 'loggedInUsers'));
    }
}
