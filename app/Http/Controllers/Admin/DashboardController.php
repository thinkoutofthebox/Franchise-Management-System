<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
    	$franchises = User::where('user_type', 'franchise')->get()->count();
    	return view('admin.dashboard.dashboard', ['franchises' => $franchises]);
    }
}
