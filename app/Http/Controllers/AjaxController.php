<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StateCity;
use App\Batch;
use RobinCSamuel\LaravelMsg91\Facades\LaravelMsg91;
use App\Product;

class AjaxController extends Controller
{
	public function getCityState(Request $request)
	{
		$state = $request->input('state');
		$states_cities = StateCity::where('state', $state)->get();
		return view('franchise.partials.city_state', ['states_cities'=>$states_cities]);
	} 

	public function getProductBatches(Request $request)
	{
		$elc_id = $request->user()->id;
		$pid = $request->input('pid');
		$batches = Batch::where('elc_id', $elc_id)
							->where('pid', $pid)
							->where('status', 1)->get();
		return view('franchise.partials.batches', ['batches'=>$batches]);
	} 

	public function verifyOtp(Request $request)
	{
		// return response()->json(true);
		$phone_number = $request->input('phone');
		$otp = $request->input('otp');
		$result = LaravelMsg91::verifyOtp($phone_number, $otp, ['raw' => true]);
		if ($result->type == 'success') {
			return response()->json(true);
		} else {
			return response()->json(false);
		}
		
	}

	public function resendOtp(Request $request)
	{
		$phone_number = $request->input('phone');
		$otp = rand(1001, 9999);
	    $result = LaravelMsg91::sendOtp($phone_number, $otp, "Dear User, The verification code for registering with this mobile number is {$otp}");
		return response()->json(['success'=> 'OTP resent successfully.']);
	}

	public function getProductElc(Request $request)
	{
		$elc_id = $request->input('elc_id');
		$products = Product::where('elc_id', $elc_id)->get();
		return view('franchise.partials.products', ['products'=>$products]);
	} 

}
