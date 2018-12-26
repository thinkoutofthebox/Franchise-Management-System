<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use Illuminate\Http\Request;
use App\StateCity;
use RobinCSamuel\LaravelMsg91\Facades\LaravelMsg91;

class TestController extends Controller
{
	public function index(Request $request){
		echo "********************TestController****************<pre>";

	}

}
